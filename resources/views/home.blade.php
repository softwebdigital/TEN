@extends('layouts.app')

@section('title') Dashboard @endsection

@section('breadcrumbs')
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">TEN</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Control</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card-box">
                                    <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
                                    <h4 class="mt-0 font-16">Paid Out</h4>
                                    <h2 class="text-primary my-4 text-center">₦<span data-plugin="counterup">{{ number_format($total_paid,2) }}</span></h2>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <p class="text-muted mb-1">This Month</p>
                                            <h3 class="mt-0 font-20 text-truncate">₦{{ number_format($total_paid_this_month) }} <small class="badge badge-light-success font-13">
                                                @if($total_paid_this_month < 1)
                                                +0
                                                @else
                                                +{{ number_format(($total_paid_this_month/$total_paid)*100) }}%
                                                @endif
                                                </small></h3>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-muted mb-1">Last Month</p>
                                            <h3 class="mt-0 font-20 text-truncate">
                                                ₦{{ number_format($total_paid_other_month) }} 
                                                <small class="badge badge-light-danger font-13">
                                                @if($total_paid_other_month < 1)
                                                -0
                                                @else
                                                -{{ number_format(($total_paid_other_month/$total_paid)*100) }}%
                                                @endif
                                                </small></h3>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <span data-plugin="peity-line" data-fill="#56c2d6" data-stroke="#4297a6" data-width="100%" data-height="50">3,5,2,9,7,2,5,3,9,6,5,9,7</span>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                            <div class="col-xl-6">
                                <div class="card-box" dir="ltr">
                                    <div class="float-right d-none d-md-inline-block">
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn btn-xs btn-light active">Today</button>
                                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                            <button type="button" class="btn btn-xs btn-light">Monthly</button>
                                        </div>
                                    </div>
                                    <h4 class="header-title mb-1">Transaction History</h4>
                                    <div id="rotate-labels-column" class="apex-charts"></div>
                                </div>
                                <!-- end card-box-->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-3">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-light rounded">
                                                <i class="fe-user avatar-title font-22 text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $beneficiaries }}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Beneficiaries</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Target <span class="float-right">
                                            @php
                                            $perc = ($beneficiaries/8000000)*100;
                                            @endphp
                                            {{ number_format($perc, 0, '', '')}}%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$perc}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$perc}}%">
                                                <span class="sr-only">{{$perc}}% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-box-->
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-light rounded">
                                                <i class="fe-user avatar-title font-22 text-purple"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1"₦<span data-plugin="counterup">{{ $volunteers }}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Volunteers</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Target <span class="float-right">
                                            @php
                                            $perc = ($volunteers/80000)*100;
                                            @endphp
                                            {{ number_format($perc, 0, '', '')}}%%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="{{$perc}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$perc}}%">
                                                <span class="sr-only">{{$perc}}% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- Portlet card -->
                                <div class="card">
                                    <div class="card-body" dir="ltr">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Revenue</h4>
                                        <div id="cardCollpase1" class="collapse pt-3 show">
                                            <div class="bg-soft-light">
                                                <div class="row text-center">
                                                    <div class="col-md-4">
                                                        <p class="text-muted mb-0 mt-3">Today's Earning</p>
                                                        <h2 class="font-weight-normal mb-3">
                                                            <small class="mdi mdi-checkbox-blank-circle text-muted align-middle mr-1"></small>
                                                            <span>₦{{number_format($made,2) }}.<sup class="font-13">25</sup></span>
                                                        </h2>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="text-muted mb-0 mt-3">Total Profit</p>
                                                        <h2 class="font-weight-normal mb-3">
                                                            <small class="mdi mdi-checkbox-blank-circle text-info align-middle mr-1"></small>
                                                            <span>₦{{ number_format($made-$total_paid) }}</span>
                                                        </h2>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="text-muted mb-0 mt-3">Total Paid</p>
                                                        <h2 class="font-weight-normal mb-3">
                                                            <small class="mdi mdi-checkbox-blank-circle text-danger align-middle mr-1"></small>
                                                            <span>₦{{ number_format($total_paid,2) }}.</span>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dash-item-overlay d-none d-md-block">
                                                <h5>Today's Earning: ₦{{ number_format($today,2) }}</h5>
                                                <p class="text-muted font-13 mb-3 mt-2"></p>
                                                <i class="mdi mdi-arrow-right ml-2"></i>
                                                </a>
                                            </div>
                                            <div id="apex-line-1" class="apex-charts" style="min-height: 480px !important;"></div>
                                        </div>
                                        <!-- collapsed end -->
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card-->
                            </div>
                            <!-- end col-->
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Orders Analytics</h4>
                                        <div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
                                            <div id="radar-multiple-series" class="apex-charts"></div>
                                        </div>
                                        <!-- collapsed end -->
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card-->
                                <div class="card cta-box bg-info text-white">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <div class="avatar-md bg-soft-light rounded-circle text-center mb-2">
                                                    <i class="mdi mdi-store font-22 avatar-title text-white"></i>
                                                </div>
                                                <h3 class="m-0 font-weight-normal text-white sp-line-1 cta-box-title">Special launcing <b>today</b> </h3>
                                                <p class="text-white-50 mt-2 sp-line-2"></p>
                                                <a href="javascript: void(0);" class="text-white font-weight-semibold text-uppercase"><!--Read More--> <i class="mdi mdi-arrow-right"></i></a>
                                            </div>
                                            <img class="ml-3" src="assets/images/update.svg" width="120" alt="Generic placeholder image">
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                            </div>
                            <!-- end col-->
                        </div>
                        <!-- end row -->
                        
                        <!--<div class="row">
                            <div class="col-xl-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Top 5 Users Balances</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-centered table-nowrap m-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="2">Profile</th>
                                                    <th>Currency</th>
                                                    <th>Balance</th>
                                                    <th>Reserved in orders</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                    </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                                    </td>
                                                    <td>
                                                        0.00816117 BTC
                                                    </td>
                                                    <td>
                                                        0.00097036 BTC
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="assets/images/users/user-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                    </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Erwin E. Brown</h5>
                                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-currency-eth text-primary"></i> ETH
                                                    </td>
                                                    <td>
                                                        3.16117008 ETH
                                                    </td>
                                                    <td>
                                                        1.70360009 ETH
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="assets/images/users/user-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                    </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Margeret V. Ligon</h5>
                                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-currency-eur text-primary"></i> EUR
                                                    </td>
                                                    <td>
                                                        25.08 EUR
                                                    </td>
                                                    <td>
                                                        12.58 EUR
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="assets/images/users/user-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                    </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Jose D. Delacruz</h5>
                                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-currency-cny text-primary"></i> CNY
                                                    </td>
                                                    <td>
                                                        82.00 CNY
                                                    </td>
                                                    <td>
                                                        30.83 CNY
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="assets/images/users/user-6.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                    </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Luke J. Sain</h5>
                                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                                    </td>
                                                    <td>
                                                        2.00816117 BTC
                                                    </td>
                                                    <td>
                                                        1.00097036 BTC
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>-->
                            <!-- end col -->
                            <!--<div class="col-xl-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Revenue History</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-centered  table-nowrap m-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Marketplaces</th>
                                                    <th>Date</th>
                                                    <th>Payouts</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Themes Market</h5>
                                                    </td>
                                                    <td>
                                                        Oct 15, 2018
                                                    </td>
                                                    <td>
                                                        $5848.68
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-warning">Upcoming</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Freelance</h5>
                                                    </td>
                                                    <td>
                                                        Oct 12, 2018
                                                    </td>
                                                    <td>
                                                        $1247.25
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-success">Paid</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Share Holding</h5>
                                                    </td>
                                                    <td>
                                                        Oct 10, 2018
                                                    </td>
                                                    <td>
                                                        $815.89
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-success">Paid</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Envato's Affiliates</h5>
                                                    </td>
                                                    <td>
                                                        Oct 03, 2018
                                                    </td>
                                                    <td>
                                                        $248.75
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-danger">Overdue</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Marketing Revenue</h5>
                                                    </td>
                                                    <td>
                                                        Sep 21, 2018
                                                    </td>
                                                    <td>
                                                        $978.21
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-warning">Upcoming</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal">Advertise Revenue</h5>
                                                    </td>
                                                    <td>
                                                        Sep 15, 2018
                                                    </td>
                                                    <td>
                                                        $358.10
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-success">Paid</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end .table-responsive-->
                                <!--</div>-->
                                <!-- end card-box-->
                            <!--</div>
                        </div>-->
@endsection
