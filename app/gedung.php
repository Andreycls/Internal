<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    //
    protected $fillable = ['nama_gedung','banyak_ruangan','alamat','kota','kode_gedung'];
    protected $table = 'gedung';
}
