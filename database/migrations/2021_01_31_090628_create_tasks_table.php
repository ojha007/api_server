<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            (new \Database\MigrationHelper())->setForeignKey($table, 'bookings', 'booking_id');
            $table->longText('description')->nullable();
            $table->dateTime('start_time')->nullable();
            
            $table->dateTime('end_time')->nullable();
            $table->longText('images')->nullable();
            $table->timestamps();
        });
        Schema::create('task_workers', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'worker_id');
        });
        Schema::create('task_status', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            $table->string('status');
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'user_id');
            $table->mediumText('reason')->nullable();
            $table->timestamps();
        });
        Schema::create('booking_payments', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'bookings', 'booking_id');
            $table->float('amount', 8, 2);
            $table->string('payment_currency');
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'created_by');
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('task_workers');
        Schema::dropIfExists('task_status');
        Schema::dropIfExists('booking_payments');
        Schema::dropIfExists('tasks');
    }
}
