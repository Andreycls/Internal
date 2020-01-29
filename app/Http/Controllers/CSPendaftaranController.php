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
use Mpdf\Mpdf;
use Intervention\Image\ImageManagerStatic as Image;

class CSPendaftaranController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * 
     */
    public function __construct()
    {
      // $mpdf = new mPDF();
      // $mpdf->WriteHTML('Hello World');
      // $mpdf->Output();
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
          date_default_timezone_set('Asia/Jakarta');

          $propinsi = DB::table('propinsi')->pluck('nama_propinsi','id');
          $pengumuman = Pengumuman::all();
          $kota = DB::table('kota')->pluck('nama_kota','id');
          $agama = DB::table('agama')->pluck('nama_agama','id');
          $tanggal = Jadwal::where('tahun',"=","2020")->first();
          $listKota = json_decode($tanggal["kota"]);
          return view('client-side.pendaftaran', compact('listKota','tanggal','pengumuman','propinsi','kota','agama'));
    }
    
    public function getStates($id) 
    {        
        $states = DB::table("kabkota")->where("id_propinsi",$id)->pluck("nama_kabkota","id_kabkota");
        return json_encode($states);
    }
    
    

    public function store(StorePendaftaranRequest $request)
    {
        $timestamp = gmdate("YmdTHis000Z");
        if(Input::hasFile('file')){
			      $file = Input::file('file');
            
            $guessExtension = $request->file('file')->guessExtension();
            $img = Image::make($file)
                ->resize(300, 400, function ($constraint) {
                  $constraint->aspectRatio();
                })->save(public_path('uploads/foto/'.$timestamp.'.'.$guessExtension ));
            $request->merge(['foto' =>  $timestamp.'.'.$guessExtension]);
        }
        $user = Pendaftaran::where('email',$request->input('email'))->first();
        $email = $request->input('email');
        $name = $request->input('nama_lengkap');
        $nisn = $request->input('NISN');
        $lokasi=$request->input('lokasi');
        $provId=$request->input('provinsi');
        $namaSekolah = $request->input('smp');
        $namaKabKota =$request->input('kabkota');
        
        $requestData = $request->all();
        $pendaftaranCon = new PendaftaranController();
        $request->merge(['provinsi' => $pendaftaranCon->getProvName($provId)]);
        $request->merge(['foto' =>  $timestamp.'.'.$guessExtension]);
        $request->merge(['index_pendaftar' =>  $pendaftaranCon->getIndexPesertaByKota($lokasi)]);
        
        try 
        {
          DB::beginTransaction();
          $pendaftaran = Pendaftaran::create($request->all());
          //app('App\Http\Controllers\BrivaHelper')->createEndpoint($nisn,$name);
          //app('App\Http\Controllers\MailingHelper')->pushNotificationEmail($email,$name,$nisn,$lokasi);
          DB::commit();
        }
        catch( \Illuminate\Database\QueryException $e){
          DB::rollBack();
          return back()->withErrors(['NISN ini ('.$request->input('NISN').') sudah terdaftar']);
        }
        catch(Exception $e)
        {
          DB::rollback();
          return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
        }
        return back()->with('success','Selamat, anda telah melakukan registrasi. Selanjutnya silahkan cek email');

    }

  
      

      

}
