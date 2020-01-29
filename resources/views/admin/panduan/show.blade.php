@extends('layouts.app')






@section('content')
    <h3 class="page-title">@lang('quickadmin.FAQ.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.FAQ.fields.index')</th>
                            <td field-key='ID'>{{ $panduan->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.FAQ.fields.question')</th>
                            <td field-key='title'>{{ $panduan->question }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.FAQ.fields.answer')</th>
                            <td field-key='content'>{!! $panduan->answer!!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.creator')</th>
                            <td field-key='content'>{!! $panduan->author!!}</td>
                        </tr>
                    </table>
                </div>
            </div> 
    </div>
    </div>
@stop
