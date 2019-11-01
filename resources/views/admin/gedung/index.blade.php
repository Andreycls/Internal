@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.gedung.title')</h3>
    
    @can('pengumuman_create')
    
    <p>
        <a href="{{ route('admin.gedung.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
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

                        <th>@lang('quickadmin.gedung.fields.index')</th>
                        <th>@lang('quickadmin.gedung.fields.hall')</th>
                        <th>@lang('quickadmin.gedung.fields.code')</th>
                        <th>@lang('quickadmin.gedung.fields.city')</th>
                        <th>@lang('quickadmin.gedung.fields.room')</th>
                                                

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($gedung) > 0)
                        @foreach ($gedung as $gedung)
                            <tr data-entry-id="{{ $gedung->content }}">
                                @can('pengumuman_delete')
                                @endcan

                                <td field-key='id'>{{ $gedung->id }}</td>
                                <td field-key='title'>{{ $gedung->nama_gedung }}</td>
                                <td field-key='title'>{{ $gedung->kode_gedung }}</td>
                                <td field-key='content'>{!! $gedung->kota !!}</td>
                                <td field-key='title'>{{ $gedung->banyak_ruangan }}</td>
                                                                <td>
                                    @can('pengumuman_view')
                                    <a href="{{ route('admin.gedung.show',[$gedung->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('pengumuman_edit')
                                    <a href="{{ route('admin.gedung.edit',[$gedung->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('pengumuman_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.gedung.destroy', $gedung->id])) !!}
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

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.pengumuman.mass_destroy') }}';
        @endcan

    </script>
@endsection


