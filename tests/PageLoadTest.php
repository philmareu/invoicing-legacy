<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Invoicing\Models\User;

class PageLoadTest extends Tests\BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider provideAuthRoutes
     */
    public function testAuthPageLoads($method, $route)
    {
        $user = $this->createAndGetUser();

        $response = $this->actingAs($user)
            ->call($method, $route);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testLogout()
    {
        $user = $this->createAndGetUser();

        $response = $this->actingAs($user)
            ->call('POST', 'logout');

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function provideAuthRoutes()
    {
        return [
            ['GET', 'dashboard'],
            ['GET', 'clients'],
            ['GET', 'settings/edit'],
            ['GET', 'work-orders/completed'],
            ['GET', 'work-orders'],
            ['GET', 'invoices']
        ];
    }

    /**
     * @return mixed
     */
    private function createAndGetUser()
    {
        factory(Invoicing\Models\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'image' => 'blank.png',
        ])->each(function ($u) {
            $u->settings()->save(factory(Invoicing\Models\Setting::class)->make([
                'rate' => 85
            ]));
        });

        $user = User::find(1);
        return $user;
    }
}
