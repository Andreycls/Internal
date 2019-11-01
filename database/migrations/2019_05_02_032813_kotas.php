<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kota', function (Blueprint $table) {
            Schema::create('kota', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama_kota',100);
                $table->string('tes_akademik',100);
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kota', function (Blueprint $table) {
            //
            Schema::dropIfExists('kota');
        });
    }
}
