<?php

namespace App\Http\Controllers\Admin;

use App\Gedung;
use App\Kota;
use App\Pendaftaran;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGedungRequest;
use App\Http\Requests\Admin\UpdateGedungRequest;
use Validator;
use ZipArchive;
use Mpdf\Mpdf;
use Excel;
class GenerateController extends Controller
{
    


    public function index(){
        
        $kota = Kota::all();
        $gedung = Gedung::all();
        $totalPendaftar = Pendaftaran::count();        
        $ruangan = DB::table('gedung')->sum('banyak_ruangan');
        return view('admin.generate_ruangan.index',compact('gedung','kota','totalPendaftar','ruangan'));
    }
    
    public static function getTanggalFromLokasi($kota){
        $kota = Kota::where('nama_kota',$kota)->value("tes_akademik");
        return $kota;
    }

    public static function generateKartuPeserta($NISN){
        $pendaftar = Pendaftaran::where('NISN',$NISN)->get();
        
        if($pendaftar->count()==0){
            echo "NISN tidak ada";
        }else{
        $pendaftar = $pendaftar->toArray()[0];
        if($pendaftar["foto"]=="offline"){
            $pendaftar["foto"]="blank.jpg";
        }
        $pathImage = "uploads/".$pendaftar["foto"];
        $html='
        
        <html>
        <head>
        <style> 
        
        
        #rcorners1 {
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px; 
            width: 600px;
            height: 400px;  
        }
        
        #imageContainer {
          float:left;
          width: 200px;
          height: 400px;  
        }


