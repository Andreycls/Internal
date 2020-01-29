<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/beranda') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           @lang('quickadmin.quickadmin_title')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           @lang('quickadmin.quickadmin_title')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <style>

        .acc-holder{
            float:right;
            margin-right:0px;
            height:50px;
            width:20%;
            color:white;
            text-align:right;
            background-color: #4199CC;
            border-radius:10px;
        }

        .acc-holder > h5{
            margin-right:10px;
            text-align:right;
            font-size:2vw;
        }

        .acc-holder > p{
            margin-right:10px;
            margin-bottom:auto;
        }

        .acc-holder img{
            width:20%;
            height:20%;
            margin-right:20px;
            margin-top:3px;
        }
        
        </style>
        <div class="acc-holder">
            <div class="row">
                <div style="margin-left:20px;" class ="col-sm-6">
                    <h5><strong> {{ Auth::user()->name }} </strong><br>
                                 {{ Auth::user()->role->title }}
                </div>
                <img src="{{ asset('images/ava.png') }}"  alt="Logo" />
            </div>
        </div>
    </nav>

</header>



