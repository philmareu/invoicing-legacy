<?php

namespace Invoicing\Http\Controllers;

class AccountController extends Controller {
	
	protected $layout = 'layouts.default';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		
		$user = User::with('accounts')->find($user->id);
		
		$attached = Account::with('users')->find($user->primary_account()->id);
		
		return View::make('account.index', compact('user', 'attached'));
	}
	
	public function edit()
	{
		$user = Auth::user();
		
		$user = User::with('accounts')->find($user->id);
		$account = Account::find(getAccountId());
		$workorderTypes = WorkorderType::restrict()->lists('title', 'id');
		
		return View::make('account.edit', compact('user', 'account', 'workorderTypes'));
	}
	
	public function update()
	{
		$user = Auth::user();
		$inputs = Input::all();
		
		$validator = Validator::make($inputs, Config::get('validation.account'));
		
		if ($validator->fails())
		{
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
		
		// Email exists?
		$checkUser = User::whereEmail($inputs['email'])->first();
		
		if($checkUser && $checkUser->email != $user->email)
		{
			Session::flash('flash_message', 'The email address is not available');
			return Redirect::back();
		}
		
		$account = Account::find(getAccountId());
		$account->update($inputs);
		
		
		if(Input::hasFile('image'))
		{
			$image = Input::file('image');
			
			$filename = str_random(60) . '.' . $image->getClientOriginalExtension();
			
			$image = Image::make($image->getRealPath())
				->resize(100, null, function ($constraint) {
    				$constraint->aspectRatio();
					$constraint->upsize();
				});
				
			$image->save(storage_path('images/' . $filename));
			
			$account->image = $filename;
		}
		
		$account->save();
		
		$account = DB::table('account_user')
			->where('user_id', $user->id)
			->where('default', 1)
			->first();

		if($inputs['default_account'] != $account->account_id)
		{
			// @todo This should be a transaction
			$new_default = DB::table('account_user')
				->where('user_id', $user->id)
				->where('account_id', $inputs['default_account'])
				->first();

			if(count($new_default))
			{
				DB::table('account_user')
					->where('id', $new_default->id)
					->update(array('default' => 1));

				DB::table('account_user')
					->where('id', $account->id)
					->update(array('default' => 0));
			}
		}
			
		$user->email = $inputs['email'];
		$user->first_name = $inputs['first_name'];
		$user->last_name = $inputs['last_name'];
		if($inputs['password']) $user->password = $inputs['password'];
			
		if($user->save())
		{
			Session::flash('flash_message', 'Settings saved!');
			
			return Redirect::to('account/edit');
		}
		else
		{
				
		}

	}
	
	public function select($id)
	{
		$account = DB::table('account_user')
			->where('account_id', $id)
			->where('user_id', getUserId())
			->first();
			
		if(count($account))
		{
			Session::put('user.account_id', $account->account_id);
		}
		
		return Redirect::to('dashboard');
	}
	
	public function billing()
	{
		
	}
	
	public function signup()
	{
		$user = Auth::user();
						
		if ($user->subscribed())
		{
			return Redirect::to('account/billing');
		}
		
		return View::make('account/billing/signup', compact('user'));
	}
	
	public function processPayment()
	{
		$user = Auth::user();
		
		$customer = [
			'email' => $user->email,
			'description' => 'testing man'
		];

		$user->subscription(Input::get('plan'))
			->create(Input::get('stripe-token'), $customer);
	}
}