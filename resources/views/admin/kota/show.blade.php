@extends('layouts.app')






@section('content')
    <h3 class="page-title">@lang('quickadmin.kota.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.kota.fields.index')</th>
                            <td field-key='ID'>{{ $kota->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kota.fields.city')</th>
                            <td field-key='title'>{{ $kota->nama_kota }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.tesAkademik')</th>
                            <td field-key='title'>{{ $kota->tes_akademik }}</td>
                        </tr>
                        
                        
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop
