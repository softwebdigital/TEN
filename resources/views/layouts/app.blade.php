@php
use App\Http\Controllers\Globals as Util;
$user = Util::getUser();
$passport = Util::getPassport($user);
$notifications = Util::getNotification($user->email);
//$role = Util::getRole($user->role_id);
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Soft-Web Digital" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        @yield('head')
    </head>
    <body>
        <div id="wrapper">
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">{{ count($notifications) }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0 text-white">
                                    <span class="float-right">
                                        <a href="/notifications/clear" class="text-white">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>
                            @if(count($notifications) > 0)
                            <div class="slimscroll noti-scroll">
                                @foreach($notifications as $notification)
                                <a href="/notifications/view/{{ $notification->id }}" class="dropdown-item notify-item active">
                                    <div class="notify-icon">
                                        {{ $notification->icon }}
                                    </div>
                                    <p class="notify-details">{{ ucwords($notification->desc) }}</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>{!! ucfirst($notification->message) !!}</small>
                                    </p>
                                </a>
                                @endforeach
                            </div>
                            <a href="/notifications" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fi-arrow-right"></i>
                            </a>
                            @endif

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ $passport }}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                @php
                                $name = explode(' ', $user->name);
                                $surn = substr($name[1], 0,1);
                                @endphp
                                {{ ucwords($name[0]." ".$surn.". ") }} <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0 text-white">
                                    Welcome {{ ucwords($name[0]) }}
                                </h5>
                            </div>
                            <a href="/account" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>
                </ul>
                <div class="logo-box">
                    <a href="/" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" width="80px">
                        </span>
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/icon.png') }}" alt="" width="50px">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="/">
                                <i class="la la-dashboard"></i>
                                <span class="badge badge-info badge-pill float-right">2</span>
                                <span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="/volunteers">
                                <i class="la la-cube"></i>
                                <span> Volunteers </span>
                                </a>
                            </li>
                            <li>
                                <a href="/beneficiaries">
                                <i class="la la-clone"></i>
                                <span> Beneficiaries </span>
                                </a>
                            </li>
                            <li>
                                <a href="/administrators">
                                <i class="la la-envelope"></i>
                                <span> Administrator </span>
                                </a>
                            </li>
                            <li>
                                <a href="/roles">
                                <i class="la la-file-text-o"></i>
                                <span> Roles </span>
                                </a>
                            </li>
                            <li>
                                <a href="/groups">
                                <i class="la la-diamond"></i>
                                <span class="badge badge-danger float-right">New</span>
                                <span> Groups </span>
                                </a>
                            </li>
                            <li>
                                <a href="/transactions">
                                <i class="la la-line-chart"></i>
                                <span> Transactions </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Supports</li>
                            <li>
                                <a href="/notifications">
                                <i class="la la-briefcase"></i>
                                <span> Notifications </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @yield('breadcrumbs')
                        @if(session()->has('message'))
                          {!! session()->get('message') !!}
                        @endif
                        @yield('content')
                        
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2019 &copy; THE EMPOWERMENT NETWORK
                            </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/libs/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-us-merc-en.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <!-- Customerly Integration Code -->
        <div class="support">
            <script>
            window.customerlySettings = {
                app_id: "90aa0d6c"
            };
            !function(){function e(){var e=t.createElement("script");
            e.type="text/javascript",e.async=!0,
            e.src="https://widget.customerly.io/widget/90aa0d6c";
            var r=t.getElementsByTagName("script")[0];r.parentNode.insertBefore(e,r)}
            var r=window,t=document,n=function(){n.c(arguments)};
            r.customerly_queue=[],n.c=function(e){r.customerly_queue.push(e)},
            r.customerly=n,r.attachEvent?r.attachEvent("onload",e):r.addEventListener("load",e,!1)}();
            </script>  
        </div>
        @yield('foot')
    </body>
</html>