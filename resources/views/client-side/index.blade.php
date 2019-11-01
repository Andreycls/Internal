<!DOCTYPE html>
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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/pluton.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/yasop_logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/yasop_logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/yasop_logo.png">
        <link rel="apple-touch-icon-precomposed" href="images/yasop_logo.png">
        <link rel="shortcut icon" href="images/yasop_logo.png">
    </head>
    
    <body>
    <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                
                    <a href="#" class="brand">
                        <img src="images/yasop_logo.png"  alt="Logo" />
						
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
                            <li class="active"><a href="{{ url('/beranda') }}">Beranda</a></li> 
                            <li><a href="{{ url('/pendaftaran') }}">Pendaftaran</a></li>
                            <li><a href="#pengumuman">Pengumuman</a></li>
                            <li><a href="#about">Panduan</a></li>
                            <li><a href="#lokasi">Lokasi</a></li>
                            
                           
                            <!-- <li><a href="#price">Price</a></li> -->
                            <li><a href="#contact">Kontak</a></li>
                        </ul>
                    </div>
        
                     </div>
                
            </div>
        </div>
        <!-- Start home section -->
        <div id="home">
            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <!-- <div class="triangle"></div> -->
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->
                <div class="container">
                    <!-- Start first slide -->
                    <div class="da-slide">
                        <h2 class="fittext2" style="color:white">{{$last->title}}</h2>
                        <a href="{{ url('/pengumuman') }}" class="da-link button">Baca selengkapnya</a>
                        <div class="da-img">
                            <img src="images/pengumuman_h.png" alt="image01" width="320">
                        </div>
                    </div>
                    <!-- End first slide -->
                    <!-- Start second slide -->
                    <div class="da-slide">
                        <h2 style="color:white">Lokasi Ujian</h2>
                        <p>Lokasi kota dan gedung yang tersedia</p>
                        <a href="#lokasi" class="da-link button">Baca selengkapnya</a>
                        <div class="da-img">
                            <img src="images/worldwide-location.png" width="320" alt="image02">
                        </div>
                    </div>
                    <!-- End second slide -->
                    <!-- Start third slide -->
                    <div class="da-slide">
                        <h2 style="color:white">Panduan</h2>
                        <p>Panduan dan pertanyaan seputar pendaftaran</p>
                        <a href="#" class="da-link button">Baca selengkapnya</a>
                        <div class="da-img">
                            <img src="images/rules-icon.png" width="320" alt="image03">
                        </div>
                    </div>
                    <!-- Start third slide -->
                    <!-- Start cSlide navigation arrows -->
                    <div class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </div>
                    <!-- End cSlide navigation arrows -->
                </div>
            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="pengumuman">
            <div class="container">
                <!-- Start title section -->
                <div class="title">


                    <h1>Pengumuman</h1>
                    <!-- Section's title goes here -->
                    <p>Pengumuman terkait Seleksi Penerimaan Siswa Baru</p>
                    <!--Simple description for section goes here. -->
                </div>
                <ul id="portfolio-grid" class="thumbnails row">
                    @if (count($pengumuman) > 0)
                    
                        @foreach ($pengumuman->take(6) as $pengumuman)
                        
                        <li class="span4 mix web">
                        <a href="{{ url('pengumuman/'.$pengumuman->id) }}" >
                         
                            <div class="thumbnail" style="background-color:#416780">
                           
                            
                                <div class="thumbnail-img" >
                           
                           
                                </div>
                                
                                <div class="mask" style="color:#002640"><h2><br><br><br><strong>Baca Selengkapnya </strong></h2></div>
                                <h4 style="margin-left:15px;color:white;text-align:left;text-transform:uppercase">{{ $pengumuman->title }} </h4>
                               
                            <p style="color: #74A8E3  ;text-align:left"><i class="far fa-calendar-alt" style="color:#74A8E3"></i> &nbsp; {{date(' d F Y H:i', strtotime($pengumuman->updated_at))}}</p>
                            </div>
                            
                            </a>
                        </li>

                    @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </ul>
                <a href="{{ url('pengumuman') }}" class="btn btn-success"> <h4 style="color:#003152"><strong> Lihat seluruh pengumuman </strong></h4></a>
               
            </div>
        </div>
        <!-- Service section end -->
        <!-- Portfolio section start -->
        <div class="section secondary-section " id="pengumuman">
            <div class="triangle"></div>
            <div class="container">
                
                
                <!-- Start details for portfolio project 1 -->
                <div id="single-project">
                    <div id="slidingDiv" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio01.png" alt="project 1" />
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Believe in yourself! Have faith in your abilities! Without a humble but reasonable confidence in your own powers you cannot be successful or happy.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 1 -->
                    <!-- Start details for portfolio project 2 -->
                    <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio02.png" alt="project 2">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Life is a song - sing it. Life is a game - play it. Life is a challenge - meet it. Life is a dream - realize it. Life is a sacrifice - offer it. Life is love - enjoy it.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 2 -->
                    <!-- Start details for portfolio project 3 -->
                    <div id="slidingDiv2" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio03.png" alt="project 3">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>How far you go in life depends on your being tender with the young, compassionate with the aged, sympathetic with the striving and tolerant of the weak and strong. Because someday in your life you will have been all of these.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 3 -->
                    <!-- Start details for portfolio project 4 -->
                    <div id="slidingDiv3" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio04.png" alt="project 4">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Project for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Life's but a walking shadow, a poor player, that struts and frets his hour upon the stage, and then is heard no more; it is a tale told by an idiot, full of sound and fury, signifying nothing.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 4 -->
                    <!-- Start details for portfolio project 5 -->
                    <div id="slidingDiv4" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio05.png" alt="project 5">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>We need to give each other the space to grow, to be ourselves, to exercise our diversity. We need to give each other space so that we may both give and receive such beautiful things as ideas, openness, dignity, joy, healing, and inclusion.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 5 -->
                    <!-- Start details for portfolio project 6 -->
                    <div id="slidingDiv5" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio06.png" alt="project 6">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>I went to the woods because I wished to live deliberately, to front only the essential facts of life, and see if I could not learn what it had to teach, and not, when I came to die, discover that I had not lived.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 6 -->
                    <!-- Start details for portfolio project 7 -->
                    <div id="slidingDiv6" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio07.png" alt="project 7">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Always continue the climb. It is possible for you to do whatever you choose, if you first get to know who you are and are willing to work with a power that is greater than ourselves to do it.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 7 -->
                    <!-- Start details for portfolio project 8 -->
                    <div id="slidingDiv7" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio08.png" alt="project 8">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>What if you gave someone a gift, and they neglected to thank you for it - would you be likely to give them another? Life is the same way. In order to attract more of the blessings that life has to offer, you must truly appreciate what you already have.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 8 -->
                    <!-- Start details for portfolio project 9 -->
                    <div id="slidingDiv8" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/Portfolio09.png" alt="project 9">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>I learned that we can do anything, but we can't do everything... at least not at the same time. So think of your priorities not in terms of what activities you do, but when you do them. Timing is everything.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 9 -->
                    <ul id="portfolio-grid" class="thumbnails row">
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/Portfolio01.png" alt="project 1">
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/Portfolio02.png" alt="project 2">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv1">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/Portfolio03.png" alt="project 3">
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv2">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/Portfolio04.png" alt="project 4">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv3">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/Portfolio05.png" alt="project 5">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv4">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/Portfolio06.png" alt="project 6">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv5">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/Portfolio07.png" alt="project 7" />
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv6">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/Portfolio08.png" alt="project 8">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv7">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/Portfolio09.png" alt="project 9">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv8">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Portfolio section end -->
        <!-- About us section start -->
        <div class="section primary-section" id="about">
            <div class="triangle"></div>
            <div class="container">
                <div class="title">
                <style>
                
                .bs-example {
                    margin: 1px;
                    }
                .vl {
                    border-left: 2px solid green;
                    height: 80px;
                    width:2px;
                }
                </style>
                <div class="bs-example"> 
      <!-- Example row of columns -->
      

                    <h1>Panduan</h1>
                    <p>Panduan dan pertanyaan terkait pendaftaran dan seleksi</p>
                    <hr style="border-top: 1px solid blue;">
                </div>
                
                    @if (count($panduan) > 0)
                    
                        @foreach ($panduan as $panduan)
                        <div class="bs-example"> 
                        <div class="row">
                        <div class="span1">
                        </div>
        <div class="span4 collapse-group">
        
        <h4 style="color:black;text-align:left">&nbsp;  {{ $panduan->question }} </h4>
        <p style="text-align:right"><a class="btn btn-info" data-toggle="collapse" data-target="#{!!$panduan->id!!}">Jawaban &raquo;</a></p>
        </div>
        <div class="span6">
           <p style="margin-top:10px;margin-left:15px;text-align:left;" class="collapse" id="{!!$panduan->id!!}">{{strip_tags($panduan->answer)}}</p>
          </div>
      </div>                      
      </div>
                               
                    @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                
            </div>
        </div>
        <!-- About us section end -->
        <div class="section secondary-section " id="pengumuman">
            <div class="triangle"></div>
        
        </div>
        <!-- Client section start -->
        <!-- Client section start -->
        <div id="clients">
            <div class="section primary-section" id="lokasi">
                <div class="triangle"></div>
                <div class="container">
                    <div class="title">
                    <div class="bs-example">
                        <h1>Lokasi Ujian</h1>
                        <p>Lokasi seleksi penerimaan siswa baru yayasan soposurung</p>
                    </div>
                    

        @if (count($kota) > 0)
                    
                    @foreach ($kota as $kota)
                    <div class="bs-example"> 
                    <div class="row">
                    <div class="span1">
                    </div>
    <div class="span4 collapse-group">
    <div class="span1" style="width:10px;">
    <div class="vl"></div>
    </div>
    <h2 style="color:black;text-align:left; margin-bottom:20px;">&nbsp;  {{ $kota->nama_kota }} </h2>
    <p style="text-align:right">
    </div>
    <div class="span6">
    @php
    $gedong=\App\Gedung::where(['kota' => $kota->nama_kota])->pluck('nama_gedung');
    $alamat=\App\Gedung::where(['kota' => $kota->nama_kota])->pluck('alamat');
    
    @endphp
    @for ($x = 0; $x < count($gedong); $x++)
    <h4 style="margin-top:10px;text-align:left"  id="{!!$kota->nama_kota!!}"><span></span><strong>- {{$gedong[$x]}}</strong><br>{{$alamat[$x]}}</p>
    @endfor
      </div>
  </div>                      
  </div>
                           
                @endforeach
                @else
                    <tr>
                        <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                    



                    
                </div>
            </div>
        </div>
        
        <!-- Price section start -->
        <!--
        <div id="price" class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>Price</h1>
                    <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
                </div>
                <div class="price-table row-fluid">
                    <div class="span4 price-column">
                        <h3>Basic</h3>
                        <ul class="list">
                            <li class="price">$19,99</li>
                            <li><strong>Free</strong> Setup</li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>5 GB</strong> File Storage</li>
                        </ul>
                        <a href="#" class="button button-ps">BUY</a>
                    </div>
                    <div class="span4 price-column">
                        <h3>Pro</h3>
                        <ul class="list">
                            <li class="price">$39,99</li>
                            <li><strong>Free</strong> Setup</li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>25 GB</strong> File Storage</li>
                        </ul>
                        <a href="#" class="button button-ps">BUY</a>
                    </div>
                    <div class="span4 price-column">
                        <h3>Premium</h3>
                        <ul class="list">
                            <li class="price">$79,99</li>
                            <li><strong>Free</strong> Setup</li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>50 GB</strong> File Storage</li>
                        </ul>
                        <a href="#" class="button button-ps">BUY</a>
                    </div>
                </div>
                <div class="centered">
                    <p class="price-text">We Offer Custom Plans. Contact Us For More Info.</p>
                    <a href="#contact" class="button">Contact Us</a>
                </div>
            </div>
        </div>
       

        -->
        <!-- Newsletter section start 
        <div class="section third-section">
            <div class="container newsletter">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>Newsletter</h3>
                        </div>
                    </div>
                </div>
                <div id="success-subscribe" class="alert alert-success invisible">
                    <strong>Well done!</strong>You successfully subscribet to our newsletter.</div>
                <div class="row-fluid">
                    <div class="span5">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                    <div class="span7">
                        <form class="inline-form">
                            <input type="email" name="email" id="nlmail" class="span8" placeholder="Enter your email" required />
                            <button id="subscribe" class="button button-sp">Subscribe</button>
                        </form>
                        <div id="err-subscribe" class="error centered">Please provide valid email address.</div>
                    </div>
                </div>
            </div>
        </div>
   -->

        <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section secondary-section">
                <div class="container">
                    <div class="title">
                        <h1>Hubungi kami</h1>
                        <p>Silahkan hubungi kami jika ada pernyataan yang ingin disampaikan.</p>
                    </div>
                </div>
                <div class="map-wrapper">
                    <div class="map-canvas" id="map-canvas">Loading map...</div>
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span5 contact-form centered">
                                <h3>Panitia SPSB Yayasan Soposurung</h3>
                                <div id="successSend" class="alert alert-success invisible">
                                    <strong>Well done!</strong>Your message has been sent.</div>
                                <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                                <form id="contact-form" action="php/mail.php">
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="text" id="name" name="name" placeholder="* Nama anda..." />
                                            <div class="error left-align" id="err-name">Masukkan Nama Anda</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="email" name="email" id="email" placeholder="* Email anda..." />
                                            <div class="error left-align" id="err-email">Masukkan email anda</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <textarea class="span12" name="comment" id="comment" placeholder="* Pertanyaan anda..."></textarea>
                                            <div class="error left-align" id="err-comment">Masukkan pertanyaan Anda</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="send-mail" class="message-btn">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section third-section">
            <div class="container centered">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3 style="color:white">Bekerja sama dengan</h3>
                        </div>
                        <ul class="client-nav pull-right">
                            <li id="client-prev"></li>
                            <li id="client-next"></li>
                        </ul>
                    </div>
                    <ul class="row client-slider" id="clint-slider">
                        <li>
                            <a href="">
                                <img src="images/briva.png" alt="client logo 1">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/briapi.png" alt="client logo 2">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/clients/ClientLogo03.png" alt="client logo 3">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/clients/ClientLogo04.png" alt="client logo 4">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/clients/ClientLogo05.png" alt="client logo 5">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/clients/ClientLogo02.png" alt="client logo 6">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/clients/ClientLogo04.png" alt="client logo 7">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
                <div class="container">
                    <div class="span9 center contact-info">
                        <p style="color:white">Jl. Dr. Adrianus Sinaga No.1, Soposurung, Balige, Hinalang Bagasan, Balige, Kabupaten Toba Samosir, Sumatera Utara 22312</p>
                        <p class="info-mail">contact@yasop.org</p>
                        <p style="color:white">Telp/Fax: (0632)-21496 (Senin - Sabtu, 08.00 - 17.00 WIB)</p>
                        <p style="color:white">HP : 0853-5825-9916 (Senin - Sabtu, 08.00 - 17.00 WIB)</p>

                        <div class="title">
                            <h3>Asrama Yayasan Soposurung - SMAN 2 Balige</h3>
                        </div>
                    </div>
                    <div class="row-fluid centered">
                        
                    </div>
                </div>
            </div>
        </div>




































































        <!-- 6b2222 Contact section edn -->
        
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
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>