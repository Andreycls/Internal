@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($jadwal, ['method' => 'PUT', 'route' => ['admin.jadwal.update', $jadwal->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
                <table class="table" id="dynamic_field">  
                    <tr>  
                    <td>
                    {!! Form::label('kota', trans('quickadmin.jadwal.fields.tahun'), ['class' => 'control-label']) !!}
                    <input id="year" name="tahun" class="year form-control" type="text" value={{$jadwal->tahun}} >
                    
                    </td>  
                    </tr>    

                    <tr>  
                    <td>
                    {!! Form::label('periode', trans('quickadmin.jadwal.fields.periode').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="periodeMulai" type="text" value={{$jadwal->periodeMulai}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="periodeAkhir" type="text" value={{$jadwal->periodeAkhir}}>
                        </div>
                       
                    </div>
                    
                    {!! Form::label('registrasiOnline', trans('quickadmin.jadwal.fields.registrasiOnline').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="registrasiOnlineBuka" type="text" value={{$jadwal->registrasiOnlineBuka}} >
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="registrasiOnlineTutup" type="text" value={{$jadwal->registrasiOnlineTutup}}>
                        </div>
                    </div>
                    {!! Form::label('registrasiLangsung', trans('quickadmin.jadwal.fields.registrasiLangsung').'', ['class' => 'control-label']) !!}
                    
                    <input class="date form-control" id="buka" name="registrasiLangsung" type="text" value={{$jadwal->registrasiLangsung}}>
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                  
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiTest'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="registrasiTestIIHari1" type="text" value={{$jadwal->registrasiTestIIHari1}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="registrasiTestIIHari2" type="text" value={{$jadwal->registrasiTestIIHari2}}>
                        </div>
                    </div>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiFinal'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="registrasiFinal" type="text" value={{$jadwal->registrasiFinal}}>
                    
                    
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesPsikologi'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="tesPsikologi" type="text">
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesInterview'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="tesInterview1" type="text" value={{$jadwal->tesInterview1}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="tesInterview2" type="text" value={{$jadwal->tesInterview2}}>
                        </div>
                    </div>
                    </td>
                    </tr>

                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanTesAkademik'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="pengumumanTesAkademik" type="text" value={{$jadwal->pengumumanTesAkademik}}>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanFinal'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="pengumumanFinal" type="text" value={{$jadwal->pengumumanFinal}}>
                    
                    </td>
                    </tr>
                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.kota'), ['class' => 'control-label']) !!}
                    <br>
                    <script>
                
                </script>
                    @foreach($kota as $kota)
                    <input type="checkbox" name="kota" value="{{ $kota->nama_kota }}"> {{ $kota->nama_kota }}<br>
                    @endforeach 
                    
                </td>
                

                    </tr>
          
                </table>
                      
        <div class="panel-body">
        
        </div>
             
    </div>
    
    @php
    if(!isset($_COOKIE["name"])) {
        setcookie("name", "empty", time() + (86400 * 30), "/"); 
    }
    @endphp
     {!! Form::hidden('kota', $_COOKIE["name"]) !!} 
    
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info','id'=>'submit']) !!}
    {!! Form::close() !!} 
    <script type="text/javascript">

    $(function () {
         
        $("#submit").click(function () {

            var selected = new Array();

 

            $(" input[type=checkbox]:checked").each(function () {

                selected.push(this.value);

            });

 

            if (selected.length > 0) {

                  alert("Selected values: " + selected.join(","));
                var string = selected.join(", ");
                document.cookie = 'name='+string;    
            }

        });
         
    });

</script>
@stop

