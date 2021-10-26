<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_users', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'chat_messages', 'message_id');
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'user_id', null);
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'customer_id', null);
            $table->longText('identifier')->nullable();
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
        Schema::dropIfExists('chat_users');
    }
}
