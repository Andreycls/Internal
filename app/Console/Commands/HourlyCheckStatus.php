<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pendaftaran;
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

    
    
    
    public function setIndexLokasiPeserta($nisn)
    {
        $lokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("lokasi");
        $indexPesertaByLokasi = (DB::table('pendaftar')->where('lokasi','=',$lokasi)->count())+1;
        DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['index_pendaftar_kota' => $indexPesertaByLokasi]);
        
    }

    
    public function handle(){
      
        error_log('have been hit :)');
        $currentDate = date("Ymd");
        $currentTime = date("h:i:sa");
        $startTime = date('H:i',strtotime('-1 hour ',strtotime($currentTime)));
        $endTime = date('H:i',strtotime('+0 hour ',strtotime($currentTime)));
        $response = app('App\Http\Controllers\BrivaHelper')->getReportVaByHour($currentDate,$startTime,$endTime); //Array scheduler
        DB::table('pendaftar')
                ->where('NISN', "9876545678")
                    ->update(['status_pembayaran' => "LUNAS"]);
        for ($index = 0; $index < count($response); $index++) {

           $nisn = $response[$index]["custCode"];
           DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['status_pembayaran' => "LUNAS"]);
           app('App\Http\Controllers\MailingHelper')->pushNotificationEmailAfterPay($nisn);
           $this->setIndexLokasiPeserta($nisn);
        } 
        
    }
}
