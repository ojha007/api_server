<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('from_email');
            $table->mediumText('subject');
            $table->timestamp('schedule');
            $table->longText('message');
            $table->timestamps();
        });
        Schema::create('campaign_email', function (Blueprint $table) {
            $table->id();
            $table->string('to_email');
            (new \Database\MigrationHelper())->setForeignKey($table, 'campaigns', 'campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
