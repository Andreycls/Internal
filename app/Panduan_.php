<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Panduan extends Model
{
    //
    protected $fillable = ['question','answer','author','file'];
    protected $table = 'Panduan';
}
