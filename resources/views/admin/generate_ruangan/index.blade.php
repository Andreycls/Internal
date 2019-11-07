@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    <h3 class="page-title">@lang('quickadmin.generate_ruangan.title')</h3>
    
    @can('pengumuman_create')
    
    <!-- <p>
        <a href="{{ route('admin.gedung.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p> -->
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
        
            @lang('quickadmin.generate_ruangan.fields.ruangan')
        </div>
        
        <div class="panel-body table-responsive">
        Jumlah Gedung &nbsp; :  &nbsp;   {{$gedung->count()}} <br>
        Jumlah Ruangan &nbsp;:  &nbsp;   {{$ruangan}} <br>
       <h2>Lokasi Ujian </h2>
        @foreach ($kota as $kotas => $val)
        <!-- <option value="{{ strtoupper($val) }}"> {{ $val }}</option>    -->
        <h3>{{$val->nama_kota}}</h3> <br>
        Banyak ruangan utama :
        @php
            echo App\Http\Controllers\Admin\GenerateController::totalRuanganUtama($val->nama_kota);
        @endphp
        <br>
        Total pendaftar : 
        
        @php
            echo App\Http\Controllers\Admin\GenerateController::totalPendaftar($val->nama_kota);
            
        @endphp

        <br>Gedung :<br>
        @php
            $viewGedung = App\Http\Controllers\Admin\GenerateController::viewGedung($val->nama_kota);
        
            
        @endphp

    
   @foreach ($viewGedung  as $kotas => $val)
   <h4>{{$val->nama_gedung}}</h4> Banyak ruangan : {{$val->banyak_ruangan}}<br>
   @php
        $init = 0;
       
    @endphp 
   @for ($i = 0; $i <$val->banyak_ruangan; $i++)
        &nbsp;
        <p>Ruangan {{$i+1}} <p>
        &nbsp;
        @for($j=0; $j<=31;$j++)
        <p>___  {{$j+1}}.
        
        
         </p>
        @endfor
        @php
        
        $init= $init +32;

        @endphp

    @endfor
   
    @endforeach
    
        <hr>
        @endforeach
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


