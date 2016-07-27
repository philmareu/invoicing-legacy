<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('payment_type_id');
            $table->date('date');
            $table->string('note');
            $table->integer('amount');
            $table->timestamps();

            $table->index(['invoice_id', 'payment_type_id']);
            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
