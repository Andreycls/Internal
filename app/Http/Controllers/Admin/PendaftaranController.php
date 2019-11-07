<?php

namespace App\Http\Controllers\Admin;
use App\Panduan;
use App\Pendaftaran;
use App\Kota;
use App\Jadwal;
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
        $pendaftar = Pendaftaran::where('foto', '!=', 'offline')->paginate(1);;
       $pendaftarOnline = Pendaftaran::where('foto', '!=', 'offline')->paginate(1);
        
        

        return view('admin.pendaftaran.indexOnline', compact('pendaftar','pendaftarOnline','pendaftarOffline'));
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
        
        $kota = DB::table('kota')->pluck('nama_kota','id');
        $agama = DB::table('agama')->pluck('nama_agama','id');
        return view('admin.pendaftaran.create', compact('agama','propinsi','kota'));
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
    

    public function generateNomorPendaftaran($lokasi,$idProv,$namaKabKota,$namaSekolah){
      $pendaftaranCon = new PendaftaranController();
      $idLokasi = $pendaftaranCon->getIdLokasi($lokasi);
      $idProvinsi = $idProv;
      $idKabKota = $pendaftaranCon->getIdKabKota($namaKabKota);
      $indexPeserta = $pendaftaranCon->getIndexPesertaBySekolah($namaSekolah);
      $kodeSekolah = $pendaftaranCon->getKodeSekolah($namaSekolah);

      $nomorPendaftaran = $idLokasi.$idProvinsi."-".$idKabKota."-".$kodeSekolah.$indexPeserta;
      return $nomorPendaftaran;


    }
    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StorePanduanRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendaftaranRequestOffline $request)
    {
        // 
        DB::beginTransaction();
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
        $request->merge(['nomor_pendaftaran' =>$pendaftaranCon->generateNomorPendaftaran($lokasi,$provId,$namaKabKota,$namaSekolah)]);
        
        try {
        $pendaftaran = Pendaftaran::create($request->all());
        $this->createEndpoint($nisn,$name);
        $this->pushNotificationEmail($email,$name,$nisn,$lokasi);
    }
        catch( \Illuminate\Database\QueryException $e){
            return back()->withErrors(['NISN ini ('.$request->input('NISN').') sudah terdaftar']);
        }catch(Exception $e)
        {
          DB::rollback();
          return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
        }
        
        return back()->with('success','Selamat, anda telah melakukan registrasi. Selanjutnya silahkan cek email');

    }
    // public function rollback($nisn){

    // }

    public function generateSignature($path,$verb,$token,$timestamp,$body,$secret){
      $payload = "path=$path&verb=$verb&token=Bearer $token&timestamp=$timestamp&body=$body";
      $signPayload = hash_hmac('sha256', $payload, $secret, true);
      $base64sign = base64_encode($signPayload);
      return $base64sign;
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
    public function createEndpoint($custCode,$nama){
      $institutionCode = "J104408";
      $brivaNo = "77777";
      $amount="200000";
      $keterangan="Biaya Pendaftaran";
      $expiredDate="2017-09-10 09:57:26";
      $token = $this->getToken()["access_token"];
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
      return "Response Post : ".$resultPost;
    }

    public function pushNotificationEmail($email,$name,$nisn,$lokasi){
      $brivaNo = "77777";

      $mj = new \Mailjet\Client(getenv('MAILJET_APIKEY'), getenv('MAILJET_APISECRET'),true,['version' => 'v3.1']);
      $body = [
          'Messages' => [
              [
                  'From' => [
                      'Email' => "neverdefeatedxi@gmail.com",
                      'Name' => "Panitia SPSB YASOP 2020"
                  ],
                  'To' => [
                      [
                          'Email' => $email,
                          'Name' => $name
                      ]
                  ],
                  'Subject' => "TERIMA KASIH, ANDA TELAH MENDAFTAR",
                  'TextPart' => "Dear passenger 1, welcome to Mailjet! May the delivery force be with you!",
                  'HTMLPart' => "
                  <!doctype html>
                  <html>
                  <head>
                    <meta name='viewport' content='width=device-width'>
                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                    <title>Simple Transactional Email</title>
                    <style>
                  
                    @media only screen and (max-width: 620px) {
                      table[class=body] h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important;
                      }
                      table[class=body] p,
                            table[class=body] ul,
                            table[class=body] ol,
                            table[class=body] td,
                            table[class=body] span,
                            table[class=body] a {
                        font-size: 16px !important;
                      }
                      table[class=body] .wrapper,
                            table[class=body] .article {
                        padding: 10px !important;
                      }
                      table[class=body] .content {
                        padding: 0 !important;
                      }
                      table[class=body] .container {
                        padding: 0 !important;
                        width: 100% !important;
                      }
                      table[class=body] .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important;
                      }
                      table[class=body] .btn table {
                        width: 100% !important;
                      }
                      table[class=body] .btn a {
                        width: 100% !important;
                      }
                      table[class=body] .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important;
                      }
                    }
                    /* -------------------------------------
                        PRESERVE THESE STYLES IN THE HEAD
                    ------------------------------------- */
                    @media all {
                      .ExternalClass {
                        width: 100%;
                      }
                      .ExternalClass,
                            .ExternalClass p,
                            .ExternalClass span,
                            .ExternalClass font,
                            .ExternalClass td,
                            .ExternalClass div {
                        line-height: 100%;
                      }
                      .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important;
                      }
                      #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                      }
                      .btn-primary table td:hover {
                        background-color: #34495e !important;
                      }
                      .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important;
                      }
                    }
                    </style>
                  </head>
                  <body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                    <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;'>
                      <tr>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                        <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
                          <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>
                
                            <!-- START CENTERED WHITE CONTAINER -->
                            <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>This is preheader text. Some clients will show this text as a preview.</span>
                            <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>
                          <h2>Yayasan Soposurung</h2>
                              <!-- START MAIN CONTENT AREA -->
                              <tr>
                                <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                    <tr>
                                      <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>
                                          
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Hi ".$name.",</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Terima kasih telah mendaftar.Berikut data diri anda: ".$nisn."</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Nama Lengkap:  ".$name."</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>NISN:  ".$nisn."</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Nomor Pendaftaran:  ".$nisn."</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Lokasi Ujian:  ".$lokasi."</p>
                                        <br><br>
                                        <h2> Metode Pembayaran </h2><br>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Silahkan melakukan pembayaran melalui BRI Virtual Account :</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>BRI Virtual Account : ".$brivaNo.$nisn." a.n Yayasan Soposurung</p>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Biaya administrasi  : Rp. 200.000 </p>
                                        <br>
                                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Catatan :</p>
                                        <p>Pembayaran paling lambat 24 jam setelah pendaftaran</p>
                
                                        <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;'>
                                          <tbody>
                                            <tr>
                                              <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;'>
                                                <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
                                                  
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                
                            <!-- END MAIN CONTENT AREA -->
                            </table>
                
                            <!-- START FOOTER -->
                            <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
                              <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                <tr>
                                  
                                </tr>
                                <tr>
                                  <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                                    SPSB Yayasan Soposurung 2019</a>.
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <!-- END FOOTER -->
                
                          <!-- END CENTERED WHITE CONTAINER -->
                          </div>
                        </td>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
                      </tr>
                    </table>
                  </body>
                </html>
                  "
              ]
          ]
      ];
      $response = $mj->post(Resources::$Email, ['body' => $body]);
      $response->success() && var_dump($response->getData());

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
