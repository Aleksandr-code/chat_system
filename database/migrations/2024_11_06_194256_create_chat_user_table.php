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
        Schema::create('chat_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('chat_id');

            $table->index('user_id', 'chat_user_user_idx');
            $table->index('chat_id', 'chat_user_chat_idx');

            $table->foreign('user_id', 'chat_user_user_fk')->on('users')->references('id');
            $table->foreign('chat_id', 'chat_user_chat_fk')->on('chats')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_users');
    }
};
