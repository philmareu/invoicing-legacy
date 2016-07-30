<?php

namespace Invoicing\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Invoicing\Models\InvoiceItem;
use Invoicing\Models\Payment;
use Invoicing\Models\Time;
use Invoicing\Models\WorkOrder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setTimerActionViewComposers();
        view()->composer('partials.topbar', 'Invoicing\ViewComposers\NavigationComposer');
        view()->composer('partials.navigation.*', 'Invoicing\ViewComposers\NavigationComposer');
        view()->composer('*', 'Invoicing\ViewComposers\UserViewComposer');
        view()->composer('partials.navigation.workorders.sub', 'Invoicing\ViewComposers\DropDownLists\WorkingInvoicesComposer');
        view()->composer('partials.topbar', 'Invoicing\ViewComposers\DropDownLists\OpenWorkOrdersComposer');

        $this->modelEvents();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function setTimerActionViewComposers()
    {
        view()->composer('partials.topbar', 'Invoicing\ViewComposers\TimerViewComposer');
        view()->composer('workorders.show.sidebar', 'Invoicing\ViewComposers\TimerViewComposer');
    }

    private function modelEvents()
    {
        InvoiceItem::saved(function ($invoiceItem) {
            $invoiceItem->invoice->updateBalance();
        });

        Time::saved(function ($time) {
            $time->workOrder->invoice->updateBalance();
        });

        WorkOrder::saved(function ($workOrder) {
            $workOrder->invoice->updateBalance();
        });

        Payment::saved(function ($payment) {
            $payment->invoice->updateBalance();
        });

        InvoiceItem::deleted(function ($invoiceItem) {
            $invoiceItem->invoice->updateBalance();
        });

        Time::deleted(function ($time) {
            $time->workOrder->invoice->updateBalance();
        });

        WorkOrder::deleted(function ($workOrder) {
            $workOrder->invoice->updateBalance();
        });

        Payment::deleted(function ($payment) {
            $payment->invoice->updateBalance();
        });
    }
}
