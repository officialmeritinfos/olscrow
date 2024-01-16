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
        Schema::create('fiats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->string('sign');
            $table->string('rate', 200)->default('500');
            $table->string('country', 150)->nullable();
            $table->string('internationalFee', 150)->nullable()->default('3.9');
            $table->string('localFee', 150)->nullable()->default('1.5');
            $table->integer('hasPayout')->default(1);
            $table->integer('hasDirectPayout')->default(1);
            $table->integer('hasPeer')->default(1);
            $table->string('dailyTransfer', 100)->default('100');
            $table->string('dailyTransferVerified', 150)->default('3000');
            $table->string('accountLimit', 150)->default('100');
            $table->string('accountLimitVerified', 150)->nullable();
            $table->string('minAmount', 150)->default('100');
            $table->string('withdrawalFee', 100)->default('100');
            $table->string('toConversionCharge', 100)->nullable()->default('1');
            $table->string('fromConversionCharge', 100)->default('1');
            $table->string('payoutFee', 150)->default('0.3');
            $table->string('fixedPayoutFee', 150)->default('0');
            $table->integer('hasWithdrawalCap')->default(2);
            $table->string('withdrawalCap', 150)->default('0');
            $table->string('usdAccountPayoutFee', 150)->default('0.7');
            $table->string('fixedUsdAccountPayoutFee', 150)->default('10');
            $table->string('usdAccountPayoutCapping', 150)->default('0');
            $table->string('commission', 150)->default('50');
            $table->integer('canConvert')->default(2);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('fiats');
    }
};
