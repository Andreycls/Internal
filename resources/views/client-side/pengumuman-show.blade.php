<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPSB Asrama Yayasan Soposurung</title>
        <!-- Load Roboto font -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-responsive.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pluton.css') }}" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.cslider.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.bxslider.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('images/yasop_logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/yasop_logo.png') }}">
   
   
   <style>
   #myTable{
       width:95%;
       margin:0 auto;
   }
   #myTable_length {
    margin-right:35px;
    float: right;
    text-align: right;
}
#myTable_filter {
    margin-left:35px;
    
}
#myTable_paginate{
    text-align: center;
}
#myTable_previous{
    margin-right: 10px;
}
#myTable_next{
    margin-left: 10px;
}
#myTable_info{
    margin-left:35px;
}
.row{
 margin-left:0px;   
}

   
   </style>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    </head>
    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                
                    <a href="#" class="brand">
                        <img src="{{ asset('images/yasop_logo.png') }}"  alt="Logo" />
						
                        <!-- This is website logo -->
                    </a>
                    
                        <div class = "title-container">
					    <p style="color:white"><b>Seleksi Penerimaan Siswa Baru Asrama Yayasan Soposurung Tunas Bangsa </b></p>
					    </div>
                    
					<!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                        <li ><a href="{{ url('/beranda') }}">Beranda</a></li> 
                            <li class="active"><a href="{{ url('/pendaftaran') }}">Pendaftaran</a></li>
                            <li><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
                            <li><a href="{{ url('/beranda') }}#about">Panduan</a></li>
                            <li><a href="{{ url('/beranda') }}#lokasi">Lokasi</a></li>
                            <li><a href="{{ url('/beranda') }}#contact">Kontak</a></li>
                        </ul>
                    </div>
        
                    <!-- End main navigation -->
                </div>
                
            </div>
        </div>
        <!-- Start home section -->
                <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Pengumuman</h1>
                    <!-- Section's title goes here -->
                    <p>Pengumuman terkait Seleksi Penerimaan Siswa Baru</p>
                    <!--Simple description for section goes here. -->
                </div>
                
            </div>
       

















        @extends('layouts.pengumuman')

@section('content')
    
    <div class="panel panel-default">
        

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-08">
                    <table class="table table-bordered table-striped">
                        
                        <tr>
                            <th><p>@lang('quickadmin.pengumuman.fields.title')</p></th>
                            <td field-key='title'><p>{{ $pengumuman->title }}</p></td>
                        </tr>
                        <tr>
                            <th><p>@lang('quickadmin.pengumuman.fields.content')</p></th>
                            <td field-key='content'><p>{!! $pengumuman->content!!}</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            
</div>

             </div>
    </div>
@stop



















































































        <!-- Service section end -->
        <!-- Portfolio section start -->
        
               <!-- <div class="container-footer" style="background-color:#003152">
                    <div class="span9 center contact-info">
                        <p>Jl. Dr. Adrianus Sinaga No.1, Soposurung, Balige, Hinalang Bagasan, Balige, Kabupaten Toba Samosir, Sumatera Utara 22312</p>
                        <p class="info-mail">contact@yasop.org</p>
                        <p>Telp/Fax: (0632)-21496 (Senin - Sabtu, 08.00 - 17.00 WIB)
                        <br>HP : 0853-5825-9916 (Senin - Sabtu, 08.00 - 17.00 WIB)</p>

                            <h3>Asrama Yayasan Soposurung - SMAN 2 Balige</h3>
                        </div>
                    <div class="row-fluid centered">
                        
                    </div>
                </div>
            </div>
        </div> -->
        
        <!-- Footer section start -->
        <!-- <div class="footer">
             </div>
        Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mixitup.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/modernizr.custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.bxslider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.cslider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.placeholder.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.inview.js') }}"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        
@include('partials.javascripts')
    </body>
</html>