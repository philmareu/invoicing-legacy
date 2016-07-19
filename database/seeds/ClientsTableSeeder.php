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
        factory(Invoicing\Models\Client::class, 10)->create()->each(function($c) {
            $this->addInvoices($c, rand(2, 5));
            $this->addNotes($c, rand(1, 3));
        });
    }

    private function addInvoices($client, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $invoice = $client->invoices()->save(factory(Invoicing\Models\Invoice::class)->make());
            $this->addWorkOrders($invoice, rand(1, 2));
            $this->addNotes($invoice, rand(1, 2));
        }
    }

    private function addWorkOrders($invoice, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $workOrder = $invoice->workOrders()->save(factory(Invoicing\Models\WorkOrder::class)->make());
            $this->addTasksToWorkOrders($workOrder, rand(3, 5));
            $this->addTimesToWorkOrders($workOrder, rand(1, 3));
            $this->addNotes($workOrder, rand(3, 5));
        }
    }

    private function addTasksToWorkOrders($workOrder, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $workOrder->tasks()->save(factory(Invoicing\Models\Task::class)->make());
        }
    }

    private function addTimesToWorkOrders($workOrder, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $workOrder->times()->save(factory(Invoicing\Models\Time::class)->make());
        }
    }

    private function addNotes($model, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $model->notes()->save(factory(Invoicing\Models\Note::class)->make());
        }
    }
}
