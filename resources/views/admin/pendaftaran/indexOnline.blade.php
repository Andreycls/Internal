@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pendaftar.fields.daftarOnline')</h3>
    

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.pendaftaran.fields.pendaftar')
        </div>

<h4>&nbsp;Pendaftar Online</h4>

<table class="table table-bordered table-striped {{ count($pendaftarOnline) > 0 ? 'datatable' : '' }}  dt-select">
                <thead>
                    <tr>
                        
                        <th>@lang('quickadmin.pendaftaran.fields.nisn')</th>
                        <th>@lang('quickadmin.pendaftaran.fields.nama')</th>
                        <th>@lang('quickadmin.pendaftaran.fields.smp')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            <tbody>
                    @if (count($pendaftarOnline) > 0)
                        @foreach ($pendaftarOnline as $pendaftar)
                            <tr data-entry-id="{{ $pendaftar->NISN }}">
                                
                                <td field-key='id'>{{ $pendaftar->NISN }}</td>
                                <td field-key='title'>{{ $pendaftar->nama_lengkap }}</td>
                                <td field-key='content'>{!! $pendaftar->smp !!}</td>
                                                                <td>
                                    
                                    <a href="{{ route('admin.pendaftaran.show',[$pendaftar->NISN]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                   
                                    <a href="{{ route('admin.pendaftaran.edit',[$pendaftar->NISN]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    
                                    
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pendaftaran.destroy','nisn'=>$pendaftar->NISN ])) !!}
                                        {{ csrf_field() }}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {{ method_field('DELETE') }}
                                    {!! Form::close() !!}
                                    
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
            {{ $pendaftarOnline->links() }}

        </div>
    </div>
@stop


@section('javascript') 
    <script>
        
            window.route_mass_crud_entries_destroy = '{{ route('admin.pengumuman.mass_destroy') }}';
        

    </script>
@endsection


