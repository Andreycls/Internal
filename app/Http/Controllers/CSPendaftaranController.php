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

class CSPendaftaranController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * 
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if(Input::hasFile('file')){
			$file = Input::file('file');
			$file->move('uploads', $file->getClientOriginalName());
        }
        
        $user = Pendaftaran::where('email',$request->input('email'))->first();

        $email = $request->input('email');
        $name = $request->input('nama_lengkap');
        try {
        
        $pendaftaran = Pendaftaran::create($request->all());
        // var_dump($request);
        }
        catch( \Illuminate\Database\QueryException $e){
            return back()->withErrors(['NISN ini ('.$request->input('NISN').') sudah terdaftar']);
            
          
        }
        //
        $mj = new \Mailjet\Client(getenv('MAILJET_APIKEY'), getenv('MAILJET_APISECRET'),true,['version' => 'v3.1']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "neverdefeatedxi@gmail.com",
                'Name' => "Mailjet Pilot".$email
            ],
            'To' => [
                [
                    'Email' => "andreyc@xlfutureleaders.com",
                    'Name' => "passenger 1"
                ]
            ],
            'Subject' => "TEST CUKK TEST",
            'TextPart' => "Dear ".$name.", welcome to Mailjet! May the delivery force be with you!",
            'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!"
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());
        //
        

        return back()->with('success','Selamat, anda telah melakukan registrasi. Selanjutnya silahkan cek email');
    }
}
