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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username');
            $table->string('reference');
            $table->string('referral')->nullable();
            $table->string('googleId')->nullable();
            $table->string('country')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneCode')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('mainCurrency')->nullable();
            $table->string('accountBalance', 100)->default('0');
            $table->string('transportBalance', 100)->default('0');
            $table->string('subscriptionBalance', 100)->default('0');
            $table->string('penaltyBalance', 100)->default('0');
            $table->string('referralBalance', 100)->default('0');
            $table->integer('status')->default(1);
            $table->integer('isVerified')->default(2);
            $table->integer('emailVerified')->default(2);
            $table->integer('internationalBooking')->default(2);
            $table->integer('accountType')->default(2);
            $table->string('displayName', 150)->nullable();
            $table->rememberToken();
            $table->integer('isLoggedIn')->default(2);
            $table->integer('isAdmin')->default(2);
            $table->integer('isStaff')->default(2);
            $table->string('role', 100)->nullable();
            $table->string('registrationIp', 200);
            $table->integer('isPublic')->default(2);
            $table->integer('isPro')->default(2);
            $table->integer('isOnline')->default(2);
            $table->string('fee', 50)->default('2');
            $table->integer('isEnrolled')->default(2);
            $table->integer('enrollmentType')->default(1);
            $table->string('package', 100)->nullable();
            $table->integer('fetaured')->default(2);
            $table->string('featuredEnd', 100)->nullable();
            $table->string('subRenewalDate', 100)->nullable();
            $table->integer('renewSubscription')->default(2);
            $table->string('lastLogin', 100)->nullable();
            $table->integer('referralType')->default(1);
            $table->integer('refType')->default(1);
            $table->string('otp', 200)->nullable();
            $table->string('otpExpires', 100)->nullable();
            $table->string('numberRetry', 100)->default('0');
            $table->string('nextRetry', 100)->default('0');
            $table->integer('hasAddon')->default(2);
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
        Schema::dropIfExists('users');
    }
};
