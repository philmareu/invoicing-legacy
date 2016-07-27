<?php namespace Invoicing\Billing;

use Illuminate\Support\Facades\Auth;
use Invoicing\Models\User;
use Stripe;
use Exception;
use Stripe\Error\RateLimit;

//use App\Repositories\BillingRepository as Billing;

class StripeBilling {

    public function __construct()
    {
    }

    public function charge(array $data)
    {
        try
        {
            Stripe\Stripe::setApiKey(User::find(1)->settings->stripe_secret);

            return Stripe\Charge::create([
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'description' => $data['email'],
                'source' => $data['token'],
            ],
                [
                    "idempotency_key" => $data['idempotency_key']
                ]
            );
        }

        catch(Stripe\Error\Card $e)
        {
            throw new Exception($e->getMessage());
        }

        catch (Stripe\Error\InvalidRequest $e)
        {
            // Invalid parameters were supplied to Stripe's API
        }

        catch (Stripe\Error\Authentication $e)
        {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
        }

        catch (Stripe\Error\ApiConnection $e)
        {
            // Network communication with Stripe failed
        }

        catch (Exception $e)
        {
            // Something else happened, completely unrelated to Stripe
            throw new Exception($e->getMessage());
        }
    }

    public function transaction($txnId, $access_token)
    {
        return Stripe\BalanceTransaction::retrieve($txnId, $access_token);
    }

}