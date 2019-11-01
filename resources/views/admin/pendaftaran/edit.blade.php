@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($pengumuman, ['method' => 'PUT', 'route' => ['admin.pengumuman.update', $pengumuman->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.pengumuman.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                    {!! Form::label('content', trans('quickadmin.pengumuman.fields.content'), ['class' => 'control-label']) !!}
                    {{Form::textarea('content',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'editor1'))}}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <script src="//cdn.ckeditor.com/4.11.3/full/ckeditor.js"></script>
            
        <script>
            CKEDITOR.replace( 'editor1' );
            CKEDITOR.config.allowedContent = true;
        </script>
        <script>
$(document).ready(function() {
            $('#technig').summernote({
              height:300,
            });
        });
        </script>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

