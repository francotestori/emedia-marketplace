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
            $table->integer('from_wallet');
            $table->integer('to_wallet');
            $table->double('amount',8, 2)->default(0);
            $table->enum('type', ['DEPOSIT','PAYMENT','WITHDRAWAL']);
            $table->integer('event_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('invoice_description')->nullable();
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
