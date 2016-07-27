<?php namespace Invoicing\ViewComposers; 

use Illuminate\Contracts\View\View;
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
        $user = User::find(1);

        $view->with(compact('user'));
    }
}