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

    private function addInvoice($member, $quantity = 100)
    {
        foreach(range(1, $quantity) as $row) {
            $member->invoices()->save(factory(Invoicing\Models\Invoice::class)->make());
        }
    }
}
