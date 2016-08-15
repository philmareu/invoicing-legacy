<?php 

namespace Invoicing\ViewComposers\DropDownLists;

use Illuminate\Contracts\View\View;
use Invoicing\Models\Invoice;

class WorkingInvoicesComposer {

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $invoices = $this->invoice
            ->with('client')
            ->whereNull('due')
            ->get();

        $view->with('invoices', $invoices);
    }

}