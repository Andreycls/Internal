<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GedungM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('gedung', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nama_gedung',100);
        //     $table->string('kode_gedung',100);
        //     $table->text('alamat');
        //     $table->text('kota');
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
        Schema::table('gedung', function (Blueprint $table) {
            //
        });
    }
}
