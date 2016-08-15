<?php

namespace Invoicing\Http\Controllers;

use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Invoicing\Http\Requests\UpdateSettingsRequest;

class SettingsController extends Controller {

	public function edit()
	{
        $timezones = array_combine(array_values(DateTimeZone::listIdentifiers()), array_values(DateTimeZone::listIdentifiers()));
		return view('settings.edit')
            ->with('user', Auth::user())
            ->with('timezones', $timezones);
	}
	
	public function update(UpdateSettingsRequest $request)
	{
        $user = Auth::user();
        $settings = $user->settings;

        $user->update($request->only(['name', 'email']));
		if($request->hasFile('image'))
		{
			$image = $request->file('image');
			$filename = str_random(60) . '.' . $image->getClientOriginalExtension();
			
			$image = Image::make($image->getRealPath())
				->resize(400, null, function ($constraint) {
    				$constraint->aspectRatio();
					$constraint->upsize();
				});
				
			$image->save(storage_path('app/images/' . $filename));
			
			$user->image = $filename;
		}
        if($request->has('password')) $user->password = bcrypt($request->password);
        $user->save();

        $settings->update($request->all());

        if($request->has('stripe_secret')) $settings->stripe_secret = $request->stripe_secret;
        $settings->save();

        return redirect(route('settings.edit'))->with('success', 'Settings updated!');
	}

    public function removeStripeKeys()
    {
        $settings = Auth::user()->settings;
        $settings->stripe_public = null;
        $settings->stripe_secret = null;
        $settings->save();

        return redirect(route('settings.edit'))->with('success', 'Stripe keys removed!');
    }
}