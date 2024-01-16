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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('user')->nullable();
            $table->integer('twoFactor')->default(1);
            $table->integer('phoneNotification')->default(1);
            $table->integer('emailNotification')->default(1);
            $table->integer('newsletters')->default(1);
            $table->integer('withdrawalNotification')->default(1);
            $table->integer('depositNotification')->default(1);
            $table->integer('swapNotification')->default(1);
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
        Schema::dropIfExists('user_settings');
    }
};
