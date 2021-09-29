<?php

use Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_files',function (Blueprint  $table){
           $table->id();
           $table->string('url');
            (new MigrationHelper())->setForeignKey($table, 'tasks', 'task_id');
            $table->enum('type',['START','END','MIDDLE']);
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
}
