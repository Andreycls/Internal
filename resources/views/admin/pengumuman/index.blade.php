@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pengumuman.title')</h3>
    
    @can('pengumuman_create')
    
    <p>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
        
       
            <table class="table table-bordered table-striped {{ count($pengumuman) > 0 ? 'datatable' : '' }} @can('pengumuman_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('pengumuman_delete')   
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.pengumuman.fields.index')</th>
                        <th>@lang('quickadmin.pengumuman.fields.title')</th>
                        <th>@lang('quickadmin.pengumuman.fields.content')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pengumuman) > 0)
                        @foreach ($pengumuman as $pengumuman)
                            <tr data-entry-id="{{ $pengumuman->content }}">
                                @can('pengumuman_delete')
                                    <td></td>
                                @endcan

                                <td field-key='id'>{{ $pengumuman->id }}</td>
                                <td field-key='title'>{{ $pengumuman->title }}</td>
                                <td field-key='content'>{!! $pengumuman->content !!}</td>
                                                                <td>
                                    @can('pengumuman_view')
                                    <a href="{{ route('admin.pengumuman.show',[$pengumuman->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('pengumuman_edit')
                                    <a href="{{ route('admin.pengumuman.edit',[$pengumuman->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('pengumuman_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pengumuman.destroy', $pengumuman->id])) !!}
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


