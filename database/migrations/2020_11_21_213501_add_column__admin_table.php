<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Admins', function (Blueprint $table) {
            $table->string('nameCar'); //カラム追加
            $table->integer('numPeople');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Admin', function (Blueprint $table) {
            $table->dropColumn('nameCar');
            $table->dropColumn('numPeople');

        });
    }
}
