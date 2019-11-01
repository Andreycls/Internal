<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPSB Asrama Yayasan Soposurung</title>
        <!-- Load Roboto font -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-responsive.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pluton.css') }}" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.cslider.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.bxslider.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/yasop_logo.png') }}">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   
   
   
   
   
   
   
   
   
   
   
   
   
    </head>
    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                
                    <a href="#" class="brand">
                        <img src="{{ asset('images/yasop_logo.png') }}"  alt="Logo" />
						
                        <!-- This is website logo -->
                    </a>
                    
                        <div class = "title-container">
					    <p style="color:white"><b>Seleksi Penerimaan Siswa Baru Asrama Yayasan Soposurung Tunas Bangsa </b></p>
					    </div>
                    
					<!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                        <li ><a href="{{ url('/beranda') }}">Beranda</a></li> 
                            <li class="active"><a href="{{ url('/pendaftaran') }}">Pendaftaran</a></li>
                            <li><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
                            <li><a href="{{ url('/beranda') }}#about">Panduan</a></li>
                            <li><a href="{{ url('/beranda') }}#lokasi">Lokasi</a></li>
                            <li><a href="{{ url('/beranda') }}#contact">Kontak</a></li>
                        </ul>
                    </div>
        
                    <!-- End main navigation -->
                </div>
                
            </div>
        </div>
        <!-- Start home section -->
                <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Pendaftaran</h1>
                    <!-- Section's title goes here -->
                    <p>Pengumuman terkait Seleksi Penerimaan Siswa Baru</p>
                    <!--Simple description for section goes here. -->
                </div>
                
            </div>
       




    



<style>
.foo {
    width: 500px;
    /* text-transform: uppercase; */
}
.ttl {
    width: 200px;
    /* text-transform: uppercase; */
}
</style>



    
    {!! Form::open(['method' => 'POST','files' =>true,'enctype'=>'multipart/form-data', 'route' => ['pendaftaran.store']]) !!}
   @php
    $tanggalSystem = new DateTime(date("Y/m/d")); 
    $tanggalPembukaan = new DateTime($tanggal->periodeMulai); 
    $tanggalPenutupan = new DateTime($tanggal->periodeAkhir);
  
if(($tanggalSystem > $tanggalPembukaan)&&($tanggalSystem < $tanggalPenutupan)){
    echo "<fieldset >";}
else
    echo "<fieldset disabled>"; 
   @endphp
    
    <div class="panel panel-default" align="center">
        
        <div class="container-fluid">
  
        </div>
        <div class="panel-body">
        <div id="example1">
        <h1 style="color:#040047">FORM PENDAFTARAN SPSB</h1>
       
        <hr style="color:black">
        <table style="width:90%">
        <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.lokasi'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left">
    
    <select name="lokasi" class="foo">
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach ($kota as $kotas => $val)
                                        <option value="{{ strtoupper($val) }}"> {{ $val }}</option>   
                                        @endforeach
                                    </select>
    
    
    </th>
  </tr>
  <tr>
    <th align="right">{!! Form::label('nama_kota', trans('quickadmin.pendaftaran.fields.nama').' ', ['class' => 'control-label']) !!} </th>
    <th style="width:5%"></th>
    <th align="left"> 
    <input type="text" name="nama_lengkap" id="nama_lengkap" class= 'foo' onchange="upperMe()" />
    
    
    </th> 
  </tr>
  
  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.nisn'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> {!! Form::number('NISN', old('NISN'), ['class' => ' foo', 'placeholder' => '', 'required' => '']) !!}</th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.email'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> <input type="text" name="email" id="email" class= 'foo' onchange="upperMe()" />
    </th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.jenisKelamin'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> 
    
    
    {{ Form::radio('jenis_kelamin', 'LAKI LAKI' , true,['class' => ' foo', 'placeholder' => '', 'required' => '']) }} Laki laki
    
    {{ Form::radio('jenis_kelamin', 'PEREMPUAN' , false) }} Perempuan
    
    
    
                      </th> 
                    
  </tr>

  <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.agama'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left">
    
    <select name="agama" class="foo">
                                        
                                        @foreach ($agama as $agamas => $val)
                                        <option value="{{ $val }}"> {{ $val }}</option>   
                                        @endforeach
                                    </select>
    
    
    </th>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.ttl'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> <input type="text" name="tempat_lahir" id="tempat_lahir" class= 'ttl' onchange="upperMe()" />  /  {!! Form::date('tanggal_lahir', old('tanggal_lahir'), ['class' => 'date ttl', 'placeholder' => '', 'required' => '']) !!}</th> 
  </tr>

 <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.provinsi'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left">
    
    <select name="provinsi" class="foo">
                                        <option>-- Pilih Provinsi --</option>
                                        @foreach ($propinsi as $propinsis => $value)
                                        <option value="{{ $propinsis }}"> {{ $value }}</option>   
                                        @endforeach
                                    </select>
    
    
    </th>
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.kab'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left">
    <select name="kabkota" class="foo">
                                     <option>-- Pilih Kabupaten / Kota --</option>

                                 </select>
    </th>
  </tr>

    <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.smp'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"><input type="text" name="smp" id="smp" class= 'foo' onchange="upperMe()" /></th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.noHp'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> {!! Form::number('nomor_hp', old('nomor_hp'), ['class' => 'date foo', 'placeholder' => '', 'required' => '']) !!}</th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.namaAyah'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"><input type="text" name="nama_ayah" id="nama_ayah" class= 'foo' onchange="upperMe()" /></th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.namaIbu'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"><input type="text" name="nama_ibu" id="nama_ibu" class= 'foo' onchange="upperMe()" /></th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.noHPAyahIbu'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"> {!! Form::text('nomor_hp_wakil', old('nomor_hp_wakil'), ['class' => ' foo', 'placeholder' => '', 'required' => '']) !!}</th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.pekerjaanAyah'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left"><input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class= 'foo' onchange="upperMe()" /></th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.pekerjaanIbu'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left" ><input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class= 'foo' onchange="upperMe()" /></th> 
  </tr>
  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.alamatOT'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left" ><input type="text" name="alamat_orangtua" id="alamat_orangtua" class= 'foo' onchange="upperMe()" /></th> 
  </tr>

  <tr>
    <th align="right"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.pilihGambar'), ['class' => 'control-label']) !!}</th>
    <th style="width:5%"></th>
    <th align="left" ><input type="file" name="file" id="file" required><input type="hidden" value="{{ csrf_token() }}" name="_token"></th> 
    <script > 
    </fieldset>
