@extends('layouts.user')

@section('title', __('Edit group'))

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
					<li class="breadcrumb-item"><a href="/admin/groups">Groups</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div>
			<h4 class="page-title">Groups</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title">Edit Group</h4>
				<form action="{{ route('admin.groups.update', $entity->id) }}" method="post">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" required="" value="{{ $entity->name }}">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" name="description" required>{{ $entity->description }}</textarea>
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