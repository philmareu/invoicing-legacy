<?php namespace Invoicing\ViewComposers\DropDownLists; 

use Illuminate\Contracts\View\View;
use Invoicing\Models\WorkOrder;

class OpenWorkOrdersComposer {

    protected $workOrder;

    public function __construct(WorkOrder $workOrder)
    {
        $this->workOrder = $workOrder;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $workOrders = $this->workOrder
            ->with('invoice.client')
            ->whereCompleted(0)
            ->orderBy('scheduled', 'asc')
            ->get();

        $view->with('workOrders', $workOrders);
    }
}