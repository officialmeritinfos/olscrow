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
        Schema::create('user_chat_messages', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('chatId', 150);
            $table->string('sender', 150);
            $table->string('receiver', 50)->nullable();
            $table->integer('seen')->default(2);
            $table->longText('message')->nullable();
            $table->string('created_at', 150)->nullable();
            $table->string('updated_at', 150)->nullable();
            $table->integer('deletedForSender')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_chat_messages');
    }
};
