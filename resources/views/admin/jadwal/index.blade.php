@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


    <h3 class="page-title">@lang('quickadmin.jadwal.title')</h3>
    
    @can('pengumuman_create')
    
    <p>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
        
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
        
       
            <table class="table table-bordered table-striped {{ count($gedung) > 0 ? 'datatable' : '' }} @can('gedung_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('gedung_delete')   
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.jadwal.fields.index')</th>
                        <th>@lang('quickadmin.jadwal.fields.tahun')</th>
                        <th>@lang('quickadmin.jadwal.fields.periodeMulai')</th>
                        <th>@lang('quickadmin.jadwal.fields.periodeAkhir')</th>
                        <th>@lang('quickadmin.jadwal.fields.pengumumanFinal')</th>
                                                

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($jadwal) > 0)
                        @foreach ($jadwal as $jadwal)
                            <tr data-entry-id="{{ $jadwal->id }}">
                                @can('pengumuman_delete')
                                @endcan

                                <td field-key='id'>{{ $jadwal->id }}</td>
                                <td field-key='title'>{{ $jadwal->tahun }}</td>
                                <td field-key='title'>{{ $jadwal->periodeMulai }}</td>
                                <td field-key='content'>{{ $jadwal->periodeAkhir }}</td>
                                <td field-key='title'>{{ $jadwal->registrasiOnlineBuka }}</td>
                                                                <td>
                                    @can('pengumuman_view')
                                    <a href="{{ route('admin.jadwal.show',[$jadwal->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('pengumuman_edit')
                                    <a href="{{ route('admin.jadwal.edit',[$jadwal->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('pengumuman_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.jadwal.destroy', $jadwal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
@stop

