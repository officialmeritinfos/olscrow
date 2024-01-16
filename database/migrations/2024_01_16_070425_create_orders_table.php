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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user');
            $table->string('reference');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('client')->nullable();
            $table->string('currency');
            $table->string('amount');
            $table->string('overnight', 100)->default('0');
            $table->string('weekend', 100)->default('0');
            $table->integer('personalized')->default(2);
            $table->string('services', 100)->nullable();
            $table->string('numberOfOrder', 100)->default('0');
            $table->integer('status');
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
        Schema::dropIfExists('orders');
    }
};
