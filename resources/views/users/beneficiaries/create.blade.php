@extends('layouts.user')

@section('title', __('Add new Beneficiaries'))

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
					<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="/beneficiaries">Beneficiaries</a></li>
					<li class="breadcrumb-item active">Add new</li>
				</ol>
			</div>
			<h4 class="page-title">Beneficiaries</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title">New Beneficiary</h4>
				<form action="{{ route('beneficiaries.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" required="" value="{{ old('name') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" name="address" required="" value="{{ old('address') }}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" class="form-control" name="email" required value="{{ old('email') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" class="form-control" name="phone" required value="{{ old('phone') }}">
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
									<option value="{{ $bank->code }}">{{ $bank->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Number</label>
								<input type="number" class="form-control" name="account_number" required value="{{ old('account_number') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>BVN</label>
								<input type="number" class="form-control" name="bvn" required value="{{ old('bvn') }}">
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
								<input type="date" class="form-control" name="date_of_birth" required value="{{ old('date_of_birth') }}">
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
								<input type="text" class="form-control" name="occupation" required value="{{ old('occupation') }}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Nationality</label>
								<select class="form-control" name="nationality" required>
									@foreach($countries->result as $country)
									<option {{ $country->name == 'Nigeria' ? 'selected':'' }}>{{ $country->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>State of Origin</label>
								<input type="text" class="form-control" name="state_of_origin" required value="{{ old('state_of_origin') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>State of Residence</label>
								<input type="text" class="form-control" name="state_of_residence" required value="{{ old('state_of_residence') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Local Government</label>
								<input type="text" class="form-control" name="local_government" required value="{{ old('local_government') }}">
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
					<div class="text-right">
						<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection