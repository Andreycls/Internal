<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pendaftaran;
class MinutelyCheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:emails';

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



    public function parseResponseToArray(){
        $response = "{\r\n  \"status\": true,\r\n  \"responseDescription\": \"Success\",\r\n  \"responseCode\": \"00\",\r\n  \"data\": [\r\n    {\r\n        \"brivaNo\": \"77777\",\r\n        \"custCode\": \"006224217245\",\r\n        \"nama\": \"AULIA RIFQA PRATIWI\",\r\n        \"keterangan\": \"\",\r\n        \"amount\": \"5000000.00\",\r\n        \"paymentDate\": \"2019-05-10 10:05:52.000\",\r\n        \"tellerid\": \"8879965\",\r\n        \"no_rek\": \"39101000322990\"\r\n    },\r\n    {\r\n        \"brivaNo\": \"77777\",\r\n        \"custCode\": \"5042301900012\",\r\n        \"nama\": \"SUMARI\",\r\n        \"keterangan\": \"\",\r\n        \"amount\": \"160000.00\",\r\n        \"paymentDate\": \"2019-05-10 10:05:31.000\",\r\n        \"tellerid\": \"1104447\",\r\n        \"no_rek\": \"39101000322990\"\r\n    }\r\n  ]\r\n}";
        $response=json_decode($response,true);
        $data = $response['data'];
        return $data;
    }

    
    public function notifyByEmail($nisn){
        $email = Pendaftaran::select('email')->where('NISN', $nisn)->get();

    }
    
    
    public function handle()
    {
        $response=$this->parseResponseToArray(); //Array
        for ($index = 0; $index <= count($response); $index++) {
           $nisn = $response[$index]["custCode"];
           DB::table('pendaftar')
                ->where('NISN', $nisn)
                ->update(['status_pembayaran' => "LUNAS"]);
        } 
        
    }
}
