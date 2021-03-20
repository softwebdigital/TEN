@extends('layouts.admin')

@section('title', __('Admin Dashboard'))

@push('more-styles')
<link href="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('more-scripts')
<script src="{{ asset('assets/libs/peity/jquery.peity.min.js') }}"></script>
{{--<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-us-merc-en.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/libs/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>--}}

<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ $chart->cdn() }}"></script>
{!! $chart->script() !!}
{!! $chart2->script() !!}
{!! $chart3->script() !!}
@endpush

@section('bread')
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">TEN</a></li>
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
	<div class="col-xl-3 col-md-6">
		<div class="card-box">
		    <div class="row">
		        <div class="col-6">
		            <div class="avatar-sm bg-light rounded">
		                <i class="fe-clipboard avatar-title font-22 text-success"></i>
		            </div>
		        </div>
		        <div class="col-6">
		            <div class="text-right">
		                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $groups }}</span></h3>
		                <p class="text-muted mb-1 text-truncate">Groups</p>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card-box">
		    <div class="row">
		        <div class="col-6">
		            <div class="avatar-sm bg-light rounded">
		                <i class="fe-clipboard avatar-title font-22 text-success"></i>
		            </div>
		        </div>
		        <div class="col-6">
		            <div class="text-right">
		                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $users }}</span></h3>
		                <p class="text-muted mb-1 text-truncate">Volunteers</p>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card-box">
		    <div class="row">
		        <div class="col-6">
		            <div class="avatar-sm bg-light rounded">
		                <i class="fe-users avatar-title font-22 text-success"></i>
		            </div>
		        </div>
		        <div class="col-6">
		            <div class="text-right">
		                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $beneficiaries->count() }}</span></h3>
		                <p class="text-muted mb-1 text-truncate">Beneficiaries</p>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card-box">
			<h4 class="header-title mt-0 mb-3">Paid Out</h4>
			<div class="mt-1">
				<div class="float-left" dir="ltr">
					<div class="avatar-sm bg-light rounded">
		                <i class="fe-users avatar-title font-22 text-success"></i>
		            </div>
				</div>
				<div class="text-right">
					<h2 class="mt-3 pt-1 mb-1"> ₦{{ number_format($total_paid,2) }} </h2>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3">
		<div class="card-box">
			<i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
			<h4 class="mt-0 font-16">Paid Out</h4>
			<h2 class="text-primary my-4 text-center">₦<span data-plugin="counterup">{{ number_format($total_paid) }}</span></h2>
			<div class="row mb-4">
				<div class="col-6">
					<p class="text-muted mb-1">This Month</p>
					<h3 class="mt-0 font-20 text-truncate">₦{{ number_format($this_month,2) }} 
						@if($last_month > $this_month)
						<small class="badge badge-light-success font-13">
						{{ number_format($this_month-$last_month,2) }}
						</small>
						@else
						<small class="badge badge-light-success font-13">
						{{ number_format($this_month-$last_month,2) }}
						</small>
						@endif
					</h3>
				</div>
				<div class="col-6">
					<p class="text-muted mb-1">Last Month</p>
					<h3 class="mt-0 font-20 text-truncate">
						₦{{ number_format($last_month,2) }}
					</h3>
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
			<h4 class="header-title mb-1">Payment History</h4>
			{!! $chart->container() !!}
		</div>
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
						<h3 class="text-dark my-1"><span data-plugin="counterup">{{ $beneficiaries->count() }}</span></h3>
						<p class="text-muted mb-1 text-truncate">Beneficiaries</p>
					</div>
				</div>
			</div>
			<div class="mt-3">
				<h6 class="text-uppercase">Target <span class="float-right">
					{{ $beneficiaries->count() > 0 ? ($beneficiaries->count()/100000)*100 : 0 }}%</span>
				</h6>
				<div class="progress progress-sm m-0">
					<div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $beneficiaries->count() > 0 ? ($beneficiaries->count()/100000)*100 : 0 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $beneficiaries->count() > 0 ? ($beneficiaries->count()/100000)*100 : 0 }}%">
						<span class="sr-only">{{ $beneficiaries->count() > 0 ? ($beneficiaries->count()/100000)*100 : 0 }}% Complete</span>
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
						<h3 class="text-dark my-1"><span data-plugin="counterup">{{ $users }}</span></h3>
						<p class="text-muted mb-1 text-truncate">Volunteers</p>
					</div>
				</div>
			</div>
			<div class="mt-3">
				<h6 class="text-uppercase">Target <span class="float-right">
					{{ $users > 0 ? ($users/100000)*100 : 0 }}%</span>
				</h6>
				<div class="progress progress-sm m-0">
					<div class="progress-bar bg-purple" role="progressbar" aria-valuenow="{{ $users > 0 ? ($users/100000)*100 : 0 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $users > 0 ? ($users/100000)*100 : 0 }}%">
						<span class="sr-only">{{ $users > 0 ? ($users/100000)*100 : 0 }}% Complete</span>
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
				<h4 class="header-title mb-0">Registration Overview</h4>
				<div id="cardCollpase1" class="collapse pt-3 show">
					{!! $chart2->container() !!}
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
				<h4 class="header-title mb-0">Thrifts Overview</h4>
				<div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
					{!! $chart3->container() !!}
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
						<a href="javascript: void(0);" class="text-white font-weight-semibold text-uppercase">
							<!--Read More--> <i class="mdi mdi-arrow-right"></i>
						</a>
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

<div class="row">
	<div class="col-xl-12">
		<div class="card-box">
			<h4 class="header-title mb-3">Recently Paid Thrifts</h4>
			<div class="table-responsive">
				<table class="table table-centered table-borderless table-hover table-nowrap mb-0" id="datatable">
					<thead class="thead-light">
						<tr>
							<th class="border-top-0">S/N</th>
							<th class="border-top-0">Name</th>
							<th class="border-top-0">Amount</th>
							<th class="border-top-0">Status</th>
							<th class="border-top-0">Date</th>
							<th class="border-top-0">Action</th> 
						</tr>
					</thead>
					<tbody>
						@foreach($entities as $entity)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ ucwords($entity->beneficiary->name) }}</td>
							<td>₦{{ number_format($entity->amount,2) }}</td>
							<td>{!! $entity->status() !!}</td>
							<td>{{ $entity->created_at->format('d M, Y h:i A') }}</td>
							<td>
								<div class="dropdown">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('beneficiaries.show', $entity->beneficiary->id) }}" class="dropdown-item">View</a>
                                    </div>
                                </div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection