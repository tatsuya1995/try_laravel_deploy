<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameOwner');
            $table->string('nameDriver');
            $table->date('dateDeparture');
            $table->Time('timeDeparture');
            $table->date('dateRevert');
            $table->Time('timeRevert');
            $table->string('nameCar');
            $table->integer('numPeople');
            $table->string('carNumber');
            $table->integer('subTotal');
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
        Schema::dropIfExists('contracts');
    }
}
