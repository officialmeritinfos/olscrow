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
        Schema::create('escort_verifications', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user');
            $table->string('liveVideo', 200)->nullable();
            $table->string('photo', 200)->nullable();
            $table->integer('status')->default(2);
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
        Schema::dropIfExists('escort_verifications');
    }
};