        #title {
          margin-left:30px;
          float:left;
          width: 250px;
          height: 150px;  
        }
        #titleImage {
          float:left;
          width: 100px;
          height: 100px;  
        }
        #titleText {
          float:left;
          width: 150px;
          height: 100px;  
        }
        #titleText>p {
          width: 300px;
          height: 0px;  
        }
        #titleText>h2 {
          width: 100px;
          height: 1px;  
        }
        
        
        #rcorners2 {
          border-radius: 25px;
          border: 2px solid black;
          padding: 20px; 
          width: 600px;
          height: 400px;  
        }
        #rcorners2>h5{
          width: 800px;
          height: 1px; 
        }
        #info {
          border-radius: 25px;
          margin: auto;
          border: 2px dotted black;
          padding: 20px; 
          width: 600px;
          height: 200px;  
        }
        @page {
            margin-top: 10px;
            margin-left:10px;
          }
        </style>
        </head>
        
        <body>
        
        <div id="rcorners1">
        
            <div id="imageContainer">
                <img src="'.$pathImage.'" height="200" width="250" border="5">
                <h1 style="font-family:courier;" align="center">'.$pendaftar["nomor_pendaftaran"].'</h1>
            </div>
           
            <div id="title">
                <div id="titleImage">
                    <img src="images/yasop_logo.jpeg" height="100" width="100" />
                </div>    
                <div id="titleText">
                <p style="font-size:16px"><b>
                    KARTU<br>
                    TANDA PESERTA<br>
                    SPSB YASOP 2020
                    </b>
                    </p>
                </div>
                </div>
               
                <br><br><br><br><br><br><br><br>
                
                
                <p align="center" style="margin-left:0px;font-family:courier;"><b>'.$pendaftar["nama_lengkap"].'</b></p><br>
                <p align="center" style="margin-left:0px;font-family:courier;">'.$pendaftar["smp"].'</p>
                <p align="center" style="margin-left:0px">R.'.$pendaftar["nomor_ruangan"].'</p>
            
            
            <!--
            
            <div id="name">
                <p align="center">'.$pendaftar["nama_lengkap"].'</p>
            </div>
            <div id="asalSekolah">
                <p align="center">'.$pendaftar["smp"].'</p>
            </div>
            <div id="nomorRuangan">
                <p align="center">R.'.$pendaftar["nomor_ruangan"].'</p>
            </div>
            -->
            
        </div>
        
        
        
        <hr style="border-top: dotted 1px;" />
        
        
        <div id="rcorners2">
        <p align="center">
            Seleksi Penerimaan Siswa Baru (SPSB)<br>
            Asrama Yayasan Tunas Bangsa Soposurung<br>
            T.P 2020/2021
            </p>
            
            <div id="info" >
                 <p align="center"><b><u>SELEKSI TAHAP I (Tes Akademik))</u></b></p>
                <p>HARI / TANGGAL : '.self::getTanggalFromLokasi($pendaftar["lokasi"]).'</p>
                <p>LOKASI : '.$pendaftar["gedung"].' </p>
                <p>09.00 - 10.30 (Matematika)<br> 11.00 - 12.00 (Bahasa higgris)<br> 13.00- 14.00 (IPA) </p>
            </div>
            Catatan :<br>
            * Pakaian : seragam SMP putih-biru dengan atribut lengkap<br>
            * Menggunakan pensil 2B dan kelengkapannya untuk LJK (seperti untuk UN)<br>
            * Hadir 1 jam sebelum tes dimulai<br>
            * Kartu ujian ini (ASLI) harus ditunjukkan pada setiap tahap seleksi dan 		pendaftaran ulang
        </div>
        
        
        
        </body>
        </html>
        ';
       
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('real');
        $mpdf->Output();
        }
    }
    public static function generateAll_DaftarHadir(){
        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 1; $nomorRuangan <= $namaGedung->banyak_ruangan; $nomorRuangan++) {
                    $mpdf = self::generateDaftarHadir($namaKota,$namaGedung->nama_gedung,$nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Daftar hadir kota ".$namaKota." - Gedung ".$namaGedung->nama_gedung." Ruangan {$nomorRuangan}.pdf", $pdfData);
                }
            }
        }
        $zip->close();
        header("Content-type: application/zip");
        header('Content-Disposition: attachment; filename=Daftar_hadir_all.zip'); 
        readfile($zipFile);
        unlink($zipFile);
        exit;
    }

    public static function generateDaftarHadir($namaKota,$namaGedung,$nomorRuangan){
        $totalPendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->count(); 
        $pendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->get();
        
        $html="
        <style>
       
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            
        </style>
        <table style='width:100%;border-collapse: collapse; border: none;'>
        <tr>
            <td style='width:15%;border: none;'>  <img src='images/yasop_logo.jpeg' height='100' width='100'></td>
            <td style='width:70%;border: none; ' align='center'>
            <h2>SELEKSI PENERIMAAN SISWA BARU (SPSB)</h2>
            <p style='font-size:160%;'>Asrama Yayasan Tunas Bangsa Soposurung</p>
            <p style='font-size:160%;'>T.P 2020/2021</p></td> 
            <td style='width:15%;border: none;'><img src='images/smu2.png' height='100' width='100'></td> 
       </tr>
       
    </table>
    <hr>

    <table style='width:50%;border-collapse: collapse; border: none;'>
        <tr style='border: none;'>
            <td style='border: none;'> <p><b> Ruang ujian </th>
            <td style='border: none;'> : ".$nomorRuangan."</b></p></td> 
       </tr>
       <tr style='border: none;'>
            <td style='border: none;'> <p><b> Lokasi </th>
            <td style='border: none;'> : ".$namaGedung."</b></p></td> 
       </tr>
       <tr style='border: none;'>
            <td style='border: none;'> <p><b> Jumlah Peserta :</th>
            <td style='border: none;'> : ".$totalPendaftar."</b></p></td> 
        </tr>
    </table>
<table style='width:100%'><tr>
        <th align='center'>Nomor</th>
        <th align='center'>Nomor Ujian</th> 
        <th align='center'>Nama</th>
        <th align='center'>Tanda Tangan</th>
      </tr>";
        for ($i = 0; $i <30; $i++)
        {
            $html .= "
            
            <tr>
              <td width='40' align='center'>".($i+1)."</td>";

            if(isset($pendaftar[$i])){
            $html .= "
            
              <td width='200' align='left'> ".$pendaftar[$i]['nomor_pendaftaran']."</td>
              <td width='200' align='left'>".$pendaftar[$i]['nama_lengkap']."</td>";
            }
            else{
                $html .= "
              <td width='200' align='left'> </td>
              <td width='200' align='left'></td>";
                

            }
              if($i%2>0){
                $html .= " <td align='right' width='200'>".($i+1)." _________  </td>";
              }
              else{
                $html .= " <td align='left' width='200'>".($i+1)." _________  </td>";
              }
        }
        $html .=" </tr>
                </table>";
       

        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        return $mpdf;

    }
    

    public static function generateAll_StikerMeja(){
        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 1; $nomorRuangan <= $namaGedung->banyak_ruangan; $nomorRuangan++) {
                    $mpdf = self::generateStikerMeja($namaGedung->kota,$namaGedung->nama_gedung,$nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Stiker meja ".$namaKota." - ".$namaGedung->nama_gedung." Ruangan {$nomorRuangan}.pdf", $pdfData);
                }
            }
        }
        $zip->close();
        header("Content-type: application/zip");
        header('Content-Disposition: attachment; filename=Stiker_Meja_All.zip'); 
        readfile($zipFile);
        unlink($zipFile);
        exit;
    }

    public static function generateStikerMeja($namaKota,$namaGedung,$nomorRuangan){
        $totalPendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->count(); 
        $pendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->get();
        $html="
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }   
        </style>
       
