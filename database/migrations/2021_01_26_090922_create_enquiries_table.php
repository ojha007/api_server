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
            (new MigrationHelper())->setForeignKey($table, 'users', 'user_id', true);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code')->nullable();
            $table->timestamp('pickup_date');
            $table->timestamp('delivery_date');
            $table->string('optional_number')->nullable();
            $table->string('age')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
