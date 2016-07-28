<?php

namespace Invoicing\Console\Commands;

use Illuminate\Console\Command;
use Invoicing\Models\Invoice;

class UpdateBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reconcile:balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update balances on all invoices';

    protected $invoice;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        parent::__construct();
        $this->invoice = $invoice;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->invoice->all()->each(function($invoice) {
            $invoice->updateBalance();
        });
    }
}
