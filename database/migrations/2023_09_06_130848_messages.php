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
        //
        //create new table messages
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            //save message as text
            $table->text('message');
            //save sender as user_id
            $table->unsignedBigInteger('user_sender_id');
            //save receiver as user_id
            $table->unsignedBigInteger('user_receiver_id');
            //save conversation as conversation_id
            $table->unsignedBigInteger('conversation_id');
            //save read as read
            $table->boolean('read')->default(false);
            //save created_at and updated_at
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
        //
    }
};
