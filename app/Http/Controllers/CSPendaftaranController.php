<?php

namespace App\Http\Controllers;
use App\Pengumuman;
use App\Pendaftaran;
use App\Jadwal;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePendaftaranRequest;
use Illuminate\Support\Facades\Gate;
use DB;
use Illuminate\Support\Facades\Input;
use Mailjet;
use Mailjet\LaravelMailjet\MailjetServiceProvider;
use \Mailjet\Resources;
use App\Http\Controllers\Admin\PendaftaranController;
use DateTime;

class CSPendaftaranController extends Controller
{
    var $acces_token = "";
    static $gmt_token;
    /**
     * Create a new controller instance.
     *
     * 
     */
    public function __construct()
    {
      date_default_timezone_set('Asia/Jakarta');
      
      
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {           
                app('App\Http\Controllers\BrivaHelper')->getOrGenerateToken();
                $startDate = "2019-11-06";
                $endDate = "2019-11-06";
                $startTime = "06:30";
                $endTime = "13:30";

                //$this->getReportVaByHour($startDate,$startTime,$endTime);

                $propinsi = DB::table('propinsi')->pluck('nama_propinsi','id');
                $pengumuman = Pengumuman::all();
                $kota = DB::table('kota')->pluck('nama_kota','id');
                $agama = DB::table('agama')->pluck('nama_agama','id');
                $tanggal = Jadwal::where('tahun',"=","2019")->first();
        return view('client-side.pendaftaran', compact('tanggal','pengumuman','propinsi','kota','agama'));
    }
    public function getStates($id) 
{        
        $states = DB::table("kabkota")->where("id_propinsi",$id)->pluck("nama_kabkota","id_kabkota");
        return json_encode($states);
}
    
    

    public function store(StorePendaftaranRequest $request)
    {
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
        if(Input::hasFile('file')){
			      $file = Input::file('file');
            $file->move('uploads', $timestamp.$file->getClientOriginalName());
            $request->merge(['foto' =>  $timestamp.$file->getClientOriginalName()]);
        }
        //DB::beginTransaction();
        $user = Pendaftaran::where('email',$request->input('email'))->first();
        $email = $request->input('email');
        $name = $request->input('nama_lengkap');
        $nisn = $request->input('NISN');
        $lokasi=$request->input('lokasi');
        $provId=$request->input('provinsi');
        $namaSekolah = $request->input('smp');
        $namaKabKota =$request->input('kabkota');
        
        if($provId<10){
          $idProv = '0'.'0'.$provId; 
        }
        else{
          $idProv = '0'.$provId;    
      }
        $requestData = $request->all();
        $pendaftaranCon = new PendaftaranController();
        $request->merge(['provinsi' => $pendaftaranCon->getProvName($provId)]);
        $request->merge(['foto' =>  $timestamp.$file->getClientOriginalName()]);
        
        $request->merge(['nomor_pendaftaran' =>$pendaftaranCon->generateNomorPendaftaran($lokasi,$provId,$namaKabKota,$namaSekolah)]);
        
        try 
        {
        $pendaftaran = Pendaftaran::create($request->all());
        app('App\Http\Controllers\BrivaHelper')->createEndpoint($nisn,$name);
        app('App\Http\Controllers\MailingHelper')->pushNotificationEmail($email,$name,$nisn,$lokasi);
        
        }
        catch( \Illuminate\Database\QueryException $e){
            return back()->withErrors(['NISN ini ('.$request->input('NISN').') sudah terdaftar']);
        }
        catch(Exception $e)
        {
          //DB::rollback();
          return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
        }
        return back()->with('success','Selamat, anda telah melakukan registrasi. Selanjutnya silahkan cek email');

    }

  
      

      

}
