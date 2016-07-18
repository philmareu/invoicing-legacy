<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Invoicing\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Invoicing\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->company,
        'address_1' => $faker->address,
        'address_2' => $faker->address,
        'city' => $faker->city,
        'state' => 'KS',
        'zip' => $faker->numberBetween(10000, 99999),
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(Invoicing\Models\Invoice::class, function (Faker\Generator $faker) {
    return [
        'invoice_number' => $faker->unique()->numberBetween(1, 10000),
        'unique_id' => $faker->unique()->word,
        'description' => $faker->paragraph,
        'due' => $faker->date(),
        'paid' => $faker->numberBetween(0, 1)
    ];
});

$factory->define(Invoicing\Models\WorkOrder::class, function (Faker\Generator $faker) {
    return [
        'scheduled' => $faker->date(),
        'description' => $faker->paragraph(),
        'rate' => $faker->numberBetween(30, 55),
        'completed' => $faker->numberBetween(0, 1)
    ];
});

$factory->define(Invoicing\Models\Task::class, function (Faker\Generator $faker) {
    return [
        'task' => $faker->paragraph(),
        'completed_at' => $faker->randomElement([null, $faker->date()])
    ];
});