<table style='width:100%'>";

        for ($i = 0; $i < ceil($totalPendaftar/3); $i++)
        {
            $html .= "<tr>";
            for ($j = 0; $j < 4; $j++)  
            {  
                if(isset($pendaftar[($i*3)+$j])){
                    $html .= "<td align ='center'><br> Ruang ".$nomorRuangan."<br><p style='font-size:200%;'>".$pendaftar[($i*3)+$j]['nomor_pendaftaran']."<br></p></td>";
                }
                else{
                    $html .= "<td ></td>";
                }

            }
            $html .= "</tr>";
        
        }
        $html .=" </tr>
                </table>";
       
        $mpdf=new mPDF(['orientation' => 'L','format' => 'A4']);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        return $mpdf;

    }


    

    public static function generateAll_DataPeserta(){

        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 1; $nomorRuangan <= $namaGedung->banyak_ruangan; $nomorRuangan++) {
                    $mpdf = self::generateDataPeserta($namaKota,$namaGedung->nama_gedung,$nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Data peserta ".$namaKota." - ".$namaGedung->nama_gedung." Ruangan {$nomorRuangan}.pdf", $pdfData);
                }
            }
        }
        $zip->close();
        header("Content-type: application/zip");
        header('Content-Disposition: attachment; filename=Data_peserta_all.zip'); 
        readfile($zipFile);
        unlink($zipFile);
        exit;

    }



    public static function generateDataPeserta($namaKota,$namaGedung,$nomorRuangan){
        $totalPendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->count(); 
        $pendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->get();

        $html="
        <style>
       
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            
        </style>
        <table style='width:100%;border-collapse: collapse; border: none;'>
        <tr>
            <td style='width:15%;border: none;'>  <img src='images/yasop_logo.jpeg' height='100' width='100'></td>
            <td style='width:70%;border: none; ' align='center'>
            <h2>SELEKSI PENERIMAAN SISWA BARU (SPSB)</h2>
            <p style='font-size:160%;'>Asrama Yayasan Tunas Bangsa Soposurung</p>
            <p style='font-size:160%;'>T.P 2020/2021</p></td> 
            <td style='width:15%;border: none;'><img src='images/smu2.png' height='100' width='100'></td> 
       </tr>
       
    </table>
    <hr>

    <table style='width:50%;border-collapse: collapse; border: none;'>
        <tr style='border: none;'>
            <td style='border: none;'> <p><b> Ruang ujian </th>
            <td style='border: none;'> : ".$nomorRuangan."</b></p></td> 
       </tr>
       <tr style='border: none;'>
            <td style='border: none;'> <p><b> Lokasi </th>
            <td style='border: none;'> : ".$namaGedung."</b></p></td> 
       </tr>
       <tr style='border: none;'>
            <td style='border: none;'> <p><b> Jumlah Peserta :</th>
            <td style='border: none;'> : ".$totalPendaftar."</b></p></td> 
        </tr>
    </table>

<table style='width:100%'>
       <tr>
        <th align='center'>Nomor</th>
        <th align='center'>Nomor Ujian</th> 
        <th align='center'>Nama</th>
       
       </tr>";
        for ($i = 0; $i <32; $i++)
        {
            $html .= "
            
            <tr>
              <td width='40' align='center'>".($i+1)."</td>";

            if(isset($pendaftar[$i])){
            $html .= "
            
              <td width='200' align='left'><p> ".$pendaftar[$i]['nomor_pendaftaran']."</p></td>
              <td width='200' align='left'><p>".$pendaftar[$i]['nama_lengkap']."</p></td>";
            }
            else{
                $html .= "
              <td width='200' align='left'> </td>
              <td width='200' align='left'></td>";
                

            }
              
        }
        $html .=" </tr>
                </table>";
       

        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        return $mpdf;

    }

    
    public static function generateAll_Denah(){
        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 1; $nomorRuangan <= $namaGedung->banyak_ruangan; $nomorRuangan++) {
                    $mpdf = self::generateDenah($namaKota,$namaGedung->nama_gedung,$nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Denah ruangan ".$namaKota." - ".$namaGedung->nama_gedung." Ruangan {$nomorRuangan}.pdf", $pdfData);
                }
            }
        }
        $zip->close();
        header("Content-type: application/zip");
        header('Content-Disposition: attachment; filename=Denah_ruangan_all.zip'); 
        readfile($zipFile);
        unlink($zipFile);
        exit;

    }

    

    public static function generateDenah($namaKota,$namaGedung,$nomorRuangan){

        $totalPendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->count(); 
        $pendaftar = Pendaftaran::where('lokasi',$namaKota)->where('nomor_ruangan',$nomorRuangan)->where('gedung',$namaGedung)->get();
        $html="
        
        <!DOCTYPE html>
<html>
<head>
<style>

div.student {
   
    border: 1px solid #ccc;
    float: left;
    width: 90px;
  }
  div.sep {
   
    border: 1px solid #ccc;
    float: right;
    width: 10px;
  }

div.line {
    margin: 3px;
    border: 0px solid #ccc;
    float: left;
    width: 100%;
  }
  div.desk {
    
    border: 0px solid #ccc;
    float: left;
    width: 190px;
  }
  

div.room img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
</head>
<body>
<table style='width:100%;border-collapse: collapse; border: none;'>
        <tr>
            <td style='width:15%;border: none;'>  <img src='images/yasop_logo.jpeg' height='100' width='100'></td>
            <td style='width:70%;border: none; ' align='center'>
            <h2>SELEKSI PENERIMAAN SISWA BARU (SPSB)</h2>
            <p style='font-size:160%;'>Asrama Yayasan Tunas Bangsa Soposurung</p>
            <p style='font-size:160%;'>T.P 2020/2021</p></td> 
            <td style='width:15%;border: none;'><img src='images/smu2.png' height='100' width='100'></td> 
       </tr>
       
    </table>
    <hr>
        ";

        $html .= "              <div class='student' style='margin-left:300px' >
                                    <div class='desc'><img src='uploads/blank.jpeg'></div>
                                    <p align='center'>PENGAWAS</p>
                                </div>
                                <div class='student' >
                                    <div class='desc'><img src='uploads/blank.jpeg'></div>
                                    <p align='center'>PENGAWAS</p>
                                </div>
                            
                        ";
        for ($i = 0; $i < 4; $i++)
        {
            $html .= "<div class ='line'>";
            for($j=0;$j<4;$j++){

                $html .= "<div class ='desk'>";
                for($k=1;$k<=2;$k++){
                    if(isset($pendaftar[(($j*2)+$k + ($i*8)-1)])){
                        $index = $pendaftar[(($j*2)+$k + ($i*8)-1)]['nomor_pendaftaran'];
                        if($pendaftar[(($j*2)+$k + ($i*8)-1)]['foto']=="offline"){
                            $path = "uploads/blank.jpeg";
                        }else{
                            $path = "uploads/foto/".$pendaftar[(($j*2)+$k + ($i*8)-1)]['foto']."";
                        }
                        
                    }
                    else{
                        $index = " ";
                        $path = "uploads/blank.jpeg";
                    }


                    $imageBody = "<img src='".$path."' >";
                    
                    $html .= "  <div class='student' >
                    
                                    <div class='desc'>".$imageBody."</div>
                                    <p align='center'>".$index."</p>
                                </div>
                               
                        ";
                }
                $html .= "</div>";
            }
            $html .= "</div>";
        }
        $html .=" 

        </body>
        </html>";
        try{
        
                $mpdf=new mPDF(['mode' => 'utf-8',
                                'format' => 'A4',
                                'margin_left' => 2,
                                'margin_right' => 2,
                                'margin_top' => 10,
                                'margin_bottom' => 0,
                                'margin_header' => 0,
                                'margin_footer' => 0]);
                $mpdf->WriteHTML($html);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->debug = true;
                return $mpdf;
               
                }catch (\Mpdf\MpdfException $e) { 
                    echo $e->getMessage();
            }

    }

    
     
    public static function generatePdfByNamaKota($namaKota){
        $totalPendaftar = Pendaftaran::count(); 
        $pendaftar = Pendaftaran::all();
        $html="
        <style>
       
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }   
        </style>
        <p> Nama Kota : ".$namaKota."<p>
