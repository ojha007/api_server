<?php

use Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            (new MigrationHelper())->setForeignKey($table, 'users', 'user_id');
            $table->mediumText('title');
            $table->longText('description');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            (new MigrationHelper())->setForeignKey($table, 'countries', 'country_id');
            $table->string('name');
        });
        Schema::create('pickup_address', function (Blueprint $table) {
            $table->id();
            (new MigrationHelper())->setForeignKey($table, 'enquiries', 'enquiry_id');
            (new MigrationHelper())->setForeignKey($table, 'states', 'state_id');
            $table->mediumText('street_one');
            $table->longText('street_two')->nullable();
            $table->integer('postal_code');
            $table->string('city');
        });
        Schema::create('delivery_address', function (Blueprint $table) {
            $table->id();
            (new MigrationHelper())->setForeignKey($table, 'enquiries', 'enquiry_id');
            (new MigrationHelper())->setForeignKey($table, 'states', 'state_id');
            $table->mediumText('street_one');
            $table->longText('street_two')->nullable();
            $table->integer('postal_code');
            $table->string('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_address');
        Schema::dropIfExists('pickup_address');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('enquiries');
    }
}
