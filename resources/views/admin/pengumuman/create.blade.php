@extends('layouts.app')

@section('content')
<meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
</head>
<h3 class="page-title">@lang('quickadmin.pengumuman.title')</h3>
    
{!! Form::open(['method' => 'POST', 'route' => ['admin.pengumuman.store']]) !!}
    
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
            <input type = "hidden" name = "author" value = "{{Auth::user()->name}}">        
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

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
    <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
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

