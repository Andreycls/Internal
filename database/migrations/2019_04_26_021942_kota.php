<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('kota', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nama_kota',100);
        //     $table->timestamps();
        // });
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
            // $table->dropColumn('kode_gedung');
            // $table->dropColumn('kapasitas');
            Schema::dropIfExists('kota');
        });
    }
}
