<?php

use Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('enquiries');
        Schema::create('enquiries',function (Blueprint $table){
            $table->id();
         (new MigrationHelper())->setForeignKey($table, 'quotations', 'quotation_id', true);
            (new MigrationHelper())->setForeignKey($table, 'users', 'user_id', true);
            $table->string('name');
          $table->string('phone');
          $table->string('email');
          $table->longText('title');
          $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}
