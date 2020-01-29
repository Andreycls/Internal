@extends('layouts.app')


@section('content')
    <h3 class="page-title">@lang('quickadmin.pendaftaran.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.nisn')</th>
                            <td field-key='ID'>{{ $pendaftar[0]->NISN }}</td>
                        </tr>
                        
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.nama')</th>
                            <td field-key='title'>{{ $pendaftar[0]->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.lokasi')</th>
                            <td field-key='title'>{{ $pendaftar[0]->lokasi }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.email')</th>
                            <td field-key='title'>{{ $pendaftar[0]->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.jenisKelamin')</th>
                            <td field-key='title'>{{ $pendaftar[0]->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.agama')</th>
                            <td field-key='title'>{{ $pendaftar[0]->agama }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.ttl')</th>
                            <td field-key='title'>{{ $pendaftar[0]->tempat_lahir }}, {{ $pendaftar[0]->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.provinsi')</th>
                            <td field-key='title'>{{ $pendaftar[0]->provinsi }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.kab')</th>
                            <td field-key='title'>{{ $pendaftar[0]->kabkota }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.smp')</th>
                            <td field-key='title'>{{ $pendaftar[0]->smp }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.noHp')</th>
                            <td field-key='title'>{{ $pendaftar[0]->nomor_hp }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.namaAyah')</th>
                            <td field-key='title'>{{ $pendaftar[0]->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.namaIbu')</th>
                            <td field-key='title'>{{ $pendaftar[0]->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.noHPAyahIbu')</th>
                            <td field-key='title'>{{ $pendaftar[0]->nomor_hp }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.pekerjaanAyah')</th>
                            <td field-key='title'>{{ $pendaftar[0]->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.pekerjaanIbu')</th>
                            <td field-key='title'>{{ $pendaftar[0]->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pendaftaran.fields.foto')</th>
                            <td field-key='title'><img src="<?php echo url("uploads/foto{$pendaftar[0]->foto}")?>" width="200px" length="400px"></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="expensecategory">
<table class="table table-bordered table-striped {{ count($pendaftar) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            

        </tr>
    </thead>

    <tbody>
        @if (count($pendaftar) > 0)
            @foreach ($pendaftar as $pendaftars)
                <tr data-entry-id="{{ $pendaftars->NISN }}">
                   
                                <td field-key='created_by'>{{ $pendaftars->created_by->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('expense_categories.show',[$expense_category->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('expense_categories.edit',[$expense_category->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['expense_categories.destroy', $expense_category->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>

</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
