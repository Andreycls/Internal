<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Ruangan extends Model
{
    protected $fillable = ['nama_ruangan','kode_gedung','kapasitas'];
    protected $table = 'ruangan';
    //
}
