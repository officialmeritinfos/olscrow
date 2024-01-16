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
        Schema::create('user_features', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 14);
            $table->string('type', 11);
            $table->boolean('deleted');
            $table->string('created_at', 100)->nullable();
            $table->string('updated_at', 100)->nullable();
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_features');
    }
};
