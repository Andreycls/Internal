<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Pendaftaran extends Model
{
    protected $fillable = ['NISN',
                           'nama_lengkap',
                           'lokasi',
                           'email',
                           'jenis_kelamin',
                           'agama',
                           'tempat_lahir',
                           'tanggal_lahir',
                           'provinsi',
                           'kabkota',
                           'smp',
                           'nomor_hp',
                           'nama_ayah',
                           'nama_ibu',
                           'nomor_hp_wakil',
                           'pekerjaan_ayah',
                           'pekerjaan_ibu',
                           'alamat_orangtua',
                           'foto',
                           'nomor_pendaftaran',
                           'index_pendaftar',
                           'status_pembayaran'
                        
                        ];
    protected $table = 'pendaftar';
    //
}