<table style='width:100%'><tr>
        <th align='center'>Nomor</th>
        <th align='center'>Nomor Ujian</th> 
        <th align='center'>Nama</th>
        <th align='center'>Tanda Tangan</th>
      </tr>";
        for ($i = 0; $i <= $totalPendaftar; $i++)
        {
            $html .= "
            
            <tr>
              <td >".($i+1)."</td>
              <td>".$pendaftar[$i]['nomor_pendaftaran']."</td>
              <td>".$pendaftar[$i]['nama_lengkap']."</td>";

              if($i%2>0){
                $html .= " <td align='right'>".($i+1)." _________  </td>";
              }
              else{
                $html .= " <td align='left'>".($i+1)." _________  </td>";
              }
        }
        $html .=" </tr>
                </table>";
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output();

    }


   

    public static function totalPendaftar($kota)
    {  
        $totalPendaftar = Pendaftaran::where('lokasi','=',$kota)->get()->count();
        return $totalPendaftar;
    }
    public static function totalRuanganUtama($kota)
    {  
        $totalRuangan = Kota::where('nama_kota','=',$kota)->get()->pluck('ruangan_utama');
        return $totalRuangan;
    }

    public static function getPendaftarRegional($kota){
        // $pendaftar_ = Pendaftaran::where('lokasi','=',$kota)->where('status_pembayaran','=',"lunas")->orderBy('index_pendaftar', 'asc')->get();
        // return $pendaftar_;
    }
    public static function getSekolah($nama_){
        $pendaftar_= Pendaftaran::where('nama_lengkap','=',$nama_)->get();
        return $pendaftar_;
    }
    public static function getLokasiByEmail($email){
        $pendaftar_byEmail= Pendaftaran::where('email','=',$email)->get();
        return $pendaftar_byEmail;
    }

    public  function getCountIndex(){
        $counter= Pendaftaran::where('status_pembayaran','=',"lunas")->count();
        return $counter;
    }

    public static function updatePayment($email) {
        
        DB::update('update pendaftar set status_pembayaran = ? where email = ?',["lunas",$email]);
       
     }
     public static function updateIndex($id,$email) {
         
        //DB::update('update pendaftar set index_pendaftar = ? where email = ?',[$id,$email]);
       
     }



    public static function viewGedung($kota)
    {  
        $viewGedung = Gedung::where('kota','=',$kota)->get();
        return $viewGedung;
    }
    
    public function create()
    {   $gedung = Gedung::all();
        $Gedung = \App\Gedung::get()->pluck('kode_gedung', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $max = Gedung::max('id');
        $kotas = \App\Kota::get()->pluck('nama_kota','nama_kota')->prepend(trans('quickadmin.qa_please_select'), '');
        
        return view('admin.gedung.create',compact('gedung','max','kotas'));
    }

    public static function generateKartu(){
        echo "boom";
    }

    public function store(Request $request){
        
        $request->validate([
            'import_file' => 'required'
        ]);
        $arr[] = [];
        $kumpulanData[]=[""];
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        
        
        if($data->count()){
            $i=0;
            foreach ($data as $key => $value) {
                $arr[$i] = $value->nomor_ujian;
                $i++;
            }

            for ($j=0;$j<$data->count();$j++){
                $nomorPendaftaran=$arr[$j];
                $kumpulanData[$j]=\App\Pendaftaran::where('nomor_pendaftaran', $nomorPendaftaran)->get()->toArray()[0];
            }
           
        }
        Excel::create('Data Mahasiswa bujang', function($excel) use($kumpulanData) {
            $excel->sheet('Data Mahasiswa', function($sheet) use($kumpulanData) {
                $sheet->fromArray($kumpulanData, null, 'A1', true);
        
                });
            })->export('xls');
    }

    public function generateKartuOffline(Request $request){
        $nisn = $request->nisn;
        return redirect('admin/generate/pdf/kartu_peserta/'.$nisn);
    }
    
   

    


    
    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kotas = \App\Kota::get()->pluck('nama_kota','nama_kota')->prepend(trans('quickadmin.qa_please_select'), '');
        $gedung = Gedung::findOrFail($id);

        return view('admin.gedung.edit', compact('gedung','kotas'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGedungRequest $request, $id)
    {
        
        
    }
    
    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $gedungs = \App\Gedung::where('id', $id)->get();

        $gedung = Gedung::findOrFail($id);

        return view('admin.gedung.show', compact('id', 'gedung','gedungs'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Gedung = Gedung::findOrFail($id);
        $Gedung->delete();

        return redirect()->route('admin.gedung.index');
    }




}
