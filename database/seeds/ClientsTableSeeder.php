<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Invoicing\Models\Client::class, 10)->create()->each(function($m) {
            $this->addInvoice($m, rand(2, 5));
        });
    }

    private function addInvoice($client, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $invoice = $client->invoices()->save(factory(Invoicing\Models\Invoice::class)->make());
            foreach(range(1, rand(1, 2)) as $row) {
                $invoice->workOrders()->save(factory(Invoicing\Models\WorkOrder::class)->make());
            }
        }
    }
}
