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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 200)->nullable();
            $table->text('description');
            $table->string('monthAmount', 200)->nullable();
            $table->string('annualAmount', 200)->nullable();
            $table->string('fee', 20)->default('2');
            $table->integer('isRecommended')->default(2);
            $table->integer('isFree')->default(2);
            $table->integer('hasFeatured')->default(2);
            $table->string('featuredDuration', 200)->nullable();
            $table->integer('status')->default(1);
            $table->string('created_at', 200)->nullable();
            $table->string('updated_at', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
