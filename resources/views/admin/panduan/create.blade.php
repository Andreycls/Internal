@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pengumuman.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.panduan.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Question', trans('quickadmin.FAQ.fields.question').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('question', old('question'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <input type = "hidden" name = "author" value = "{{Auth::user()->name}}">        
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Answer', trans('quickadmin.FAQ.fields.answer'), ['class' => 'control-label']) !!}
                    {{Form::textarea('answer',null,array('class' => 'form-control', 'placeholder'=>'answer', 'id' => 'editor1'))}}
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
                    {!! Form::label('Answer', trans('quickadmin.FAQ.fields.answer'), ['class' => 'control-label']) !!}
                    <input type="file" name="file">
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
            {{--
            <!--
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pengumuman_id', trans('quickadmin.users.fields.pengumuman').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('pengumuman_id', $pengumumans, old('pengumuman_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pengumuman_id'))
                        <p class="help-block">
                            {{ $errors->first('pengumuman_id') }}
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

