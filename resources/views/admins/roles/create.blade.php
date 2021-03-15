@extends('layouts.admin')

@section('title', __('Add new role'))

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
					<li class="breadcrumb-item"><a href="/admin/administrators">Roles</a></li>
					<li class="breadcrumb-item active">Add new</li>
				</ol>
			</div>
			<h4 class="page-title">Roles</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin.roles.store') }}" method="post">
					@csrf
					<div class="row">
						<div class="form-group col-12">
					        <label>Name</label>
					        <input class="form-control" name="name" type="text" required="">
					    </div>
					</div>
					<div class="form-group col-12">
						<label>Permissions</label>
						@foreach($permissions as $perm)
				        <div class="custom-control custom-checkbox checkbox-info">
				            <input type="checkbox" class="custom-control-input" id="checkbox-{{ $loop->iteration }}" name="permissions[]" value="{{ $perm->name }}">
				            <label class="custom-control-label" for="checkbox-{{ $loop->iteration }}">{{ ucwords($perm->name) }}</label>
				        </div>
				        @endforeach
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