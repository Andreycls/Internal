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
class GenerateController extends Controller
{
    //
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        

        $kota = Kota::all();
        $gedung = Gedung::all();
        $totalPendaftar = Pendaftaran::count();        
        $ruangan = DB::table('gedung')->sum('banyak_ruangan');
        //var_dump($kota[2]->nama_kota);
        
        $emails = array("ADMINS@ADMIN.COM,ADMIN@ADMIN.COM,ANDREYC@XLFUTURELEADERS.COM");
        foreach ($emails as $email) {
           
            $this->updatePayment($email);
            //var_dump($this->getLokasiByEmail($email));
            $results = DB::select('select * from pendaftar where status_pembayaran = :id and lokasi = :kota', ['id' => "lunas",'kota'=>$this->getLokasiByEmail($email)]);
            $result_count=count($results);
            
            //$affected = DB::update('update pendaftar set index_pendaftar = ? where email = ?',[$result_count,$email]);
            $results=0;
       
            
        }

                

        return view('admin.generate_ruangan.index',compact('gedung','kota','totalPendaftar','ruangan'));
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
