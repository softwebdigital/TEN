<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>@yield('title') - The Empowerment Network</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
		@stack('more-styles')
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			<div class="navbar-custom">
				<ul class="list-unstyled topnav-menu float-right mb-0">
					{{--<li class="dropdown notification-list">
						<a class="nav-link dropdown-toggle waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fe-bell noti-icon"></i>
						@if(auth()->user()->unreadNotifications()->count() > 0)
						<span class="badge badge-danger rounded-circle noti-icon-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
						@endif
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-lg">
							<div class="dropdown-item noti-title">
								<h5 class="m-0 text-white">
									<span class="float-right">
									<a href="/notifications/all/clear" class="text-white">
									<small>Clear All</small>
									</a>
									</span>Notification
								</h5>
							</div>
							<div class="slimscroll noti-scroll">
								@foreach(auth()->user()->unreadNotifications as $notification)
								<a href="/notifications/view/{{ $notification->id }}" class="dropdown-item notify-item active">
									{!! $notification->data['icon'] !!}
									<p class="notify-details">{!! $notification->data['title'] !!}</p>
									<p class="text-muted mb-0 user-msg">
										<small>{!! $notification->data['body'] !!}</small>
									</p>
								</a>
								@endforeach
							</div>
							<a href="/notifications" class="dropdown-item text-center text-primary notify-item notify-all">
							View all
							<i class="fi-arrow-right"></i>
							</a>
						</div>
					</li>--}}
					<li class="dropdown notification-list">
						<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<img src="{{ auth()->user()->passport() }}" alt="user-image" class="rounded-circle">
						<span class="pro-user-name ml-1">
						{{ auth()->user()->nameSync() }}. <i class="mdi mdi-chevron-down"></i> 
						</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
							<div class="dropdown-item noti-title">
								<h5 class="m-0 text-white">
									Welcome !
								</h5>
							</div>
							<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
							<i class="fe-log-out"></i>
							<span>Logout</span>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		                        @csrf
		                    </form>
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
                                <a href="{{ route('admin.home') }}">
                                <i class="la la-dashboard"></i>
                                <span> Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="/admin/volunteers">
                                <i class="la la-cube"></i>
                                <span> Volunteers </span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/beneficiaries">
                                <i class="la la-clone"></i>
                                <span> Beneficiaries </span>
                                </a>
                            </li>

                            <li>
                                <a href="/admin/groups">
                                <i class="la la-diamond"></i>
                                <span> Groups </span>
                                </a>
                            </li>
							<li>
								<a href="/admin/pending_payments">
								<i class="la la-credit-card"></i>
								<span> Pending Payments </span>
								</a>
							</li>
                            <li class="menu-title">Administrations</li>
                            <li>
                                <a href="/admin/administrators">
                                <i class="la la-envelope"></i>
                                <span> Administrator </span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/roles">
                                <i class="la la-file-text-o"></i>
                                <span> Roles </span>
                                </a>
                            </li>
                            <li class="menu-title">Payments</li>
                            <li>
								<a href="/admin/thrifts">
								<i class="la la-money"></i>
								<span> Thrifts </span>
								</a>
							</li>
							<li>
								<a href="/admin/payments">
								<i class="la la-credit-card"></i>
								<span> Payments </span>
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
						@yield('bread')
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
								{{date('Y')}} &copy; THE EMPOWERMENT NETWORK
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
		<script src="{{ asset('assets/js/app.min.js') }}"></script>
		@stack('more-scripts')
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		@if(session()->has('error_bottom'))
          {!! session()->get('error_bottom') !!}
        @endif
        <script type="text/javascript">
        	$(function(){
        		$('.miAction').click(function(e){
        			e.preventDefault();
        			var desc = $(this).attr('data-desc');
        			var link = $(this).attr('href');
        			Swal.fire({
						type: 'question',
						title: 'Are you sure?',
						text: desc,
						showCancelButton: true,
		                confirmButtonText: 'Yes, proceed!',
		                cancelButtonText: 'No, cancel!',
		                confirmButtonClass: 'btn btn-success',
		                cancelButtonClass: 'btn btn-danger ml-2',
		                buttonsStyling: false
					}).then((result) => {
		                if(result.isConfirmed){
		                    window.location.href = link;
		                }
		            });
        		});

        		$('.miActionSubmit').click(function(e){
        			e.preventDefault();
        			var desc = $(this).attr('data-desc');
        			var form = $(this).attr('data-form');
        			Swal.fire({
						type: 'question',
						title: 'Are you sure?',
						text: desc,
						showCancelButton: true,
		                confirmButtonText: 'Yes, proceed!',
		                cancelButtonText: 'No, cancel!',
		                confirmButtonClass: 'btn btn-success',
		                cancelButtonClass: 'btn btn-danger ml-2',
		                buttonsStyling: false
					}).then((result) => {
						if (result.isConfirmed) {
							$('.'+form).submit();
						}
					});
        		});
        	});
        </script>
	</body>
</html>