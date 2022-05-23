<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Dashboard for Software and Website" name="description" />
        <meta content="Uzzal" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CZI :: Dashboard</title>
        <link rel="shortcut icon" href="{{asset('contents/admin')}}/assets/images/csl-icon.png">
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css" id="bootstrap-style"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/icons.min.css"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/app.min.css" id="app-style"/>
        <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/style.css"/>
        @stack('css')
        <script src="{{asset('contents/admin')}}/assets/libs/jquery/jquery.min.js"></script>
    </head>
    <body data-sidebar="dark">
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box">
                          <a href="{{url('dashboard')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('contents/admin')}}/assets/images/csl-icon-white.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('contents/admin')}}/assets/images/csl-logo.png" alt="" height="19">
                            </span>
                          </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge badge-danger badge-pill">0</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    {{-- <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1" key="t-your-order">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a> --}}
                                </div>
                                <div class="p-2 border-top">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle mr-1"></i> <span key="t-view-more">View More..</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{asset('contents/admin')}}/assets/images/users/avatar-black.png" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1" key="t-henry">{{Auth::user()->name}}</span><i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{url('dashboard/account')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span>Profile</span></a>
                                {{-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> <span>My Wallet</span></a>
                                <a class="dropdown-item d-block" href="#"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> <span>Settings</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> <span>Lock screen</span></a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span>Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <div id="sidebar-menu">
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Navigation</li>
                            <li><a href="{{url('dashboard')}}" class="waves-effect"><i class="bx bx-home-circle"></i><span>Dashboard</span></a></li>
                            @if (auth()->user()->hasRole('Super Admin'))
                            <li><a href="{{url('dashboard/user')}}" class="waves-effect"><i class="bx bx-user-circle"></i><span>Users</span></a></li>
                            <li><a href="#" class="waves-effect"><i class="bx bx-cog"></i><span>Manage</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('dashboard/manage/basic')}}">Basic Information</a></li>
                                    <li><a href="{{url('dashboard/manage/social')}}">Social Media</a></li>
                                    <li><a href="{{url('dashboard/manage/contact')}}">Contact Information</a></li>
                                </ul>
                            </li>
                            @endif
                            <li><a href="#" class="waves-effect"><i class="bx bx-package"></i><span>Finance & Accounting</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                                    <li><a href="{{url('dashboard/balance-sheet')}}">Balance Sheet</a></li>
                                    @endif
                                    <li><a href="{{url('dashboard/summary')}}">Cash Balance Summary</a></li>
                                    <li><a href="{{url('dashboard/income')}}">Daily Income</a></li>
                                    <li><a href="{{url('dashboard/expense')}}">Daily Expense</a></li>
                                    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                                    <li><a href="{{url('dashboard/income/category')}}">Income Category</a></li>
                                    <li><a href="{{url('dashboard/expense/category')}}">Expense Category</a></li>
                                    {{-- <li><a href="{{url('/dashboard/cash-flow')}}">Cash Flow</a></li> --}}
                                    <li><a href="{{url('/dashboard/accounts-info')}}">Accounts Info</a></li>
                                    @endif
                                    {{-- <li><a href="#">Loan</a></li>
                                    <li><a href="#">Chart of Accounts</a></li> --}}
                                </ul>
                            </li>
                            @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                            <li><a href="#" class="waves-effect"><i class="bx bx-briefcase-alt-2"></i><span>Human Resource</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('dashboard/employee')}}">Employee Information</a></li>
                                    <li><a href="{{url('dashboard/department')}}">Department</a></li>
                                    <li><a href="{{url('dashboard/designation')}}">Designation</a></li>
                                    <li><a href="{{url('dashboard/shift')}}">Shift</a></li>
                                    <li><a href="{{url('dashboard/attendance')}}">Attendance</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="waves-effect"><i class="bx bx-dollar"></i><span>Payroll</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('dashboard/payroll/salary_type')}}">Salary Type setup</a></li>
                                    <li><a href="{{url('dashboard/payroll/salary_setup')}}">Salary setup</a></li>
                                    {{--<li><a href="{{url('dashboard/payroll/create_salary_generate')}}">Salary generate</a></li>--}}
                                    <li><a href="{{url('dashboard/payroll/employee_payment_view')}}">Manage Employee Salary</a></li>
                                </ul>
                            </li>
                            @endif
                            <li><a href="#" class="waves-effect"><i class="bx bx-data"></i><span>Inventory Management</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('dashboard/material')}}">Material</a></li>
                                    <li><a href="{{url('dashboard/material/purchase')}}"> Material Purchase</a></li>
                                    <li><a href="{{url('dashboard/material/damage')}}">Material Damage</a></li>
                                    <li><a href="{{ url('dashboard/material/stock') }}">Material Purchase Stock</a></li>
                                    <li><a href="{{ url('dashboard/material/used') }}">Material Used</a></li>
                                    <li><a href="{{ url('dashboard/imported-product') }}">Imported Product</a></li>
                                    <li><a href="{{ url('dashboard/imported-product/stock') }}">Imported Product Stock</a></li>
                                   {{-- <li><a href="{{ url('dashboard/material/stock/list') }}">Material Stock list</a></li>--}}
                                </ul>
                            </li>
                            <li><a href="#" class="waves-effect"><i class="bx bx-data"></i><span>Recipe </span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('dashboard/recipe') }}">Recipe List</a></li>
                                    <li><a href="{{ url('dashboard/recipe-product/list') }}">Recipe Product List</a></li>
                                    <li><a href='{{ url('dashboard/recipe-make') }}'> Make Recipe</a></li>
                                    <li><a href='{{ url('dashboard/recipe-make-list') }}'> Make Recipe list</a></li>
                                    <li><a href='{{ url('dashboard/recipe-product') }}'>Recipe Products</a></li>
                                    <li><a href="{{ url('dashboard/make-product/Stock') }}">Made Products Stock</a></li>
                                </ul>
                            </li>
                            @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                            <li><a href="#" class="waves-effect"><i class="bx bx-user-pin"></i><span>Customer</span></a>
                                <ul>
                                    <li><a href='{{url('dashboard/customer')}}'>All Customers</a></li>
                                    <li><a href='{{ url('dashboard/customer/product-deliver') }}'>Customer product-deliver</a></li>
                                    <li><a href='{{ url('dashboard/customer/payment') }}'>Customer payment</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="waves-effect"><i class="bx bx-happy-alt"></i><span>Suppliers</span></a>
                                <ul>
                                    <li><a href='{{url('dashboard/supplier')}}'>All Suppliers</a></li>
                                    <li><a href="{{ url('dashboard/material/supplier-payment') }}">Supplier payment </a></li>
                                </ul>
                            </li>
                            @endif
                            @if (auth()->user()->hasRole('Super Admin'))
                            <li><a href="{{url('dashboard/recycle')}}" class="waves-effect"><i class="bx bx-trash"></i><span>Recycle</span></a></li>
                            @endif
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="bx bx-power-off"></i><span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Home</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                Copyright © 2021 | All rights reserved by Dashboard.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Development by Creative System Limited.
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> -->
        <script src="{{asset('contents/admin')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{asset('contents/admin')}}/assets/libs/node-waves/waves.min.js"></script>
        {{-- <script src="{{asset('contents/admin')}}/assets/js/pages/dashboard.init.js"></script> --}}
        <script src="{{asset('contents/admin')}}/assets/js/app.js"></script>
        <script src="{{asset('contents/admin')}}/assets/js/custom.js"></script>
        @stack('scripts')
    </body>
</html>
