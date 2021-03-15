@php
$entities = App\Thrift::whereHas('beneficiary', function($q) use($entity){
    $q->whereHas('group', function($quer) use ($entity){
        $quer->where('user_id', $entity->id);
    });
})->get();
@endphp

@extends('layouts.admin')

@section('title', __('Viewing Volunteer'))

@push('more-styles')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('more-scripts')
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endpush

@section('bread')
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="/beneficiaries">Volunteers</a></li>
					<li class="breadcrumb-item active">View Volunteer</li>
				</ol>
			</div>
			<h4 class="page-title">View Volunteer</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div class="card-box text-center">
			<img src="{{ $entity->passport() ?? '' }}" class="rounded-circle avatar-lg img-thumbnail"
				alt="profile-image">
			<h4 class="mb-0">{{ ucwords($entity->name) ?? '' }}</h4>
			<p class="text-muted">{{ $entity->details != null ? strtolower($entity->data()->occupation) : 'Volunteer' ?? '' }}</p>
			@if($entity->details != null && $entity->data()->status == 'pending')
            <a href="/admin/volunteer/approve/{{ $entity->id }}" data-desc="Are you sure you want to activate this account?" class="btn btn-success btn-xs waves-effect mb-2 waves-light miAction">Activate</a>
            @endif
            <a href="#" class="btn btn-danger btn-xs waves-effect mb-2 waves-light miActionSubmit" data-desc="Are you sure you want to remove {{ ucwords($entity->name) }} from volunteers?" data-form="miFormAction">Delete</a>
            <form action="{{ route('admin.volunteers.destroy', $entity->id) }}" class="miFormAction" method="post">
            	@csrf
            	@method('DELETE')
            </form>
			<div class="text-left mt-3">
				<p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $entity->phone ?? '' }}</span>
				</p>
				<p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $entity->email ?? '' }}</span></p>
				<p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{ $entity->address ?? '' }}</span></p>
				@if($entity->details != null)
					<p class="text-muted mb-1 font-13"><strong>Gender:</strong> <span class="ml-2">{{ $entity->data()->gender }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Nationality:</strong> <span class="ml-2">{{ $entity->data()->nationality }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Origin:</strong> <span class="ml-2">{{ $entity->data()->state_of_origin }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Residence:</strong> <span class="ml-2">{{ $entity->data()->state_of_residence }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Local Government Area:</strong> <span class="ml-2">{{$entity->data()->local_government }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Employment Status:</strong> <span class="ml-2">{{ $entity->data()->employment_status }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Occupation:</strong> <span class="ml-2">{{ $entity->data()->occupation }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Marital Status:</strong> <span class="ml-2">{{ $entity->data()->marital_status }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Dependants:</strong> <span class="ml-2">{{ $entity->data()->dependants }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Status:</strong> <span class="ml-2">{!! $entity->status() !!}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Bank:</strong> <span class="ml-2">{{ $entity->data()->bank }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Name:</strong> <span class="ml-2">{{ $entity->data()->account_name }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Number:</strong> <span class="ml-2">{{ $entity->data()->account_number }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Identification:</strong> <span class="ml-2"><img src="{{ asset($entity->data()->identification) }}" width="90"></span></p>
				@endif
			</div>
		</div> 
		<div class="card">
			<div class="card-body">
				<h4 class="header-title">Send Direct Notification</h4>
				<form action="{{ route('notify_user') }}" method="post">
					@csrf
					<input type="hidden" name="user" value="{{ $entity->id }}">
					<div class="form-group">
						<label>Subject</label>
						<input type="text" name="title" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control" name="body" required=""></textarea>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
					<form action="{{ route('admin.volunteers.update', $entity->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name" value="{{ $entity->name ?? '' }}" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" name="address" value="{{ $entity->address ?? '' }}" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" class="form-control" name="email" value="{{ $entity->email ?? '' }}" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone Number</label>
									<input type="text" class="form-control" name="phone" value="{{ $entity->phone ?? '' }}" readonly>
								</div>
							</div>
						</div>
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Account Info</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Bank</label>
									<select class="form-control" name="bank">
										@foreach($banks->data as $bank)
										<option {{ $entity->details != null && $entity->data()->bank == $bank->name ? 'selected' : '' }}>{{ $bank->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Account Number</label>
									<input type="text" class="form-control" name="account_number" required value="{{ $entity->data()->account_number ?? '' }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Account Name</label>
									<input type="text" class="form-control" name="account_name" required value="{{ $entity->data()->account_name ?? '' }}">
								</div>
							</div>
						</div>
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Other Personal Info</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Identification</label>
									<input type="file" class="form-control" name="identification" {{ $entity->details != null ? '':'required' }}>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Passport</label>
									<input type="file" class="form-control" name="passport" {{ $entity->details != null ? '':'required' }}>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Date of Birth</label>
									<input type="date" class="form-control" name="date_of_birth" required value="{{ $entity->data()->date_of_birth ?? '' }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Employment Status</label>
									<select class="form-control" name="employment_status" required>
										<option {{ $entity->details != null && $entity->data()->employment_status == 'Student' ? 'selected' : '' }}>Student</option>
										<option {{ $entity->details != null && $entity->data()->employment_status == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
										<option {{ $entity->details != null && $entity->data()->employment_status == 'Private sector' ? 'selected' : '' }}>Private sector</option>
										<option {{ $entity->details != null && $entity->data()->employment_status == 'Public sector' ? 'selected' : '' }}>Public sector</option>
										<option {{ $entity->details != null && $entity->data()->employment_status == 'Self-employed' ? 'selected' : '' }}>Self-employed</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Occupation</label>
									<input type="text" class="form-control" name="occupation" required value="{{ $entity->data()->occupation ?? '' }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Nationality</label>
									<select class="form-control" name="nationality" required>
										@foreach($countries->result as $country)
										<option {{ $entity->details != null && $entity->data()->nationality == $country->name ? 'selected' : '' }}>{{ $country->name ?? '' }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>State of Origin</label>
									<input type="text" class="form-control" name="state_of_origin" required value="{{ $entity->data()->state_of_origin ?? '' }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>State of Residence</label>
									<input type="text" class="form-control" name="state_of_residence" required value="{{ $entity->data()->state_of_residence ?? '' }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Local Government</label>
									<input type="text" class="form-control" name="local_government" required value="{{ $entity->data()->local_government ?? '' }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Number of Dependants</label>
									<select class="form-control" name="dependants" required>
										@for($i = 0; $i<10;$i++)
										<option {{ $entity->details != null && $entity->data()->dependants == $i ? 'selected' : '' }}>{{ $i ?? '' }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Marital status</label>
									<select class="form-control" name="marital_status" required>
										<option {{ $entity->details != null && $entity->data()->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
										<option {{ $entity->details != null && $entity->data()->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
										<option {{ $entity->details != null && $entity->data()->marital_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
										<option {{ $entity->details != null && $entity->data()->marital_status == 'Engaged' ? 'selected' : '' }}>Engaged</option>
										<option {{ $entity->details != null && $entity->data()->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Gender</label>
									<select class="form-control" name="gender" required>
										<option {{ $entity->details != null && $entity->data()->gender == 'Male' ? 'selected' : '' }}>Male</option>
										<option {{ $entity->details != null && $entity->data()->gender == 'Female' ? 'selected' : '' }}>Female</option>
										<option {{ $entity->details != null && $entity->data()->gender == 'Others' ? 'selected' : '' }}>Others</option>
									</select>
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
				<h4 class="header-title">Groups</h4>
				<table id="basic-datatable" class="table table-striped dt-responsive nowrap">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Description</th>
							<th>Beneficiaries</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($entity->groups as $entity)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ ucwords($entity->name) }}</td>
							<td>{{ $entity->description }}</td>
							<td>{{ $entity->beneficiaries()->count() }}</td>
							<td>{{ $entity->created_at->format('d M, Y h:i A') }}</td>
							<td>
								<div class="dropdown">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('admin.groups.show', $entity->id) }}" class="dropdown-item">View</a>
                                        <a href="{{ route('admin.groups.edit', $entity->id) }}" class="dropdown-item">Edit</a>
                                    </div>
                                </div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h4 class="header-title">Thrifts</h4>
				<table id="selection-datatable" class="table table-striped dt-responsive nowrap">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Date</th>
							<th>Action</th>
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