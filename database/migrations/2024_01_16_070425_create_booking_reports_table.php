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
        Schema::create('booking_reports', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('bookingId', 150);
            $table->string('reference', 150);
            $table->string('escortId', 150);
            $table->string('user', 150);
            $table->integer('supportIntervened')->default(2);
            $table->integer('closedByUser')->default(2);
            $table->integer('closedByEscort')->default(2);
            $table->integer('appealed')->default(2);
            $table->text('appealMessage')->nullable();
            $table->string('reportType', 150)->nullable();
            $table->text('reportDetail')->nullable();
            $table->integer('status');
            $table->text('verdict')->nullable();
            $table->mediumText('verdictMessage')->nullable();
            $table->string('agent', 150)->nullable();
            $table->string('timeSupportIntervene', 100)->nullable();
            $table->string('created_at', 150)->nullable();
            $table->string('updated_at', 150)->nullable();
            $table->integer('lastResponder')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_reports');
    }
};
