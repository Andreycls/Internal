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

    
    
    
    public function setIndexLokasiPeserta($nisn)
    {
        $lokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("lokasi");
        $indexPesertaByLokasi = (DB::table('pendaftar')->where('lokasi','=',$lokasi)->count())+1;
        DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['index_pendaftar_kota' => $indexPesertaByLokasi]);
        
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
           for ($index = 0; $index < count($response); $index++) {
                $nisn = $response[$index]["custCode"];
                DB::table('pendaftar')
                 ->where('NISN', $nisn)
                        ->update(['status_pembayaran' => "LUNAS"]);
                app('App\Http\Controllers\MailingHelper')->pushNotificationEmailAfterPay($nisn);
                $this->setIndexLokasiPeserta($nisn);
                } 
        }
        $this->info('Hourly checking...');
        
    }
}
