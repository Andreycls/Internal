@extends('layouts.app')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



@section('content')
    <h3 class="page-title">@lang('quickadmin.kota.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.kota.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nama_kota', trans('quickadmin.kota.fields.city').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_kota', old('nama_kota'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    
                    {!! Form::label('tesAkademik', trans('quickadmin.jadwal.fields.tesAkademik'), ['class' => 'control-label']) !!}
                    {!! Form::text('tes_akademik', old('tes_akademik'), ['class' => 'date form-control', 'placeholder' => '', 'required' => '']) !!}
                    
                    {!! Form::label('tesAkademik', trans('quickadmin.jadwal.fields.banyakRuanganUtama'), ['class' => 'control-label']) !!}
                    {!! Form::text('ruangan_akademik', old('tes_akademik'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            
            {{--
            <!--
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ruangan_id', trans('quickadmin.users.fields.kota').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('ruangan_id', $ruangans, old('ruangan_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ruangan_id'))
                        <p class="help-block">
                            {{ $errors->first('ruangan_id') }}
                        </p>
                    @endif
                </div>
            </div>
            -->
            --}}
        </div>
    </div>
    
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
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
@stop


