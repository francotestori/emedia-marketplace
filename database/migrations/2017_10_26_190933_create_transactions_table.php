<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_id');
            $table->enum('type', ['DEPOSIT','WITHDRAWAL','CHARGE','PAYMENT']);
            $table->integer('credits');
            $table->integer('event_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('invoice_description')->nullable();
            $table->double('price', 2)->default(0);
            $table->string('payment_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
