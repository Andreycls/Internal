<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Kota extends Model
{
    protected $fillable = ['nama_kota','tes_akademik','ruangan_utama'];
    protected $table = 'kota';
    //
}
