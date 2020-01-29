<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pendaftaran;
use DB;
class HourlyCheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'continue:registration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an hourly check payment status';

    
    

    public function __construct()
    {
        parent::__construct();
    }

    public function getIdKabKota($namaKabKota){
        $idKabKota = DB::table('kabkota')->where('nama_kabkota','=',$namaKabKota)->value("id_kabkota");
        return $idKabKota;
      }
    
    
    

      public function setNomorRuangan($nisn){
        $indexLokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("index_pendaftar");
        $nomorRuangan = ceil($indexLokasi / 32);
        error_log("Nomor Ruangan: ".$nomorRuangan);
        DB::table('pendaftar')
                  ->where('NISN', $nisn)
                      ->update(['nomor_ruangan' => $nomorRuangan]);
  
      }
      public function getNomorRuangan($nisn){
        $nomorRuangan = DB::table('pendaftar')->where('NISN','=',$nisn)->value("nomor_ruangan");
        return $nomorRuangan;
      }

      public function setGedung($nisn,$indexGedung,$kota){
        $namaGedung = DB::table('gedung')->where('index','=',$indexGedung)->where('kota','=',$kota)->value("nama_gedung");
        error_log("Nama gedung: ".$namaGedung);
        DB::table('pendaftar')
                  ->where('NISN', $nisn)
                      ->update(['gedung' => $namaGedung]);
      }

      public function setNomorPendaftaran($namaKabKota,$provId,$nisn){
      
        $nomorPendaftaran= $this->getIdKabKota($namaKabKota)."-".$provId."-".$this->getIndexPesertaByKota($nisn);
        error_log("Nomor pendaftaran :".$nomorPendaftaran);
        DB::table('pendaftar')
                  ->where('NISN', $nisn)
                      ->update(['nomor_pendaftaran' => $nomorPendaftaran]);
      }

      public function setIndexGedung($kota,$nomorRuangan){
        $listGedungInKota = Gedung::where('kota',$kota)->orderBy('index', 'asc')->pluck('banyak_ruangan')->toArray();
        $number = $nomorRuangan;
        $indexGedung = 1;
        for($i=0;$i<count($listGedungInKota);$i++){
          if($number>$listGedungInKota[$i]){
            $indexGedung++;
            $number = $number-$listGedungInKota[$i];
          }else{
            break;
          }
        }
        return $indexGedung;
      }
      
      public function setIndexLokasiPeserta($nisn){
        $lokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("lokasi");
        $indexPesertaByLokasi = (DB::table('pendaftar')
                                  ->where('lokasi','=',$lokasi)->where('status_pembayaran','not like',"belum")->count());
        error_log("Lokasi : ".$lokasi." - Index Peserta:".$indexPesertaByLokasi);
        DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['index_pendaftar' => $indexPesertaByLokasi]);
        
    }
    
    public function handle(){
        date_default_timezone_set('Asia/Jakarta');
        error_log('have been hit :)');
        $currentDate = date("Y-m-d");
        $currentTime = date("h:i:sa");
        $startTime = date('H:m',strtotime('-1 hour ',strtotime($currentTime)));
        $endTime = date('H:m',strtotime('+0 hour ',strtotime($currentTime)));
        $response = app('App\Http\Controllers\BrivaHelper')->getReportVaByHour($currentDate,$startTime,$endTime); //Array scheduler
        $this->info("Offset :".var_dump($response));
        $this->info($currentDate." ".$startTime);
        if($response!=null){
           DB::beginTransaction();
           for ($index = 0; $index < count($response); $index++) {
                $nisn = $response[$index]["custCode"];
                DB::table('pendaftar')
                 ->where('NISN', $nisn)
                        ->update(['status_pembayaran' => "LUNAS"]);
                $this->setIndexLokasiPeserta($nisn);
                $this->setNomorPendaftaran($namaKabKota,$provId,$nisn);
                $this->setNomorRuangan($nisn);
                error_log("Gedung ke :".$this->setIndexGedung($lokasi,$this->getNomorRuangan($nisn)));
                $this->setGedung($nisn,$this->setIndexGedung($lokasi,$this->getNomorRuangan($nisn)),$lokasi);
                app('App\Http\Controllers\MailingHelper')->pushNotificationEmailAfterPay($nisn);
                
                }
            DB::commit(); 
            $this->info("register done");
        }
        $this->info($response[0]);
        $this->info('Hourly checking...');
        
    }
}
