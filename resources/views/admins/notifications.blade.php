@extends('layouts.admin')

@section('title', __('Add new administrator'))

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
					<li class="breadcrumb-item active">Add new</li>
				</ol>
			</div>
			<h4 class="page-title">Administrators</h4>
		</div>
	</div>
</div>
@endsection

@section('content')
<form action="{{ route('notify_user') }}" method="post">
	@csrf
	<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add new admin</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body p-4">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="field-1" class="control-label">Volunteer</label>
								<select name="user" class="form-control">
									@foreach($users as $user)
									<option value="{{ $user->id }}">{{ ucwords($user->name.'  -  '.$user->mobile) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="field-1" class="control-label">Subject</label>
								<input type="text" name="title" class="form-control" required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="field-1" class="control-label">Message</label>
								<textarea rows="3" name="body" class="form-control" placeholder="Write something..." required></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info waves-effect waves-light">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="row no-gutters">
	<div class="col-md-6 col-xl-4">
		<div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
			<div class="row">
				<div class="col-6">
					<div class="avatar-lg rounded-circle bg-soft-primary">
						<i class="fe-tag font-22 avatar-title text-primary"></i>
					</div>
				</div>
				<div class="col-6">
					<div class="text-right">
						<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $notifications->count() }}</span></h3>
						<p class="text-primary mb-1 text-truncate">Total Notifications</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
			<div class="row">
				<div class="col-6">
					<div class="avatar-lg rounded-circle bg-soft-warning">
						<i class="fe-clock font-22 avatar-title text-warning"></i>
					</div>
				</div>
				<div class="col-6">
					<div class="text-right">
						<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $unread->count() }}</span></h3>
						<p class="text-warning mb-1 text-truncate">Not Viewed</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
			<div class="row">
				<div class="col-6">
					<div class="avatar-lg rounded-circle bg-soft-success">
						<i class="fe-check-circle font-22 avatar-title text-success"></i>
					</div>
				</div>
				<div class="col-6">
					<div class="text-right">
						<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $read->count() }}</span></h3>
						<p class="text-success mb-1 text-truncate">Viewed Notifications</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card-box">
			<button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#con-close-modal">
			<i class="mdi mdi-plus-circle"></i> Send Notification
			</button>
			<h4 class="header-title mb-4">Manage Notifications</h4>
			<table id="basic-datatable" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
				<thead>
					<tr>
						<th>
							S/N
						</th>
						<th>Sent to</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Status</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($notifications as $notification)
						@php
						$user = \App\User::find($notification->notifiable_id);
						@endphp
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ ucwords($user->name) }}</td>
						<td>{!! json_decode($notification->data)->title !!}</td>
						<td>{!! json_decode($notification->data)->body !!}</td>
						<td>
							@if($notification->read_at != null)
							<span class="badge badge-success">Read</span>
							@else
							<span class="badge badge-warning">Unread</span>
							@endif
						</td>
						<td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d M, Y h:i A') }}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection