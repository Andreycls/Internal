@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.jadwal.title')</h3>
    
    {!! Form::model($jadwal, ['method' => 'PUT', 'route' => ['admin.jadwal.update', $jadwal->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_update')
        </div>
        <table class="table" id="dynamic_field">  
                    <tr>  
                        <td>
                        {!! Form::label('kota', trans('quickadmin.jadwal.fields.tahun'), ['class' => 'control-label']) !!}
                        <input id="year" name="tahun" class="form-control" type="number" min=2020 max=2100 required value={{$jadwal->tahun}}  />
                        </td>  
                    </tr>    

                    <tr>  
                        <td>
                    {!! Form::label('periode', trans('quickadmin.jadwal.fields.periode').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="form-control" id="periodeMulai" name="periodeMulai" type="date" 
                                          onchange="document.getElementById('periodeAkhir').min=this.value;
                                                  document.getElementById('registrasiLangsung').min=this.value;
                                                  document.getElementById('registrasiOnlineBuka').min=this.value;
                                                  document.getElementById('registrasiLangsung').min=this.value;
                                                  document.getElementById('registrasiTestIIHari1').min=this.value;
                                                  document.getElementById('registrasiFinal').min=this.value;
                                                  document.getElementById('tesPsikologi').min=this.value;
                                                  document.getElementById('tesInterview1').min=this.value;
                                                  document.getElementById('pengumumanTesAkademik').min=this.value;
                                                  " 
                                                  
                                                  required min="<?php echo date("Y-m-d"); ?>" value={{$jadwal->periodeMulai}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="form-control" id="periodeAkhir" min="document.getElementById('periodeMulai').value" name="periodeAkhir" type="date" required value={{$jadwal->periodeAkhir}}>
                        </div>
                       
                    </div>
                    
                    {!! Form::label('registrasiOnline', trans('quickadmin.jadwal.fields.registrasiOnline').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="form-control" id="registrasiOnlineBuka" name="registrasiOnlineBuka" min="document.getElementById('periodeMulai').value"  onchange="document.getElementById('registrasiOnlineTutup').min=this.value;" type="date" required value={{$jadwal->registrasiOnlineBuka}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="form-control" id="registrasiOnlineTutup" name="registrasiOnlineTutup" min="document.getElementById('registrasiOnlineBuka').value" type="date" required value={{$jadwal->registrasiOnlineTutup}}>
                        </div>
                    </div>
                    {!! Form::label('registrasiLangsung', trans('quickadmin.jadwal.fields.registrasiLangsung').'', ['class' => 'control-label']) !!}
                    
                    <input class="form-control" id="registrasiLangsung" min="document.getElementById('periodeMulai').value" name="registrasiLangsung" type="date" required value={{$jadwal->registrasiLangsung}}>
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                  
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiTest'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="form-control" id="registrasiTestIIHari1" min="document.getElementById('periodeMulai').value" onchange="document.getElementById('registrasiTestIIHari2').min=this.value;" name="registrasiTestIIHari1" type="date" required value={{$jadwal->registrasiTestIIHari1}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="form-control" id="registrasiTestIIHari2" min="document.getElementById('registrasiTestIIHari1').value" name="registrasiTestIIHari2" type="date" required value={{$jadwal->registrasiTestIIHari2}}>
                        </div>
                    </div>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiFinal'), ['class' => 'control-label']) !!}
                    <input class="form-control" id="registrasiFinal" min="document.getElementById('periodeMulai').value" name="registrasiFinal" type="date" required value={{$jadwal->registrasiFinal}}>
                    
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesPsikologi'), ['class' => 'control-label']) !!}
                    <input class="form-control" id="tesPsikologi" min="document.getElementById('periodeMulai').value" name="tesPsikologi" type="date" required value={{$jadwal->tesPsikologi}}>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesInterview'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="form-control" id="tesInterview1" name="tesInterview1" min="document.getElementById('periodeMulai').value" onchange="document.getElementById('tesInterview2').min=this.value;"  type="date" required value={{$jadwal->tesInterview1}}>
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="form-control" id="tesInterview2" name="tesInterview2" min="document.getElementById('tesInterview1').value" type="date" required value={{$jadwal->tesInterview2}}>
                        </div>
                    </div>
                    </td>
                    </tr>

                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanTesAkademik'), ['class' => 'control-label']) !!}
                    <input class="form-control" id="pengumumanTesAkademik" name="pengumumanTesAkademik" min="document.getElementById('periodeMulai').value" onchange="document.getElementById('pengumumanFinal').min=this.value;"  type="date" required value={{$jadwal->pengumumanTesAkademik}}>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanFinal'), ['class' => 'control-label']) !!}
                    <input class="form-control" id="pengumumanFinal" name="pengumumanFinal" min="document.getElementById('pengumumanTesAkademik').value" type="date" required value={{$jadwal->pengumumanFinal}}>
                    
                    </td>
                    </tr>
                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.kota'), ['class' => 'control-label']) !!}
                    <br>
                    
                    @foreach($kota as $kota)
                    <input type="checkbox" name="kota[]"  value="{{ $kota->nama_kota }}"> {{ $kota->nama_kota }}<br>
                    @endforeach 
                    
                </td>
                

                    </tr>
          
                </table>
                      
        <div class="panel-body">
        
        </div>
             
    </div>
    
    
     
    
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info','id'=>'submit']) !!}
    {!! Form::close() !!} 
    
@stop

