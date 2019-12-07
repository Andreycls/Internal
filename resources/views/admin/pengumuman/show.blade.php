@extends('layouts.app')






@section('content')
    <h3 class="page-title">@lang('quickadmin.pengumuman.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.index')</th>
                            <td field-key='ID'>{{ $pengumuman->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.title')</th>
                            <td field-key='title'>{{ $pengumuman->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.creator')</th>
                            <td field-key='content'>{!! $pengumuman->author!!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.content')</th>
                            <td field-key='content'>{!! $pengumuman->content!!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pengumuman.fields.file')</th>
                            <td field-key='content'><a href="{{URL::to('/')}}/uploads/{!! $pengumuman->file!!}" target="_blank">
                            <button class="btn"><i class="fa fa-download"></i> {!! $pengumuman->file!!}</button>
                        </a></td>
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
<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="expensecategory">
<table class="table table-bordered table-striped {{ count($pengumumans) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.expense-category.fields.name')</th>
                        <th>@lang('quickadmin.expense-category.fields.created-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($pengumumans) > 0)
            @foreach ($pengumumans as $pengumumans)
                <tr data-entry-id="{{ $pengumumans->id }}">
                    <td field-key='name'>{{ $pengumuman->title }}</td>
                                <td field-key='created_by'>{{ $pengumumans->created_by->name or '' }}</td>
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

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
