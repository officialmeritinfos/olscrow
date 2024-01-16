<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user');
            $table->string('reference');
            $table->string('currency');
            $table->string('amount');
            $table->string('amountToPay', 200)->nullable();
            $table->string('amountCredit', 100)->default('0');
            $table->string('amountPaid', 100)->nullable();
            $table->string('type', 110)->default('Balance');
            $table->string('charge', 100)->default('0');
            $table->string('channel');
            $table->string('paymentReference')->nullable();
            $table->string('transactionId', 100)->nullable();
            $table->string('orderReference')->nullable();
            $table->string('flutterRef')->nullable();
            $table->string('bank', 200)->nullable();
            $table->string('accountNumber', 200)->nullable();
            $table->string('accountName', 200)->nullable();
            $table->integer('paymentStatus')->default(2);
            $table->string('expiryDate', 200)->nullable();
            $table->text('sessionId')->nullable();
            $table->integer('status')->default(2);
            $table->softDeletes();
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
        Schema::dropIfExists('user_deposits');
    }
};
