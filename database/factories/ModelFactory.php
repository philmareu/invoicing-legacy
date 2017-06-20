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

$factory->define(Invoicing\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});


$factory->define(Invoicing\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->company,
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => 'KS',
        'zip' => $faker->numberBetween(10000, 99999),
        'phone' => $faker->phoneNumber,
        'invoicing_email' => $faker->email
    ];
});

$factory->define(Invoicing\Models\Invoice::class, function (Faker\Generator $faker) {
    return [
        'invoice_number' => $faker->unique()->numberBetween(1, 10000),
        'unique_id' => $faker->unique()->word,
        'description' => $faker->paragraph,
        'due' => $faker->date()
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

$factory->define(Invoicing\Models\Time::class, function (Faker\Generator $faker) {
    return [
        'start' => $faker->date(),
        'time' => $faker->numberBetween(10, 400),
        'note' => $faker->paragraph()
    ];
});

$factory->define(Invoicing\Models\Note::class, function (Faker\Generator $faker) {
    return [
        'note' => $faker->paragraph()
    ];
});

$factory->define(Invoicing\Models\InvoiceItem::class, function (Faker\Generator $faker) {
    return [
        'item' => $faker->sentence(),
        'amount' => $faker->numberBetween(5000, 450000)
    ];
});

$factory->define(Invoicing\Models\ClientContact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name(),
        'role' => $faker->word,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'note' => $faker->paragraph()
    ];
});

$factory->define(Invoicing\Models\PaymentType::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word
    ];
});

$factory->define(Invoicing\Models\Payment::class, function (Faker\Generator $faker) {
    return [
        'payment_type_id' => $faker->numberBetween(1, 6),
        'date' => $faker->date(),
        'note' => $faker->sentence(),
        'amount' => $faker->numberBetween(2000, 35000)
    ];
});

$factory->define(Invoicing\Models\Setting::class, function (Faker\Generator $faker) {
    return [
        'rate' => 85,
        'timezone' => 'America/Chicago'
    ];
});