<?php namespace Invoicing\ViewComposers; 

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserViewComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        $view->with(compact('user'));
    }
}