function upperMe() { 
    document.getElementById("nama_lengkap").value = document.getElementById("nama_lengkap").value.toUpperCase(); 
    document.getElementById("email").value = document.getElementById("email").value.toUpperCase(); 
    document.getElementById("tempat_lahir").value = document.getElementById("tempat_lahir").value.toUpperCase(); 
    document.getElementById("smp").value = document.getElementById("smp").value.toUpperCase(); 
    document.getElementById("nama_ayah").value = document.getElementById("nama_ayah").value.toUpperCase(); 
    document.getElementById("nama_ibu").value = document.getElementById("nama_ibu").value.toUpperCase(); 
    document.getElementById("pekerjaan_ayah").value = document.getElementById("pekerjaan_ayah").value.toUpperCase(); 
    document.getElementById("pekerjaan_ibu").value = document.getElementById("pekerjaan_ibu").value.toUpperCase(); 
} 
</script>
    <!-- <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class= 'foo' onchange="upperMe()" /> -->
  </tr>
  
  
  @if (count($errors) > 0)

<div class="alert alert-danger">

    <strong>Oops!</strong> Sepertinya anda salah dalam memasukkan data

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif
@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

</div>


@endif
  <input type="hidden" name="foto" id="foto" value="">
  <script type="text/javascript">

$(document).ready(function(){
  
    $('input[type="file"]').change(function(e){

        var fileName = e.target.files[0].name;
        document.getElementById('foto').value=fileName;
        // alert('The file "' + fileName +  '" has been selected.');
        // return fileName;
        $('#foto').val(fileName);
    });

});

</script>
 
  
  <tr>
    <th align="right"> </th>
    <th style="width:5%"></th>
    <th align="left" ><input id="check" name="checkbox" type="checkbox"> {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.term'), ['class' => 'control-label']) !!}</th> 
  </tr>
  
  <script>
  $(function() {
  var chk = $('#check');
  var btn = $('#btncheck');

  chk.on('change', function() {
    btn.prop("disabled", !this.checked);//true: disabled, false: enabled
  }).trigger('change'); //page load trigger event
});
  </script>
  
</table>
                   
<p><p>          
<input type="submit" name="anmelden" class="btn btn-info" id="btncheck" value="Kirim" />
    {!! Form::close() !!}
        </div>
        
       
    
  </div>
    </div>
    
<style>
#example1 {
  border: 2px solid #CEE1FE;
  background: lavender;
  border-radius:2px;
  width:800px;
  padding-top:20px;
  padding-bottom:20px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
}
</style>
    
    <script>

var today = new Date();
$("#year").datepicker({  
    format: "yyyy",
    startView: "years", 
    minViewMode: "years",
    minDate:today
 });
 $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
 $('.date').datepicker({  
format: 'dd-mm-yyyy',
minDate: today
}); 
var dateToday = new Date();
$("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});

</script>































        














        























            <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="provinsi"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : '/getstates/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="kabkota"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="kabkota"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kabkota"]').empty();
               }
            });
    });
    </script>
    
































































        <!-- Service section end -->
        <!-- Portfolio section start -->
        
               <!-- <div class="container-footer" style="background-color:#003152">
                    <div class="span9 center contact-info">
                        <p>Jl. Dr. Adrianus Sinaga No.1, Soposurung, Balige, Hinalang Bagasan, Balige, Kabupaten Toba Samosir, Sumatera Utara 22312</p>
                        <p class="info-mail">contact@yasop.org</p>
                        <p>Telp/Fax: (0632)-21496 (Senin - Sabtu, 08.00 - 17.00 WIB)
                        <br>HP : 0853-5825-9916 (Senin - Sabtu, 08.00 - 17.00 WIB)</p>

                            <h3>Asrama Yayasan Soposurung - SMAN 2 Balige</h3>
                        </div>
                    <div class="row-fluid centered">
                        
                    </div>
                </div>
            </div>
        </div> -->
        
        <!-- Footer section start -->
        <!-- <div class="footer">
             </div>
        Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mixitup.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/modernizr.custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.bxslider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.cslider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.placeholder.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.inview.js') }}"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        
@include('partials.javascripts')
    </body>
</html>