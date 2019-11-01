<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Pengumuman extends Model
{
    //
    protected $fillable = ['title','content','author','file'];
    protected $table = 'Pengumuman';
}
