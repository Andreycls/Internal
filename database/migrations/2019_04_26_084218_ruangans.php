<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ruangansq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // Schema::create('ruangan', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nama_ruangan',100);
        //     $table->string('kode_gedung',100);
        //     $table->integer('kapasitas');
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
        Schema::table('ruangan', function (Blueprint $table) {
            Schema::dropIfExists('ruangan');
        });
    }
}
