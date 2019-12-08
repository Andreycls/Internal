<?php

namespace App\Http\Controllers;
use App\Pengumuman;
use App\Panduan;
use App\Kota;
use App\Gedung;
use App\Http\Requests;  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;
use Illuminate\Support\Facades\Gate;
use DB;
use DateTime;
class BrivaHelper
{
    
    public function __construct(){
    }

    public function getOrGenerateToken(){

        $jsonString = file_get_contents(__DIR__ . '/token.json');
        $data = json_decode($jsonString, true);
        $currentDateTime = new \DateTime(date('Y-m-d H:i:s'));
        $savedDateTime = new DateTime($data['gmtToken']);
        $diff = $currentDateTime->diff($savedDateTime);
        $hours = $diff->h + ($diff->days*24);
        
        if($hours>=1){
          $data['gmtToken'] = $currentDateTime->format('Y-m-d H:i:s');
          $data['accessToken']= $this->generateToken()["access_token"];
          $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
          file_put_contents(__DIR__ . '/token.json', stripslashes($newJsonString));
        }
        return $data['accessToken'];
      }



    public function generateSignature($path,$verb,$token,$timestamp,$body,$secret){

        $payload = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$body";
        $signPayload = hash_hmac('sha256', $payload, $secret, true);
        $base64sign = base64_encode($signPayload);
        return $base64sign;
    }
  
    public function generateToken(){
      
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

  public function createEndpoint($custCode,$nama){
    $institutionCode = "J104408";
    $brivaNo = "77777";
    $amount="200000";
    $keterangan="Biaya Pendaftaran";
    $expiredDate="2017-09-10 09:57:26";
    $token = $this->getOrGenerateToken();
    $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
    $secret = "O0KvtNbiAjdaO59Z";
    $datas = array('institutionCode' => $institutionCode ,
     'brivaNo' => $brivaNo,
     'custCode' => $custCode,
     'nama' => $nama,
     'amount' => $amount,
     'keterangan' => $keterangan,
     'expiredDate' => $expiredDate );
    
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

  public function getReportVaByHour($currentDate,$startTime,$endTime)
        {

            $institutionCode = "J104408";
            $brivaNo = "77777";
            $custCode = "002876257";
            $verb = "GET";
            $secret = 'O0KvtNbiAjdaO59Z';
            $token = $this->getOrGenerateToken();
            $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
            $path = "/sandbox/v1/briva/report_time/j104408/77777/".$currentDate."/".$startTime."/".$currentDate."/".$endTime;
            $base64sign = $this->generateSignature($path, $verb, $token, $timestamp, $body = '', $secret);
    
            $request_headers = array(
                "Authorization:Bearer " . $token,
                "BRI-Timestamp:" . $timestamp,
                "BRI-Signature:" . $base64sign,
            );
    
            $urlPost ="https://partner.api.bri.co.id.".$path;
            $chPost = curl_init();
            curl_setopt($chPost, CURLOPT_URL,$urlPost);
            curl_setopt($chPost, CURLOPT_HTTPHEADER, $request_headers);
            curl_setopt($chPost, CURLINFO_HEADER_OUT, true);
            curl_setopt($chPost, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chPost, CURLOPT_TIMEOUT_MS, 400);
            $resultPost = curl_exec($chPost);
            $httpCodePost = curl_getinfo($chPost, CURLINFO_HTTP_CODE);
            curl_close($chPost);
            $response = json_decode($resultPost, true);
            return $response["data"] ;
        }




    
}
