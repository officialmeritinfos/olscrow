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
        Schema::create('escort_photos', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user');
            $table->string('reference', 200);
            $table->string('photo', 200);
            $table->integer('isProfile')->default(2);
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
        Schema::dropIfExists('escort_photos');
    }
};
