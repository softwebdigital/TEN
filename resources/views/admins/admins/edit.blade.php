@extends('layouts.admin')

@section('title', __('Edit administrator'))

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
					<li class="breadcrumb-item"><a href="/admin/administrators">Administrators</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div>
			<h4 class="page-title">Administrators</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin.administrators.update', $entity->id) }}" method="post">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="form-group col-12">
					        <label for="fullname">Full Name</label>
					        <input class="form-control" name="name" type="text" id="fullname" placeholder="Enter your name" required value="{{ $entity->name }}">
					        @error('name')
					        <div class="text-danger">{{ $message }}</div>
					        @enderror
					    </div>
					    <div class="form-group col-12">
					        <label for="emailaddress">Email address</label>
					        <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="Enter your email" value="{{ $entity->email }}" readonly="">
					        @error('email')
					        <div class="text-danger">{{ $message }}</div>
					        @enderror
					    </div>
					    <div class="form-group col-12">
					        <label for="phone">Phone Number</label>
					        <input class="form-control" type="number" name="phone" id="phone" required placeholder="Enter your phone number" value="{{ $entity->phone }}" readonly="">
					        @error('phone')
					        <div class="text-danger">{{ $message }}</div>
					        @enderror
					    </div>
					    <div class="form-group col-12">
					        <label>Role</label>
					        <select class="form-control" name="role">
					        	@foreach($roles as $role)
					        	<option {{ $entity->hasRole($role->name) ? 'selected':'' }}>{{ ucwords($role->name) }}</option>
					        	@endforeach
					        </select>
					    </div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
					</div>
				</form>
			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->
	</div>
	<!-- end col -->
</div>
<!-- end row -->
@endsection