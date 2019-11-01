@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($kota, ['method' => 'PUT', 'route' => ['admin.kota.update', $kota->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nama_kota', trans('quickadmin.kota.fields.city').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_kota', old('nama_kota'), ['class' => 'form-control', 'placeholder' => 'Nama kota', 'required' => '']) !!}
                    <br>
                    {!! Form::label('nama_kota', trans('quickadmin.kota.fields.banyakRuangan').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('ruangan_utama', old('nama_kota'), ['class' => 'form-control', 'placeholder' => 'Nama kota', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@stop

