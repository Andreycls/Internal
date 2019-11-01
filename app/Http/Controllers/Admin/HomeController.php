<?php

namespace App\Http\Controllers\Admin;

use App\Pengumuman;
use App\Panduan;
use App\User;
use App\Gedung;
use App\Kota;
use App\Pendaftaran;
//use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;
use DB;
use Khill\Lavacharts\Lavacharts;
use Lava;
use Mailjet;
use Mailjet\LaravelMailjet\MailjetServiceProvider;
class HomeController extends Controller
{
    
 




    public function index()
    {
       
       
    
    $url="https://api.github.com/users/petanikode";
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    $profile = json_decode($output, TRUE);
    //var_dump($profile['id']);
    curl_close($ch);    



$lava = new Lavacharts; // See note below for Laravel
$pendaftarOffline = Pendaftaran::where('foto','=','offline')->get();
$pendaftarOnline  = Pendaftaran::count() - $pendaftarOffline->count() ;
$totalPendaftar = Pendaftaran::count();

$reasons = Lava::DataTable();

$reasons->addStringColumn('Pendaftar')
        ->addNumberColumn('Jumlah')
        ->addRow(['Pendaftar Online ('.$pendaftarOnline.')', $pendaftarOnline])
        ->addRow(['Pendaftar Offline ('.$pendaftarOffline->count().')', $pendaftarOffline->count()]);

Lava::DonutChart('IMDB', $reasons, [
    'width' => 800,
    'height'=>400,
    'title' => 'Perbandingan peserta Online dan Offline (Total : '.Pendaftaran::count().')'
]);



$kota = Lava::DataTable();

$kota->addStringColumn('Pendaftar')
        ->addNumberColumn('Jumlah')
        ->addRow(['Toba Samosir ('.$pendaftarOnline.')', $pendaftarOnline])
        ->addRow(['Medan ('.$pendaftarOnline.')', $pendaftarOnline])
        ->addRow(['Jakarta ('.$pendaftarOffline->count().')', $pendaftarOffline->count()]);

Lava::DonutChart('kota', $kota, [
    'width' => 800,
    'height'=>500,
    'title' => 'Pesebaran asal peserta  (Total : '.Pendaftaran::count().')'
    ]);



                $pengumuman = Pengumuman::all();
                $panduan = Panduan::all();
                $user = User::all();
                $gedung = Gedung::all();
  //              $ruangan=Ruangan::all();
                $kota = Kota::all();
        return view('admin.home.home',compact('profile','totalPendaftar','kota','pengumuman','panduan','user','gedung'));
    }


}
