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
class GenerateController extends Controller
{
    


    public function index()
    {
        
        $kota = Kota::all();
        $gedung = Gedung::all();
        $totalPendaftar = Pendaftaran::count();        
        $ruangan = DB::table('gedung')->sum('banyak_ruangan');
        return view('admin.generate_ruangan.index',compact('gedung','kota','totalPendaftar','ruangan'));
    }
    
    public static function generateAll_DaftarHadir(){
        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 0; $nomorRuangan < 2; $nomorRuangan++) {
                    $mpdf = self::generatePdfByNomorRuangan($namaKota,$namaGedung->nama_gedung,$nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Daftar hadir ".$namaKota." - ".$namaGedung->nama_gedung." Ruangan {$nomorRuangan}.pdf", $pdfData);
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

    public static function generateAll_StikerMeja(){
        $zip = new ZipArchive();
        $zipFile = tempnam('/tmp', 'zip');
        $zip->open($zipFile, ZipArchive::CREATE);
        $listKota = DB::table('kota')->pluck('nama_kota');
        foreach($listKota as $namaKota){
            $listGedung = \App\Gedung::where('kota', $namaKota)->get();
            foreach($listGedung as $namaGedung){
                for ($nomorRuangan = 0; $nomorRuangan < 2; $nomorRuangan++) {
                    $mpdf = self::generateStikerMeja($nomorRuangan);
                    $pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
                    $zip->addFromString("Stiker meja Ruangan {$nomorRuangan}.pdf", $pdfData);
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


    public static function generateDenah($nomorRuangan){


    }
    public static function generateStikerMeja($nomorRuangan){
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
       
<table style='width:100%'>";

        for ($i = 0; $i < ceil($totalPendaftar/3); $i++)
        {
            $html .= "<tr>";
            for ($j = 0; $j < 3; $j++)  
            {
                if(isset($pendaftar[($i*3)+$j])){
                    $html .= "<td align ='center'> Ruang ".$nomorRuangan."<br><p style='font-size:200%;'>".$pendaftar[($i*3)+$j]['nomor_pendaftaran']."</p></td>";

                }
                else{
                    $html .= "<td ></td>";
                }
                

            }
            $html .= "</tr>";
        
        }
        $html .=" </tr>
                </table>";
       


        $mpdf=new mPDF(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output();



    }

    public static function fillLokasiPeserta(){


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


    public static function generatePdfByNomorRuangan($namaKota,$namaGedung,$nomorRuangan){
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
        <p> Lokasi ujian : ".$namaKota."</p>
        <p> Nama gedung : ".$namaGedung."</p>
        <p> Nomor ruangan : ".$nomorRuangan."<p>
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
        //$content = $mpdf->Output('Daftar Hadir Ruangan '.$nomorRuangan.'.pdf', 'I');
        return $mpdf;
       
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
    public function store(StoreGedungRequest $request_)
    {
        // 
        $datas = $request_->except(['_token']);;
        //$kotas = $data['nama_kota'];
        $gedungs = $datas['nama_gedung'];
        $alamats = $datas['alamat'];
        $kotaq = $datas['kota'];
        $kodeGedungs= $datas['kode_gedung'];
        $banyakRuangan = $datas['banyak_ruangan'];

        // foreach($gedungs as $key ) {
        //     $gedung_ = new Gedung();
        //     $gedung_->nama_gedung = isset($gedungs[$key]) ? $gedungs[$key] : ''; //add a default value here
        //     //$gedung_->banyak_ruangan = isset($banyakRuangan[$key]) ? $banyakRuangan[$key] : '';
        //     $gedung_->alamat = isset($alamats[$key]) ? $alamats[$key] : ''; //add a default value here
        //     $gedung_->kota = isset($kotaq[$key]) ? $kotaq[$key] : '';
        //     $gedung_->kode_gedung = isset($kodeGedungs[$key]) ? $kodeGedungs[$key] : '';
        //     $gedung_->created_at = date("Y-m-d H:i:s"); 
        //     $gedung_->updated_at = date("Y-m-d H:i:s"); 
        //     $gedung_->save();
        //   }
          
        
          $rows = [];
        foreach($gedungs as $key => $input) {
        array_push($rows, [
        'nama_gedung' => isset($gedungs[$key]) ? $gedungs[$key] : '', //add a default value here
        'banyak_ruangan' => isset($banyakRuangan[$key]) ? $banyakRuangan[$key] : '',
        'alamat' => isset($alamats[$key]) ? $alamats[$key] : '', //add a default value here
        'kota' => isset($kotaq[$key]) ? $kotaq[$key] : '',
        'kode_gedung' => isset($kodeGedungs[$key]) ? $kodeGedungs[$key] : '',
        'created_at'=> date("Y-m-d H:i:s"),
        'updated_at'=> date("Y-m-d H:i:s"),
        ]);
        }
        Gedung::insert($rows);


        //$Gedung = Gedung::create($request_->all());


        //var_dump($banyakRuangan);
            return redirect()->route('admin.gedung.index');
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
        
        $gedung = Gedung::findOrFail($id);
        $gedung->update($request->all());



        return redirect()->route('admin.gedung.index');
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
