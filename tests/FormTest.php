<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Invoicing\Models\User;

class FormTest extends Tests\BrowserKitTestCase
{
    use DatabaseMigrations;

    public function testCreateClientThroughForm()
    {
        $this->actingAs(User::create(['email' => 'admin@admin.com', 'password' => bcrypt(str_random())]))
            ->visit('clients/create')
            ->type('Bob Bobberson', 'title')
            ->type('1234 North Street', 'address_1')
            ->type('Apt 2000', 'address_2')
            ->type('Lawrence', 'city')
            ->type('KS', 'state')
            ->type('66044', 'zip')
            ->type('785-555-5555', 'phone')
            ->type('invoice@email.com', 'invoicing_email')
            ->press('Save')
            ->seePageIs('clients/1');
    }
}
