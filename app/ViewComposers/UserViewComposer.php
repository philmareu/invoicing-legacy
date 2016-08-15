<?php namespace Invoicing\ViewComposers; 

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Invoicing\Models\User;

class UserViewComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::check() ? Auth::user() : null;

        $view->with(compact('user'));
    }
}