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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('feedbackMail', 150)->default('feedback@oloscrow.com');
            $table->string('investorMail', 100)->default('invest@oloscrow.com');
            $table->string('phone');
            $table->string('address');
            $table->string('tagline');
            $table->string('description');
            $table->string('keywords');
            $table->string('penaltyFee')->default('5');
            $table->integer('emailVerification')->default(2);
            $table->string('currency')->default('USD');
            $table->string('codeExpire', 100)->default('30 Minutes');
            $table->string('logo', 150)->nullable();
            $table->string('logo2', 150)->nullable();
            $table->string('favicon', 150)->nullable();
            $table->string('featuredFee', 30)->default('10');
            $table->string('refBonus', 50)->default('5');
            $table->string('affiliateCommission', 100)->default('10');
            $table->string('bookingAcceptanceTime', 50)->default('30 minutes');
            $table->string('clientTimeToApproveBooking', 100)->default('1 Hour');
            $table->string('supportInterveneTime', 100)->default('30 Minutes');
            $table->timestamps();
            $table->integer('subscriptionChargeRetry')->default(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
