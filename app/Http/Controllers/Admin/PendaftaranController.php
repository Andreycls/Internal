<?php

namespace App\Http\Controllers\Admin;
use App\Panduan;
use App\Pendaftaran;
use App\Kota;
use App\Jadwal;
use App\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePendaftaranRequest;
use App\Http\Requests\Admin\StorePendaftaranRequestOffline;
use App\Http\Requests\Admin\UpdatePanduanRequest;
use DB;
use Illuminate\Support\Facades\Input;
use Mailjet;
use Mailjet\LaravelMailjet\MailjetServiceProvider;
use \Mailjet\Resources;
class PendaftaranController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftar = Pendaftaran::where('foto', '!=', 'offline')->paginate(1);;
        $pendaftarOnline = Pendaftaran::where('foto', '!=', 'offline')->paginate(10);
        $pendaftarOffline = Pendaftaran::where('foto', '=', 'offline')->paginate(10);

        return view('admin.pendaftaran.index', compact('pendaftar','pendaftarOnline','pendaftarOffline'));
    }
    public function indexOnline()
    {
        $pendaftar = Pendaftaran::where('foto', '!=', 'offline')->paginate(10);;
       $pendaftarOnline = Pendaftaran::where('foto', '!=', 'offline')->paginate(10);
        
        

        return view('admin.pendaftaran.indexOnline', compact('pendaftar','pendaftarOnline','pendaftarOffline'));
    }

    public function verifikasi()
    {
        $listPendaftar = Pendaftaran::where('status_pembayaran', '=', 'belum')->paginate(10);
        return view('admin.pendaftaran.verifikasi', compact('listPendaftar'));
    }
   
    public function verify($nisn){
        $pendaftaran = Pendaftaran::where('NISN', '=', $nisn);
        DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['status_pembayaran' => "lunas"]);

        return redirect()->route('admin.pendaftaran.verifikasi');
    }

    public function show($NISN)
    {
        $pendaftar = \App\Pendaftaran::where('NISN', $NISN)->get();


        return view('admin.pendaftaran.show', compact('NISN', 'pendaftar'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propinsi = DB::table('propinsi')->pluck('nama_propinsi','id');
        $smp = DB::table('DATA_SEKOLAH')->pluck('NAMA_SEKOLAH');
        
        $kota = DB::table('kota')->pluck('nama_kota','id');
        $agama = DB::table('agama')->pluck('nama_agama','id');
        return view('admin.pendaftaran.create', compact('smp','agama','propinsi','kota'));
    }

    public function getStates($id) 
{        
        $states = DB::table("kabkota")->where("id_propinsi",$id)->pluck("nama_kabkota","id_kabkota");
        return json_encode($states);
}
    public function getProvName($id){
      
        $namaProv = DB::table('propinsi')->where('id','=',$id)->value("nama_propinsi");
        return $namaProv;
    
    }
    public function getIndexPesertaBySekolah($namaSekolah){
      $banyakDiff = DB::table('pendaftar')->where('smp','=',$namaSekolah)->count();
      return $banyakDiff+1;
    }
    
    public function setIndexLokasiPeserta($nisn){
        $lokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("lokasi");
        $indexPesertaByLokasi = (DB::table('pendaftar')
                                  ->where('lokasi','=',$lokasi)->where('status_pembayaran','not like',"belum")->count());
        error_log("Lokasi : ".$lokasi." - Index Peserta:".$indexPesertaByLokasi);
        DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['index_pendaftar' => $indexPesertaByLokasi]);
        
    }

    public function getIndexPesertaByKota($nisn){
      $banyakDiff = DB::table('pendaftar')->where('nisn','=',$nisn)->value("index_pendaftar");
      return $banyakDiff;
    }

    public function setNomorRuangan($nisn){
      $indexLokasi = DB::table('pendaftar')->where('NISN','=',$nisn)->value("index_pendaftar");
      $nomorRuangan = ceil($indexLokasi / 32);
      error_log("Nomor Ruangan: ".$nomorRuangan);
      DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['nomor_ruangan' => $nomorRuangan]);

    }
    public function getNomorRuangan($nisn){
      $nomorRuangan = DB::table('pendaftar')->where('NISN','=',$nisn)->value("nomor_ruangan");
      return $nomorRuangan;
    }

    public function getIdLokasi($lokasi){
      $idLokasi = DB::table('kota')->where('nama_kota','=',$lokasi)->value("id");
      return $idLokasi; 
    }
    public function getIdKabKota($namaKabKota){
      $idKabKota = DB::table('kabkota')->where('nama_kabkota','=',$namaKabKota)->value("id_kabkota");
      return $idKabKota;
    }
    public function getKodeSekolah($namaSekolah){
      return "00";
    }
    

    public function setNomorPendaftaran($namaKabKota,$provId,$nisn){
      
      $nomorPendaftaran= $this->getIdKabKota($namaKabKota)."-".$provId."-".$this->getIndexPesertaByKota($nisn);
      error_log("Nomor pendaftaran :".$nomorPendaftaran);
      DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['nomor_pendaftaran' => $nomorPendaftaran]);
    }
    // 29
    // [20,4,19,3]
    public function setIndexGedung($kota,$nomorRuangan){
      $listGedungInKota = Gedung::where('kota',$kota)->orderBy('index', 'asc')->pluck('banyak_ruangan')->toArray();
      $number = $nomorRuangan;
      $indexGedung = 1;
      for($i=0;$i<count($listGedungInKota);$i++){
        if($number>$listGedungInKota[$i]){
          $indexGedung++;
          $number = $number-$listGedungInKota[$i];
        }else{
          break;
        }
      }
      return $indexGedung;
    }

    public function setGedung($nisn,$indexGedung,$kota){
      $namaGedung = DB::table('gedung')->where('index','=',$indexGedung)->where('kota','=',$kota)->value("nama_gedung");
      error_log("Nama gedung: ".$namaGedung);
      DB::table('pendaftar')
                ->where('NISN', $nisn)
                    ->update(['gedung' => $namaGedung]);
    }
    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StorePanduanRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendaftaranRequestOffline $request)
    {
        
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
        $request->merge(['foto' => "offline"]);
        $request->merge(['status_pembayaran' => "offline"]);
        $request->merge(['provinsi' => $pendaftaranCon->getProvName($provId)]);
       
        
        try {
          DB::beginTransaction();
          $pendaftaran = Pendaftaran::create($request->all());
          $this->setIndexLokasiPeserta($nisn);
          $this->setNomorPendaftaran($namaKabKota,$provId,$nisn);
          $this->setNomorRuangan($nisn);
          error_log("Gedung ke :".$this->setIndexGedung($lokasi,$this->getNomorRuangan($nisn)));
          $this->setGedung($nisn,$this->setIndexGedung($lokasi,$this->getNomorRuangan($nisn)),$lokasi);
          DB::commit();
          
        }catch( \Illuminate\Database\QueryException $e){
          DB::rollback();
          return back()->withErrors(['NISN ini ('.$request->input('NISN').') sudah terdaftar']);
        }catch(Exception $e)
        {
          DB::rollback();
          return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
        }
        
        return back()->with('success','Selamat, anda telah melakukan registrasi. Selanjutnya lakukan pembayaran');

    }
    

    



    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $panduan = Panduan::findOrFail($id);

        return view('admin.panduan.edit', compact('panduan'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePanduanRequest $request, $id)
    {
        
        $panduan = Panduan::findOrFail($id);
        $panduan->update($request->all());
        return redirect()->route('admin.panduan.index');
    }



    /**
     * Remove Role from storage.
     *
     * @param  int  $NISN
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        
        $pendaftaran = Pendaftaran::where('NISN', '=', $nisn);
        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index');
        
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('Panduan_delete')) {
            return abort(401);
        }
        if ($request->input('id')) {
            $entries = Panduan::whereIn('id', $request->input('id'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
