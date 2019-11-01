<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
*/
class Jadwal extends Authenticatable
{
    protected $table = 'jadwal';    
    protected $fillable = [ 'tahun', 
                            'periodeMulai', 
                            'periodeAkhir', 
                            'registrasiOnlineBuka', 
                            'registrasiOnlineTutup', 
                            'registrasiLangsung', 
                            'registrasiTestIIHari1', 
                            'registrasiTestIIHari2', 
                            'registrasiFinal', 
                            
                            'tesPsikologi', 
                            'tesInterview1', 
                            'tesInterview2', 
                            'pengumumanTesAkademik',
                            'pengumumanFinal',
                            'kota'
                                ];
    
    
    
    /**
     * Hash password
     * @param $input
     */
    
}
