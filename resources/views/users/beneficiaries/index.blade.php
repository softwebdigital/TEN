@extends('layouts.user')

@section('title', __('My Beneficiaries'))

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
					<li class="breadcrumb-item active">Beneficiaries</li>
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
				<h4 class="header-title">My Beneficiaries</h4>
				<a href="{{ route('beneficiaries.create') }}" class="btn btn-primary mb-4 mt-2">Add new beneficiary</a>
				<table id="basic-datatable" class="table table-striped dt-responsive nowrap">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Stage</th>
							<th>Thrift</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($entities as $entity)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ ucwords($entity->name) }}</td>
							<td>{{ strtolower($entity->email) }}</td>
							<td>{{ $entity->phone }}</td>
							<td>{{ $entity->address }}</td>
							<td>Stage {{ $entity->data()->level }}</td>
							<td>₦{{ number_format($entity->thrifts()->where('status', 'approved')->sum('amount'),2) }}</td>
							<td>{{ $entity->created_at->format('d M, Y h:i A') }}</td>
							<td>
								<div class="dropdown">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('beneficiaries.show', $entity->id) }}" class="dropdown-item">View</a>
                                        @if($entity->payments()->count() > 0)
                                        <a href="/thrifts/add/{{ $entity->id }}" class="dropdown-item">Add Thrift Payment</a>
                                        @endif
                                        <a href="#" class="dropdown-item miActionSubmit" data-desc="Are you sure you want to remove {{ ucwords($entity->name) }} from beneficiaries?">Delete</a>
                                        <form action="{{ route('beneficiaries.destroy', $entity->id) }}" class="miFormAction" method="post">
                                        	@csrf
                                        	@method('DELETE')
                                        </form>
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