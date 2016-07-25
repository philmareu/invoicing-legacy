<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class ProcessStripePaymentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unique_id' => 'required|exists:invoices,unique_id',
            'amount' => 'required|numeric|min:.01',
            'stripe-token' => 'required'
        ];
    }
}
