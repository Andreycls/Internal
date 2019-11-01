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
