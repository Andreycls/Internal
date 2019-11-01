@extends('layouts.app')

@section('content')
<meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   
</head>
<h3 class="page-title">@lang('quickadmin.pendaftar.fields.pendaftaranOffline')</h3>
    
{!! Form::open(['method' => 'POST', 'route' => ['admin.pendaftaran.store']]) !!}
    
<script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
</script>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
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

        <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.lokasi'), ['class' => 'control-label']) !!}
                <select name="lokasi" class="form-control">
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach ($kota as $kotas => $val)
                                        <option value="{{ $val }}"> {{ $val }}</option>   
                                        @endforeach
                                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('lokasi'))
                        <p class="help-block">
                            {{ $errors->first('lokasi') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nama_kota', trans('quickadmin.pendaftaran.fields.nama').' ', ['class' => 'control-label']) !!}
                <input type="text" name="nama_lengkap" id="nama_lengkap" class= 'form-control' onchange="upperMe()" />
    
                
    
                    <p class="help-block"></p>
                    @if($errors->has('nama_lengkap'))
                        <p class="help-block">
                            {{ $errors->first('nama_lengkap') }}
                        </p>
                    @endif
                </div>
            </div>
            <!-- <input type = "hidden" name = "author" value = "{{Auth::user()->name}}">         -->
            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.nisn'), ['class' => 'control-label']) !!}
                {!! Form::number('NISN', old('tes_akademik'), ['class' => 'date form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('NISN'))
                        <p class="help-block">
                            {{ $errors->first('NISN') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.email'), ['class' => 'control-label']) !!}
                <input type="text" name="email" id="email" class= 'form-control' onchange="upperMe()" />
    
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.jenisKelamin'), ['class' => 'control-label']) !!}<p>
                {{ Form::radio('jenis_kelamin', 'LAKI LAKI' , true) }} Laki Laki &nbsp;
                      {{ Form::radio('jenis_kelamin', 'PEREMPUAN' , false) }} Perempuan
                    <p class="help-block"></p>
                    @if($errors->has('jenis_kelamin'))
                        <p class="help-block">
                            {{ $errors->first('jenis_kelamin') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.agama'), ['class' => 'control-label']) !!}<p>
                <select name="agama" class="form-control">
                                        
                                        @foreach ($agama as $agamas => $val)
                                        <option value="{{ strtoupper($val) }}"> {{ $val }}</option>   
                                        @endforeach
                                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('agama'))
                        <p class="help-block">
                            {{ $errors->first('agama') }}
                        </p>
                    @endif
                </div>
            </div>
            <style>

.ttl {
    width: 500px;
}
</style>
            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.ttl'), ['class' => 'control-label']) !!}<p>
                
                <input type="text" name="tempat_lahir" id="tempat_lahir" class= 'ttl' onchange="upperMe()" />  /  {!! Form::date('tanggal_lahir', old('tanggal_lahir'), ['class' => 'date ttl', 'placeholder' => '', 'required' => '']) !!} 
  
                    <p class="help-block"></p>
                    @if($errors->has('tempat_lahir'))
                        <p class="help-block">
                            {{ $errors->first('tempat_lahir') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.provinsi'), ['class' => 'control-label']) !!}
                <select id="provinsi" name="provinsi" class="form-control">
                                        
                                        @foreach ($propinsi as $propinsis => $value)
                                        <option value="{{ $propinsis }}"> {{ $value }}</option>   
                                        @endforeach
                                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('provinsi'))
                        <p class="help-block">
                            {{ $errors->first('provinsi') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.kab'), ['class' => 'control-label']) !!}
                <select name="kabkota" class="form-control">
                                     <option>-- Pilih Kabupaten / Kota --</option>

                                 </select>
                    <p class="help-block"></p>
                    @if($errors->has('kabkota'))
                        <p class="help-block">
                            {{ $errors->first('kabkota') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.smp'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="smp" id="smp" class= 'form-control' onchange="upperMe()" /></th> 
  
                
                    <p class="help-block"></p>
                    @if($errors->has('smp'))
                        <p class="help-block">
                            {{ $errors->first('smp') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.noHp'), ['class' => 'control-label']) !!}<p>
                {!! Form::number('nomor_hp', old('tes_akademik'), ['class' => 'date form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nomor_hp'))
                        <p class="help-block">
                            {{ $errors->first('nomor_hp') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.namaAyah'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="nama_ayah" id="nama_ayah" class= 'form-control' onchange="upperMe()" />
  
               
                    <p class="help-block"></p>
                    @if($errors->has('nama_ayah'))
                        <p class="help-block">
                            {{ $errors->first('nama_ayah') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.namaIbu'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="nama_ibu" id="nama_ibu" class= 'form-control' onchange="upperMe()" />
  
                    <p class="help-block"></p>
                    @if($errors->has('nama_ibu'))
                        <p class="help-block">
                            {{ $errors->first('nama_ibu') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.noHPAyahIbu'), ['class' => 'control-label']) !!}<p>
                {!! Form::text('nomor_hp_wakil', old('tes_akademik'), ['class' => 'date form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nomor_hp_wakil'))
                        <p class="help-block">
                            {{ $errors->first('nomor_hp_wakil') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.pekerjaanAyah'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class= 'form-control' onchange="upperMe()" />
  
                
                    <p class="help-block"></p>
                    @if($errors->has('pekerjaan_ayah'))
                        <p class="help-block">
                            {{ $errors->first('pekerjaan_ayah') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.pekerjaanIbu'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class= 'form-control' onchange="upperMe()" />
                <div class="row">
                <div class="col-xs-12 form-group">
                {!! Form::label('nisn', trans('quickadmin.pendaftaran.fields.alamatOT'), ['class' => 'control-label']) !!}<p>
                <input type="text" name="alamat_orangtua" id="alamat_orangtua" class= 'form-control' onchange="upperMe()" />
  
                
                    <p class="help-block"></p>
                    @if($errors->has('alamat_orangtua'))
                        <p class="help-block">
                            {{ $errors->first('alamat_orangtua') }}
                        </p>
                    @endif
                </div>
            </div>
                
                
                <input type="hidden" name="nomor_pendaftaran" id="nomor_pendaftaran" value=""/>
                <p id="demo"></p>
               <!-- <input type="hidden" name="provinsi" id="provinsi_" value=""/>  -->
                
          
                <script type="text/javascript">
                function pad(n, width, z) {
                    z = z || '0';
                    n = n + '';
                    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
                    var prop =  document.getElementById('provinsi');
                    var propText = prop.options[prop.selectedIndex].text;
                    var propValue = prop.options[prop.selectedIndex].value;
                    
                    console.log(propValue);
                    if(propValue<10){
                        var PropValue_ = '0'+'0'+propValue;    
                    }
                    else{
                        var PropValue_ = '0'+propValue;    
                    }
                    document.getElementById('nomor_pendaftaran').value = PropValue_;
                    document.getElementById('provinsi_').value = propText;
                    
                
                </script>
                
                    <p class="help-block"></p>
                    @if($errors->has('pekerjaan_ibu'))
                        <p class="help-block">
                            {{ $errors->first('pekerjaan_ibu') }}
                        </p>
                    @endif
                </div>
            </div>


            <input type="hidden" name="foto" id="foto" value="offline">
            <input type="hidden" name="file" id="file" value="offline">
            <script > 
function upperMe() { 
    document.getElementById("nama_lengkap").value = document.getElementById("nama_lengkap").value.toUpperCase(); 
    document.getElementById("email").value = document.getElementById("email").value.toUpperCase(); 
    document.getElementById("tempat_lahir").value = document.getElementById("tempat_lahir").value.toUpperCase(); 
    document.getElementById("smp").value = document.getElementById("smp").value.toUpperCase(); 
    document.getElementById("nama_ayah").value = document.getElementById("nama_ayah").value.toUpperCase(); 
    document.getElementById("nama_ibu").value = document.getElementById("nama_ibu").value.toUpperCase(); 
    document.getElementById("pekerjaan_ayah").value = document.getElementById("pekerjaan_ayah").value.toUpperCase(); 
    document.getElementById("pekerjaan_ibu").value = document.getElementById("pekerjaan_ibu").value.toUpperCase();
    document.getElementById("alamat_orangtua").value = document.getElementById("alamat_orangtua").value.toUpperCase(); 
} 
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
    



 
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
    
    <!-- @csrf -->
</form>   
@stop
<script>
$(document).ready(function() {
            $('#technig').summernote({
              height:300,
            });
        });
        </script>

