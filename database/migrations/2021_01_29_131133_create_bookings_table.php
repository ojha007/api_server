<?php

use Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            (new MigrationHelper())->setForeignKey($table, 'users', 'user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('moving_date');
            $table->string('moving_from_suburb');
            $table->string('moving_to_suburb');
            $table->string('pickup_address');
            $table->string('dropoff_address');
            $table->string('additional_address')->nullable();
            $table->string('access_parking');
            $table->string('additional_service')->nullable();
            $table->string('size_of_moving');
            $table->string('hear_about_us')->nullable();
            $table->string('inventory')->nullable();
            $table->string('comments')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
