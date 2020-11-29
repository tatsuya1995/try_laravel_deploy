<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('_owner_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idOwner');
            $table->dateTime('departure');
            $table->dateTime('revert');
            $table->string('place');
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
        Schema::dropIfExists('_owner_schedules');
    }
}
