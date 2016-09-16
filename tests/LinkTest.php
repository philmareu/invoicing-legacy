<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Invoicing\Models\User;

class LinkTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogoutLink()
    {
        $user = $this->createAndGetUser();

        $this->actingAs($user)
            ->visit('dashboard')
            ->click('logout')
            ->seePageIs('login');
    }

    /**
     * @return mixed
     */
    private function createAndGetUser()
    {
        factory(User::class, 1)->create([
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
