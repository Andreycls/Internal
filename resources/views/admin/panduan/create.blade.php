@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.FAQ-management.title')</h3>
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
                    {!!Form::textarea('answer',null,array('class' => 'form-control', 'placeholder'=>'answer','required' => '', 'id' => 'editor1'))!!}
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
             
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
@stop
<script>
$(document).ready(function() {
            $('#technig').summernote({
              height:300,
            });
        });
        </script>

