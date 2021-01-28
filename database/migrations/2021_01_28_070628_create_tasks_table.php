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
            $table->mediumText('description');
            $table->dateTime('date');
            $table->string('address');
            (new \Database\MigrationHelper())->setForeignKey($table, 'states', 'state_id');
            $table->timestamps();
        });
        Schema::create('task_worker', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            (new \Database\MigrationHelper())->setForeignKey($table, 'workers', 'worker_id');
        });
        Schema::create('task_status', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            $table->string('status');
            (new \Database\MigrationHelper())->setForeignKey($table, 'users', 'user_id');
            $table->mediumText('reason')->nullable();
            $table->timestamps();
        });
        Schema::create('task_payment', function (Blueprint $table) {
            $table->id();
            (new \Database\MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            $table->date('date');
            $table->float('amount', 8, 2);
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
        Schema::dropIfExists('task_worker');
        Schema::dropIfExists('task_status');
        Schema::dropIfExists('task_payment');
        Schema::dropIfExists('tasks');
    }
}
