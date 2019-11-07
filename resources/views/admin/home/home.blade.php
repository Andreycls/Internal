@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
<div class="row">
        <div class="col-md-12">
        <div class="row">
          



          <div class="col-lg-3 col-xs-6">
              <!-- small box -->

    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{$totalPendaftar}}<sup style="font-size: 20px"></sup></h3>

        <p>Pendaftar</p>
      </div>
      <div class="icon">
        <i class="fa fa-male"></i>
      </div>
      <a href="{{ route('admin.pendaftaran.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>






          <div class="col-lg-3 col-xs-6">
              <!-- small box -->

    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$gedung->count()}}<sup style="font-size: 20px"></sup></h3>

        <p>Gedung</p>
      </div>
      <div class="icon">
        <i class="fa fa-building-o"></i>
      </div>
      <a href="{{ route('admin.gedung.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
    

          <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{$kota->count()}}<sup style="font-size: 20px"></sup></h3>

        <p>Kota</p>
      </div>
      <div class="icon">
        <i class="fa fa-map-signs"></i>
      </div>
      <a href="{{ route('admin.kota.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$user->count()}}<sup style="font-size: 20px"></sup></h3>

        <p>Admin</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="{{ route('admin.users.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>

  </div>

</div>  
        <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>
                <style>
                .small-box{
                    border-radius:10px;
                }


                </style>
          
          
          <div class="panel-body">
          
          <div id="chart-div" ></div>
@donutchart('kota', 'chart-div')
<div id="charts-div" ></div>
@donutchart('IMDB', 'charts-div')
<div id="chart-div" ></div>
@donutchart('kota', 'chart-div')


Response After create VA :
{{!!$responseCreateVA!!}}

<br><br>
Response Get Report :
{{!!$getStatusVA!!}}
<br><br>
Response :
{!!$responseName!!}

<br><br>
EMAIL : {!!$email!!}

                </div>
            </div>
        </div>
    </div>
@endsection
