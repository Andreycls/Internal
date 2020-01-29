@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/beranda') }}">
                    <i class="fa fa-home"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>




            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span class="title">@lang('quickadmin.jadwal-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.jadwal.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span class="title">
                                @lang('quickadmin.jadwal.title')
                            </span>
                        </a>
                    </li>
                @endcan
               
                </ul>
            </li>
            @endcan



            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building-o"></i>
                    <span class="title">@lang('quickadmin.ruangan-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.generate.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span class="title">
                                @lang('quickadmin.generate_ruangan.title')
                            </span>
                        </a>
                    </li>
                @endcan
               
                </ul>
            </li>
            @endcan




            <!-- Bagian Pengumuman -->
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-male"></i>
                    <span class="title">@lang('quickadmin.pendaftar-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.pendaftaran.create') }}">
                            <i class="fa fa-group"></i>
                            <span class="title">
                                @lang('quickadmin.pendaftar.fields.pendaftaranOffline')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ url('admin/pendaftar/list_pendaftar_offline') }}">
                            <i class="fa fa-group"></i>
                            <span class="title">
                                @lang('quickadmin.pendaftar.fields.daftarOffline')
                            </span>
                        </a>
                    </li>
                @endcan
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ url('admin/pendaftar/list_pendaftar_online') }}">
                            <i class="fa fa-group"></i>
                            <span class="title">    
                                @lang('quickadmin.pendaftar.fields.daftarOnline')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ url('admin/pendaftar/verifikasi') }}">
                            <i class="fa fa-group"></i>
                            <span class="title">    
                                @lang('quickadmin.pendaftar.fields.verifikasi')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            





            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan


            <!-- Bagian Pengumuman -->
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i>
                    <span class="title">@lang('quickadmin.pengumuman-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.pengumuman.index') }}">
                            <i class="fa fa-bell"></i>
                            <span class="title">
                                @lang('quickadmin.pengumuman.title')
                            </span>
                        </a>
                    </li>
                @endcan
               
                </ul>
            </li>
            @endcan
            <!-- Akhir Bagian Pengumuman -->
            <!-- Awal Bagian Lokasi -->
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-location-arrow"></i>
                    <span class="title">@lang('quickadmin.lokasi-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.kota.index') }}">
                            <i class="fa fa-bank"></i>
                            <span class="title">
                                @lang('quickadmin.kota.title')
                            </span>
                        </a>
                    </li>
                @endcan

                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.gedung.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span class="title">
                                @lang('quickadmin.lokasi.fields.Hall')
                            </span>
                        </a>
                    </li>
                @endcan
                <!-- @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.ruangan.index') }}">
                            <i class="fa fa-map-signs"></i>
                            <span class="title">
                                @lang('quickadmin.lokasi.fields.Room')
                            </span>
                        </a>
                    </li>
                @endcan -->
               
                </ul>
            </li>
            @endcan
            <!-- Akhir Bagian Lokasi -->

            <!-- Awal Bagian FAQ -->
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-quote-right"></i>
                    <span class="title">@lang('quickadmin.FAQ-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.panduan.index') }}">
                            <i class="fa fa-question-circle"></i>
                            <span class="title">
                                @lang('quickadmin.FAQ.title')
                            </span>
                        </a>
                    </li>
                @endcan
               
                </ul>
            </li>
            @endcan
            <!-- Akhir Bagian FAQ -->
           
           
           
            {{--
            <!--
            @can('expense_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span class="title">@lang('quickadmin.expense-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('expense_category_access')
                <li class="{{ $request->segment(2) == 'expense_categories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.expense_categories.index') }}">
                            <i class="fa fa-list"></i>
                            <span class="title">
                                @lang('quickadmin.expense-category.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('income_category_access')
                <li class="{{ $request->segment(2) == 'income_categories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.income_categories.index') }}">
                            <i class="fa fa-list"></i>
                            <span class="title">
                                @lang('quickadmin.income-category.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('income_access')
                <li class="{{ $request->segment(2) == 'incomes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.incomes.index') }}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span class="title">
                                @lang('quickadmin.income.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('expense_access')
                <li class="{{ $request->segment(2) == 'expenses' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.expenses.index') }}">
                            <i class="fa fa-arrow-circle-left"></i>
                            <span class="title">
                                @lang('quickadmin.expense.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('monthly_report_access')
                <li class="{{ $request->segment(2) == 'monthly_reports' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.monthly_reports.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">
                                @lang('quickadmin.monthly-report.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('currency_access')
                <li class="{{ $request->segment(2) == 'currencies' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.currencies.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">
                                @lang('quickadmin.currency.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
                -->
            --}}

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

