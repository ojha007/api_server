<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskJourneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_journey', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_worker_id');
            $table->foreign('task_worker_id')
                ->references('id')
                ->on('task_workers');
            $table->time('time');
            $table->enum('status', ['START', 'PAUSED', 'RESTART', 'END']);
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
        Schema::dropIfExists('task_journey');
    }
}
