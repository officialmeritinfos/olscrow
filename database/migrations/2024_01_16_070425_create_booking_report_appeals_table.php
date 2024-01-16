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
        Schema::create('booking_report_appeals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('reportId');
            $table->bigInteger('escortId');
            $table->bigInteger('user');
            $table->text('appealMessage');
            $table->integer('type')->default(2);
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
        Schema::dropIfExists('booking_report_appeals');
    }
};
