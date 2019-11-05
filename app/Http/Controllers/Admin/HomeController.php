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
use APIHelper;

class HomeController extends Controller
{
    

    public function testAPI()
    {
        $url="https://partner.api.bri.co.id/sandbox/v1/briva/j104408/77777/123456789189";
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    $profile = json_decode($output, TRUE);
    curl_close($ch);    
    return $profile["status"]["code"];

    }

    public function getToken(){
        $url ="https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials";
        $data = "client_id=AeA1hnXOkF4rC7y5CCDEzschHxIuONHp&client_secret=O0KvtNbiAjdaO59Z";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($result, true);
        $accesstoken = $json['access_token'];
        return $json;
    }

    public function generateSignature($path,$verb,$token,$timestamp,$body,$secret){
        $payload = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$body";
        $signPayload = hash_hmac('sha256', $payload, $secret, true);
        $base64sign = base64_encode($signPayload);
        return $base64sign;
    }

    public function createVA(){
        $institutionCode = "J104408";
        $brivaNo = "77777";
        $custCode = "002876257";
        $nama="Andrey CLS";
        $amount="150000";
        $keterangan="";
        $expiredDate="2020-09-10 09:57:26";
        $token = $this->getToken()["access_token"];
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
        $secret = "O0KvtNbiAjdaO59Z";
        $datas = array(
         'institutionCode' => $institutionCode ,
         'brivaNo' => $brivaNo,
         'custCode' => $custCode,
         'nama' => $nama,
         'amount' => $amount,
         'keterangan' => $keterangan,
         'expiredDate' => $expiredDate 
        );
        
        $payload = json_encode($datas, true);
        
        $path = "/v1/briva";
        $verb = "POST";
        $base64sign = $this->generateSignature($path,$verb,$token,$timestamp,$payload,$secret);
        
        $request_headers = array(
                            "Content-Type:"."application/json",
                            "Authorization:Bearer " . $token,
                            "BRI-Timestamp:" . $timestamp,
                            "BRI-Signature:" . $base64sign,
                        );
        
        $urlPost ="https://sandbox.partner.api.bri.co.id/v1/briva";
        $chPost = curl_init();
        curl_setopt($chPost, CURLOPT_URL,$urlPost);
        curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($chPost, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
        curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);
        $resultPost = curl_exec($chPost);
        $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
        curl_close($chPost);
        $jsonPost = json_decode($resultPost, true);
        return $resultPost;
    }

    public function getReportVA(){
        
    }

    public function parseResponseToArray(){
        $response = "{\r\n  \"status\": true,\r\n  \"responseDescription\": \"Success\",\r\n  \"responseCode\": \"00\",\r\n  \"data\": [\r\n    {\r\n        \"brivaNo\": \"77777\",\r\n        \"custCode\": \"9987788\",\r\n        \"nama\": \"AULIA RIFQA PRATIWI\",\r\n        \"keterangan\": \"\",\r\n        \"amount\": \"5000000.00\",\r\n        \"paymentDate\": \"2019-05-10 10:05:52.000\",\r\n        \"tellerid\": \"8879965\",\r\n        \"no_rek\": \"39101000322990\"\r\n    },\r\n    {\r\n        \"brivaNo\": \"77777\",\r\n        \"custCode\": \"555\",\r\n        \"nama\": \"SUMARI\",\r\n        \"keterangan\": \"\",\r\n        \"amount\": \"160000.00\",\r\n        \"paymentDate\": \"2019-05-10 10:05:31.000\",\r\n        \"tellerid\": \"1104447\",\r\n        \"no_rek\": \"39101000322990\"\r\n    }\r\n  ]\r\n}";
        $response=json_decode($response,true);
        $data = $response['data'];
        return $data;
        
    }




    public function index() {
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
                        
            $response=$this->parseResponseToArray(); //Array
            $responseName = $response[1]["custCode"];
            for ($index = 0; $index < count($response); $index++) {
               $nisn = $response[$index]["custCode"];
               DB::table('pendaftar')
                    ->where('NISN', $nisn)
                    ->update(['status_pembayaran' => "LUNAS"]);
            } 
                        $responseCreateVA = json_encode($this->createVA());
                        $currentToken = $this->getToken();
                        $getStatusVA = $this->getReportVA();
                        $profile = $this->getToken()['access_token'];
                        $pengumuman = Pengumuman::all();
                        $panduan = Panduan::all();
                        $user = User::all();
                        $gedung = Gedung::all();
                        $kota = Kota::all();
                return view('admin.home.home',compact('responseName','getStatusVA','responseCreateVA','currentToken','totalPendaftar','kota','pengumuman','panduan','user','gedung'));
            }
        
        
}
