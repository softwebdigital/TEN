@extends('layouts.user')

@section('title', __('My Dashboard'))

@push('more-styles')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('more-scripts')
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/libs/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard-2.init.js') }}"></script>
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
			<h4 class="header-title mt-0 mb-2">Registration progress</h4>
			<div class="mt-1">
				<div class="float-left" dir="ltr">
					<input data-plugin="knob" data-width="64" data-height="64" data-fgColor="#f05050 "
						data-bgColor="#48525e" value="{{ $user->progress() }}"
						data-skin="tron" data-angleOffset="180" data-readOnly=true
						data-thickness=".15"/>
				</div>
				<div class="text-right">
					<h2 class="mt-3 pt-1 mb-1"> {{ $user->progress() }}% </h2>
					<p class="text-muted mb-0">Since registration</p>
				</div>
				<div class="clearfix"></div>
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
		                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $user->groups()->count() }}</span></h3>
		                <p class="text-muted mb-1 text-truncate">Groups</p>
		            </div>
		        </div>
		    </div>
		    <div class="mt-3">
		    	@php
		    	$percent = ($user->groups()->count()/100)*100;
		    	@endphp
		        <h6 class="text-uppercase">Target <span class="float-right">100</span></h6>
		        <div class="progress progress-sm m-0">
		            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%">
		                <span class="sr-only">{{ $percent }}% Complete</span>
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
		    <div class="mt-3">
		    	@php
		    	$percent = ($beneficiaries->count()/1000)*100;
		    	@endphp
		        <h6 class="text-uppercase">Target <span class="float-right">1000</span></h6>
		        <div class="progress progress-sm m-0">
		            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%">
		                <span class="sr-only">{{ $percent }}% Complete</span>
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