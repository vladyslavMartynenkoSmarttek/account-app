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
        //create new table conversations
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //save members  as user1_id and user2_id
            $table->unsignedBigInteger('user1_id');
            $table->unsignedBigInteger('user2_id');
            //save last message as last_message_id
            $table->unsignedBigInteger('last_message_id')->nullable();
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
