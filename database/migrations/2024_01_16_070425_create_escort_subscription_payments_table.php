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
        Schema::create('escort_subscription_payments', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user');
            $table->string('reference', 150)->nullable();
            $table->integer('package');
            $table->string('amount', 150);
            $table->string('currency', 150);
            $table->string('balanceAfter', 100)->default('0');
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
        Schema::dropIfExists('escort_subscription_payments');
    }
};
