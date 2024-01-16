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
        Schema::create('escort_profiles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('user', 150)->nullable();
            $table->string('education', 150)->nullable();
            $table->string('occupation', 150)->nullable();
            $table->text('about')->nullable();
            $table->string('ethnicity', 150)->nullable();
            $table->string('bustSize', 150)->nullable();
            $table->string('height', 150)->nullable();
            $table->string('weight', 150)->nullable();
            $table->string('build', 150)->nullable();
            $table->string('looks', 150)->nullable();
            $table->integer('smoker')->default(2);
            $table->string('sexualOrientation', 150)->nullable();
            $table->integer('incall')->default(1);
            $table->integer('outcall')->default(1);
            $table->text('languages')->nullable();
            $table->text('shortBio')->nullable();
            $table->string('services', 200)->nullable();
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
        Schema::dropIfExists('escort_profiles');
    }
};
