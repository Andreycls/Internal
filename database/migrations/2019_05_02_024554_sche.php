<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('jadwal', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('tahun',100);
        //     $table->string('periodeMulai',100);
        //     $table->string('periodeAkhir',100);
        //     $table->string('registrasiOnlineBuka',100);
        //     $table->string('registrasiOnlineTutup',100);
        //     $table->string('registrasiLangsung',100);
        //     $table->string('registrasiTestIIHari1',100);
        //     $table->string('registrasiTestIIHari2',100);
        //     $table->string('registrasiFinal',100);
        //     $table->string('tesAkademik',100);
        //     $table->string('tesPsikologi',100);
        //     $table->string('tesInterview1',100);
        //     $table->string('tesInterview2',100);
        //     $table->string('pengumumanTesAkademik',100);
        //     $table->string('pengumumanFinal',100);

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
        Schema::table('jadwal', function (Blueprint $table) {
            //
        });
    }
}
