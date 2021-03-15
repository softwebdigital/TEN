@extends('layouts.user')

@section('title', __('My Profile'))

@section('bread')
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
					<li class="breadcrumb-item active">Profile</li>
				</ol>
			</div>
			<h4 class="page-title">Profile</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-4 col-xl-4">
		<div class="card-box text-center">
			<img src="{{ $user->passport() }}" class="rounded-circle avatar-lg img-thumbnail"
				alt="profile-image">
			<h4 class="mb-0">{{ ucwords($user->name) }}</h4>
			<p class="text-muted">{{ $user->details != null ? strtolower($user->data()->occupation) : 'Volunteer' }}</p>
			<div class="text-left mt-3">
				<p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $user->phone }}</span>
				</p>
				<p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $user->email }}</span></p>
				<p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{ $user->address }}</span></p>
				@if($user->details != null)
					<p class="text-muted mb-1 font-13"><strong>Gender :</strong> <span class="ml-2">{{ $user->data()->gender }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Nationality :</strong> <span class="ml-2">{{ $user->data()->nationality }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Origin :</strong> <span class="ml-2">{{ $user->data()->state_of_origin }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>State of Residence :</strong> <span class="ml-2">{{ $user->data()->state_of_residence }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Local Government Area :</strong> <span class="ml-2">{{$user->data()->local_government }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Employment Status :</strong> <span class="ml-2">{{ $user->address }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Occupation :</strong> <span class="ml-2">{{ $user->data()->occupation }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Marital Status :</strong> <span class="ml-2">{{ $user->data()->marital_status }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Dependants :</strong> <span class="ml-2">{{ $user->data()->dependants }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Status :</strong> <span class="ml-2">{!! $user->status() !!}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Bank :</strong> <span class="ml-2">{{ $user->data()->bank }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Name :</strong> <span class="ml-2">{{ $user->data()->account_name }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Account Number :</strong> <span class="ml-2">{{ $user->data()->account_number }}</span></p>
					<p class="text-muted mb-1 font-13"><strong>Identification :</strong> <span class="ml-2"><img src="{{ asset($user->data()->identification) }}" width="90"></span></p>
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
					<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
						@csrf
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name" value="{{ $user->name }}" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" name="address" value="{{ $user->address }}" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone Number</label>
									<input type="text" class="form-control" name="phone" value="{{ $user->phone }}" readonly>
								</div>
							</div>
						</div>
						@if($user->details)
						@else
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Account Info</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Bank</label>
									<select class="form-control" name="bank">
										@foreach($banks->data as $bank)
										<option>{{ $bank->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Account Number</label>
									<input type="text" class="form-control" name="account_number" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Account Name</label>
									<input type="text" class="form-control" name="account_name" required>
								</div>
							</div>
						</div>
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Other Personal Info</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Identification</label>
									<input type="file" class="form-control" name="identification" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Passport</label>
									<input type="file" class="form-control" name="passport" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Date of Birth</label>
									<input type="date" class="form-control" name="date_of_birth" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Employment Status</label>
									<select class="form-control" name="employment_status" required>
										<option>Student</option>
										<option>Unemployed</option>
										<option>Private sector</option>
										<option>Public sector</option>
										<option>self-employed</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Occupation</label>
									<input type="text" class="form-control" name="occupation" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Nationality</label>
									<select class="form-control" name="nationality" required>
										@foreach($countries->result as $country)
										<option>{{ $country->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>State of Origin</label>
									<input type="text" class="form-control" name="state_of_origin" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>State of Residence</label>
									<input type="text" class="form-control" name="state_of_residence" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Local Government</label>
									<input type="text" class="form-control" name="local_government" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Number of Dependants</label>
									<select class="form-control" name="dependants" required>
										@for($i = 0; $i<10;$i++)
										<option>{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Marital status</label>
									<select class="form-control" name="marital_status" required>
										<option>Single</option>
										<option>Married</option>
										<option>Widowed</option>
										<option>Engaged</option>
										<option>Divorced</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Gender</label>
									<select class="form-control" name="gender" required>
										<option>Male</option>
										<option>Female</option>
										<option>Others</option>
									</select>
								</div>
							</div>
						</div>
						@endif
						<div class="text-right">
							<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection