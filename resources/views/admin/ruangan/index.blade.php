@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.ruangan.title')</h3>
    
    @can('pengumuman_create')
    
    <p>
        <a href="{{ route('admin.ruangan.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
        
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
        
       
            <table class="table table-bordered table-striped {{ count($ruangan) > 0 ? 'datatable' : '' }} @can('ruangan_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('ruangan_delete')   
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.ruangan.fields.index')</th>
                        <th>@lang('quickadmin.gedung.fields.hall')</th>
                        <th>@lang('quickadmin.ruangan.fields.hall')</th>
                        <th>@lang('quickadmin.ruangan.fields.room')</th>
                        <th>@lang('quickadmin.ruangan.fields.capacity')</th>
                        
                                                

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($ruangan) > 0)
                        @foreach ($ruangan as $ruangan)
                            <tr data-entry-id="{{ $ruangan->content }}">
                                @can('pengumuman_delete')
                                @endcan

                                <td field-key='id'>{{ $ruangan->id }}</td>
                                <td field-key='title'>{!! \App\Gedung::where(['kode_gedung' => $ruangan->kode_gedung ])->pluck('nama_gedung')->first() !!}</td>
                                <td field-key='title'>{{ $ruangan->kode_gedung }}</td>
                                <td field-key='content'>{{ $ruangan->nama_ruangan }}</td>
                                <td field-key='content'>{{ $ruangan->kapasitas }}</td>
                                                                <td>
                                    @can('pengumuman_view')
                                    <a href="{{ route('admin.ruangan.show',[$ruangan->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('pengumuman_edit')
                                    <a href="{{ route('admin.ruangan.edit',[$ruangan->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('pengumuman_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.ruangan.destroy', $ruangan->id])) !!}
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


