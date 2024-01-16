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
        Schema::create('user_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference', 150)->nullable();
            $table->bigInteger('user');
            $table->bigInteger('escortId');
            $table->string('currency');
            $table->string('amount');
            $table->string('orderId');
            $table->integer('orderType')->default(1);
            $table->integer('paymentStatus')->default(2);
            $table->integer('approvedByUser')->default(2);
            $table->integer('approvedByEscort')->default(2);
            $table->integer('reported')->default(2);
            $table->text('report')->nullable();
            $table->text('reportMessage')->nullable();
            $table->string('country', 200)->nullable();
            $table->string('state', 200)->nullable();
            $table->string('location', 200)->nullable();
            $table->string('bookDate', 100)->nullable();
            $table->string('amountCredit', 100)->nullable();
            $table->string('timeAcceptBooking', 100)->nullable();
            $table->integer('rescheduled')->default(2);
            $table->integer('rescheduleAcceptedByUser')->default(2);
            $table->integer('rescheduleAcceptedByEscort')->default(2);
            $table->integer('requestForTransport')->default(2);
            $table->string('transportFee', 100)->default('0');
            $table->integer('transportStatus')->default(2);
            $table->string('timeToApproveByClient', 100)->nullable();
            $table->string('charge', 100)->default('0');
            $table->bigInteger('reportedBy')->nullable();
            $table->integer('appealed')->default(2);
            $table->string('timeToAppeal', 100)->nullable();
            $table->text('cancellationReason')->nullable();
            $table->text('transportRejectionReason')->nullable();
            $table->string('transactionId', 100)->nullable();
            $table->string('transportTranId', 100)->nullable();
            $table->bigInteger('reportId')->nullable();
            $table->string('referralAmount', 100)->nullable()->default('0');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->string('deleted_at', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_bookings');
    }
};
