@extends('layouts.app')






@section('content')
    <h3 class="page-title">@lang('quickadmin.jadwal.title')</h3>

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
                            <td field-key='ID'>{{ $jadwal->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.tahun')</th>
                            <td field-key='title'>{{ $jadwal->tahun }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.periodeMulai')</th>
                            <td field-key='content'>{{ $jadwal->periodeMulai}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.periodeAkhir')</th>
                            <td field-key='content'>{{ $jadwal->periodeAkhir}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiOnlineBuka')</th>
                            <td field-key='content'>{{ $jadwal->registrasiOnlineBuka}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiOnlineTutup')</th>
                            <td field-key='content'>{{ $jadwal->registrasiOnlineTutup}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiLangsung')</th>
                            <td field-key='content'>{{ $jadwal->registrasiLangsung}}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiTestIIHari1')</th>
                            <td field-key='content'>{{ $jadwal->registrasiTestIIHari1}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiTestIIHari2')</th>
                            <td field-key='content'>{{ $jadwal->registrasiTestIIHari2}}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.registrasiFinal')</th>
                            <td field-key='content'>{{ $jadwal->registrasiFinal}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.tesPsikologi')</th>
                            <td field-key='content'>{{ $jadwal->tesPsikologi}}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.tesInterview1')</th>
                            <td field-key='content'>{{ $jadwal->tesInterview1}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.tesInterview2')</th>
                            <td field-key='content'>{{ $jadwal->tesInterview2}}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.pengumumanTesAkademik')</th>
                            <td field-key='content'>{{ $jadwal->pengumumanTesAkademik}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.pengumumanFinal')</th>
                            <td field-key='content'>{{ $jadwal->pengumumanFinal}}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.jadwal.fields.kota')</th>
                            <td field-key='content'>{{ $jadwal->kota}}</td>
                        </tr>
                        
                    </table>
                </div>
            </div><!-- Nav tabs -->
<!--
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#expensecategory" aria-controls="expensecategory" role="tab" data-toggle="tab">Expense Categories</a></li>
<li role="presentation" class=""><a href="#incomecategory" aria-controls="incomecategory" role="tab" data-toggle="tab">Income categories</a></li>
<li role="presentation" class=""><a href="#currency" aria-controls="currency" role="tab" data-toggle="tab">Currency</a></li>
<li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Income</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Expenses</a></li>
</ul>
-->

        </div>
    </div>
@stop
