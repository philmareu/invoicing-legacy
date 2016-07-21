<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('rate');
            $table->string('invoice_email');
            $table->string('invoice_address_1');
            $table->string('invoice_address_2');
            $table->string('invoice_city');
            $table->string('invoice_state');
            $table->string('invoice_zip');
            $table->string('invoice_phone');
            $table->text('invoice_note');
            $table->string('stripe_public')->nullable();
            $table->string('stripe_secret')->nullable();
            $table->timestamps();

            $table->index(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
