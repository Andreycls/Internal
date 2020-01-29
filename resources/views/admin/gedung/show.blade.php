@extends('layouts.app')






@section('content')
    <h3 class="page-title">@lang('quickadmin.gedung.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.index')</th>
                            <td field-key='ID'>{{ $gedung->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.hall')</th>
                            <td field-key='title'>{{ $gedung->nama_gedung }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.address')</th>
                            <td field-key='content'>{{ $gedung->alamat}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.city')</th>
                            <td field-key='content'>{{ $gedung->kota}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.code')</th>
                            <td field-key='content'>{{ $gedung->kode_gedung}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gedung.fields.room')</th>
                            <td field-key='content'>{{ $gedung->banyak_ruangan}}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
    </div>
@stop