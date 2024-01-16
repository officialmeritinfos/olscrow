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
        Schema::create('escort_reviews', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('reviewer');
            $table->bigInteger('user');
            $table->text('content');
            $table->string('rating', 100)->nullable();
            $table->string('bookingId', 150)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('escort_reviews');
    }
};
