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
use \Mailjet\Resources;
use App\Pendaftaran;

class MailingHelper
{
    
    public function __construct(){
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
    
    public function pushNotificationEmailAfterPay($nisn){
      $email = Pendaftaran::select('email')->where('NISN', $nisn)->get()[0]["email"];
      $name = Pendaftaran::select('nama_lengkap')->where('NISN', $nisn)->get()[0]["nama_lengkap"];
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
                        'Email' => "andreyc@xlfutureleaders.com",
                        'Name' => $name
                    ]
                ],
                'Subject' => "TERIMA KASIH TELAH MENYELESAIKAN PENDAFTARAN",
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
                                  
                                      <br><br>
                                      <h2> Metode Pembayaran </h2><br>
                                      <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Silahkan melakukan pembayaran melalui BRI Virtual Account :</p>
                                      <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>BRI Virtual Account : 00000".$nisn."000 a.n Yayasan Soposurung</p>
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



    
}
