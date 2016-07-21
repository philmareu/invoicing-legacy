<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Invoicing\Models\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'image' => 'blank.png',
        ])->each(function($u) {
            $u->settings()->save(factory(Invoicing\Models\Setting::class)->make([
                'rate' => 85
            ]));
        });
    }
}
