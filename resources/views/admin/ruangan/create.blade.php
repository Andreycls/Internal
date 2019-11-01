@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.ruangan.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ruangan.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.ruangan.fields.hall').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('kode_gedung',$gedungs, null, ['class' => 'form-control', 'placeholder' => '', 'required' => '','id' => 'kode_gedung']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>

            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('content', trans('quickadmin.ruangan.fields.capacity'), ['class' => 'control-label']) !!}
                    {!! Form::number('kapasitas', old('kapasitas'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            @php
            $number = $max;
            
            @endphp

            {{ Form::hidden('nama_ruangan',old('kode_gedung', $ruangan[$ruangan->count()-1]->kode_gedung),array('class'=>'form-control','readonly','id'=>'nama_ruangan')) }}
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
            $("#name").on("focusout", function () {
    var business = $("#business").val();
   $("#url").val(business + "/" + $(this).val().toLowerCase().replace(" ", "-"));
});

            </script>
            <select id="business">
    <option value="Foo">Something</option>
    <option value="1">Something Else</option>
</select>
<input type="text" id="name" />
<input type="text" id="url" /> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
var id = "<?php echo $max ?>";
var sep = "-";
$(document).ready(function(){
  $("#kode_gedung").bind('change keyup',function(){
    $("#nama_ruangan").val(this.value.concat(sep,id));
});
});
</script>


            
            
            
            
            
            
            
            
            
            {{--
            <!--
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ruangan_id', trans('quickadmin.users.fields.ruangan').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
<script>
$(document).ready(function() {
            $('#technig').summernote({
              height:300,
            });
        });
        </script>

