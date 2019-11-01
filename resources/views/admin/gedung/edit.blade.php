@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($gedung, ['method' => 'PUT', 'route' => ['admin.gedung.update', $gedung->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nama_gedung', trans('quickadmin.gedung.fields.hall').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_gedung', old('nama_gedung'), ['class' => 'form-control', 'placeholder' => 'Nama Gedung', 'required' => '']) !!}
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
                    {!! Form::label('kota', trans('quickadmin.gedung.fields.city'), ['class' => 'control-label']) !!}
                    {!! Form::select('kota',$kotas, old('kota'), ['class' => 'form-control', 'placeholder' => 'Nama kota', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('alamat', trans('quickadmin.gedung.fields.address'), ['class' => 'control-label']) !!}
                    {!! Form::text('alamat', old('alamat'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('room', trans('quickadmin.gedung.fields.room'), ['class' => 'control-label']) !!}
                    {!! Form::number('banyak_ruangan', old('banyak_ruangan'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

