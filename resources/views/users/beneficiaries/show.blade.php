@extends('layouts.user')

@section('title', __('Viewing beneficiary'))

@section('bread')
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="/beneficiaries">Beneficiaries</a></li>
					<li class="breadcrumb-item active">View Beneficiaries</li>
				</ol>
			</div>
			<h4 class="page-title">View Beneficiaries</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div class="card-box text-center">
			<img src="{{ $entity->passport() }}" class="rounded-circle avatar-lg img-thumbnail"
				alt="profile-image">
			<h4 class="mb-0">{{ ucwords($entity->name) }}</h4>
			<p class="text-muted">{{ $entity->details != null ? strtolower($entity->data()->occupation) : 'Volunteer' }}</p>
			<div class="text-left mt-3">
				<p class="text-muted mb-2 font-13"><strong>Stage :</strong><span class="ml-2">Stage {{ $entity->data()->level }}</span>
				<p class="text-muted mb-2 font-13"><strong>Thrift :</strong><span class="ml-2">₦{{ number_format($entity->thrifts()->where('status', 'approved')->sum('amount'),2) }}</span>
				<p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $entity->phone }}</span>
				</p>
				<p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $entity->email }}</span></p>
				<p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{ $entity->address }}</span></p>
				@if($entity->details != null)
					<p class="text-muted mb-1 font-13"><strong>Gender :</strong> <span class="ml-2">{{ $entity->data()->gender }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Nationality :</strong> <span class="ml-2">{{ $entity->data()->nationality }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Origin :</strong> <span class="ml-2">{{ $entity->data()->state_of_origin }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Residence :</strong> <span class="ml-2">{{ $entity->data()->state_of_residence }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Local Government Area :</strong> <span class="ml-2">{{$entity->data()->local_government }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Employment Status :</strong> <span class="ml-2">{{ $entity->address }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Occupation :</strong> <span class="ml-2">{{ $entity->data()->occupation }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Marital Status :</strong> <span class="ml-2">{{ $entity->data()->marital_status }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Dependants :</strong> <span class="ml-2">{{ $entity->data()->dependants }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Bank :</strong> <span class="ml-2">{{ $entity->data()->bank }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Name :</strong> <span class="ml-2">{{ $entity->data()->account_name }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Number :</strong> <span class="ml-2">{{ $entity->data()->account_number }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>BVN :</strong> <span class="ml-2">{{ $entity->data()->bvn }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Identification :</strong> <span class="ml-2"><img src="{{ asset($entity->data()->identification) }}" width="90"></span></p>
				@endif
			</div>
		</div> 
	</div>
	<!-- end col-->
	<div class="col-lg-8 col-xl-8">
		<div class="card-box">
			<ul class="nav nav-pills navtab-bg">
				<li class="nav-item">
					<a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link active">
					<i class="mdi mdi-settings-outline mr-1"></i>Account Details
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane show active" id="settings">
					<form action="{{ route('beneficiaries.update', $entity->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name" value="{{ $entity->name }}" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" name="address" value="{{ $entity->address }}" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" class="form-control" name="email" value="{{ $entity->email }}" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone Number</label>
									<input type="text" class="form-control" name="phone" value="{{ $entity->phone }}" readonly>
								</div>
							</div>
						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="card mt-4">
			<div class="card-body">
				<h4 class="header-title">Payments</h4>
				<table id="basic-datatable" class="table table-striped dt-responsive nowrap">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Beneficiary</th>
							<th>Amount</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($entity->payments as $post)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ ucwords($post->beneficiary->name) }}</td>
							<td>₦{{ number_format($post->amount,2) }}</td>
							<td>{{ $post->created_at->format('d M, Y h:i A') }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="card mt-4">
			<div class="card-body">
				<h4 class="header-title">Thrifts</h4>
				<table id="basic-datatable" class="table table-striped dt-responsive nowrap">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($entity->thrifts as $entity)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ ucwords($entity->beneficiary->name) }}</td>
							<td>₦{{ number_format($entity->amount,2) }}</td>
							<td>{!! $entity->status() !!}</td>
							<td>{{ $entity->created_at->format('d M, Y h:i A') }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection