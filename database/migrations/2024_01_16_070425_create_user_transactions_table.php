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
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user');
            $table->string('reference', 150);
            $table->string('amount', 150);
            $table->string('currency', 150);
            $table->string('type', 150)->default('1');
            $table->string('accountTo', 150)->nullable();
            $table->string('transactionId', 150)->nullable();
            $table->string('newBalance', 100)->nullable();
            $table->integer('status')->default(2);
            $table->string('created_at', 150)->nullable();
            $table->string('updated_at', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
};
