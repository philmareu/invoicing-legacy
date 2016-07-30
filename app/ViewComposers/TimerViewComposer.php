<?php namespace Invoicing\ViewComposers; 

use Illuminate\Contracts\View\View;
use Invoicing\Models\Time;

class TimerViewComposer {

    protected $time;

    public function __construct(Time $time)
    {
        $this->time = $time;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $timer = $this->time
            ->with('workOrder.invoice.client')
            ->whereNull('time')->first();

        $view->with(compact('timer'));
    }

}