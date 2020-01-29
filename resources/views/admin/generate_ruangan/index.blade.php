@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    <h3 class="page-title">@lang('quickadmin.generate_ruangan.title')</h3>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            Generate Data Peserta
        </div>
        
        <div class="panel-body table-responsive">
        
        <table style="width:80%">
  <tr>
    <th> <a href="{{ url('admin/generate/pdf/data_peserta') }}" class="btn btn-xm btn-success ">Data peserta</a> </th>
    <th><a href="{{ url('admin/generate/pdf/daftar_hadir') }}" class="btn btn-xm btn-info ">Daftar hadir</a> </th> 
    <th><a href="{{ url('admin/generate/pdf/stiker_meja') }}" class="btn btn-xm btn-success ">Stiker meja</a></th>
    <th><a href="{{ url('admin/generate/pdf/denah') }}" class="btn btn-xm btn-info ">Denah meja</a></th>
  </tr>

  
</table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Input data nomor ujian
        </div>
        <div class="panel-body table-responsive">
        <table style="width:60%">
            <tr>
                {!! Form::open(['method' => 'POST','files' =>true,'enctype'=>'multipart/form-data', 'route' => ['admin.generate.store']]) !!}
                <th> <input type="file" name="import_file" id="import_file" accept=".xls,.xlsx,.csv" required ><input type="hidden" value="{{ csrf_token() }}" name="_token">  </th>
                <th><input type="submit" name="anmelden" class="btn btn-info" id="btncheck" value="Kirim" /></th>
                {!! Form::close() !!}
            </tr>
        </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Generate kartu peserta
        </div>
        <div class="panel-body table-responsive">
        <table style="width:60%">
            <tr>
                {!! Form::open(['method' => 'POST', 'route' => ['admin.generate.kartu']]) !!}
                <th> NISN : <input type="text" name="nisn" id="nisn" required > </th>
                <th><input type="submit" name="anmelden" class="btn btn-info" id="btncheck" value="Kirim" /></th>
                {!! Form::close() !!}
            </tr>
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


