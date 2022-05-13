<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *  Class to create and provide the representative data storage allocation 
 *  depending on the local database system configuration
 * 
 */
class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Defining the table name and it's columns allocation with Model
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->string('log_message')->nullable();
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
        Schema::dropIfExists('activity_logs');
    }
}
