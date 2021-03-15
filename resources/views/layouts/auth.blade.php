<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" />
        <meta content="Soft-Web Digital" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <a href="/">
                                    <span><img src="{{ asset('assets/images/logo.png') }}" alt="" width="50px"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">@yield('desc')</p>
                                </div>
                                @yield('content')
                            </div> 
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                @yield('extra')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-alt">
            2020 &copy; THE EMPOWERMENT NETWORK - Powered by <a href="https://softwebdigital.com">SOFT-WEB DIGITAL</a> 
        </footer>
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>
