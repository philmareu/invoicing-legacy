<?php namespace Invoicing\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NavigationComposer {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $segment = $this->request->segment(1);
        $view->with(compact('segment'));
    }
}