@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends('layouts.app')

@section('title') Notifications @endsection

@section('head')
        <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumbs')
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">TEN</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Control</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Notifications</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Notifications</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
<form action="{{ route('process_message') }}" method="post">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Volunteer</label>
                                <select name="user" class="form-control">
                                    @foreach($volunteers as $volunteer)
                                    <option value="{{ $volunteer->email }}">{{ ucwords($volunteer->name)." - ".$volunteer->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Message</label>
                            <input type="hidden" name="role" value="System administrator">
                            <span class="input-icon">
                            <textarea rows="3" name="message" class="form-control" placeholder="Write something..."></textarea>
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
							<div class="col-md-6 col-xl-3">
								<div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
									<div class="row">
										<div class="col-6">
											<div class="avatar-lg rounded-circle bg-soft-primary">
												<i class="fe-tag font-22 avatar-title text-primary"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="text-right">
												<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($notifications) }}</span></h3>
												<p class="text-primary mb-1 text-truncate">Total Notifications</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xl-3">
								<div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
									<div class="row">
										<div class="col-6">
											<div class="avatar-lg rounded-circle bg-soft-warning">
												<i class="fe-clock font-22 avatar-title text-warning"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="text-right">
												<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $not_viewed }}</span></h3>
												<p class="text-warning mb-1 text-truncate">Not Viewed</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xl-3">
								<div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
									<div class="row">
										<div class="col-6">
											<div class="avatar-lg rounded-circle bg-soft-success">
												<i class="fe-check-circle font-22 avatar-title text-success"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="text-right">
												<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($notifications) - $not_viewed }}</span></h3>
												<p class="text-success mb-1 text-truncate">Viewed Notifications</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xl-3">
								<div class="widget-rounded-circle bg-soft-danger rounded-0 card-box mb-0">
									<div class="row">
										<div class="col-6">
											<div class="avatar-lg rounded-circle bg-soft-danger">
												<i class="fe-trash-2 font-22 avatar-title text-danger"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="text-right">
												<h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $deleted }}</span></h3>
												<p class="text-danger mb-1 text-truncate">Deleted Notificationa</p>
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
									@php
									$i = 1;
									@endphp
									<table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
										<thead>
											<tr>
												<th>
													SN
												</th>
												<th>Sent to</th>
												<th>Sent by</th>
												<th>Message</th>
												<th>icon</th>
												<th>Status</th>
												<th>Created Date</th>
												<th class="hidden-sm">Action</th>
											</tr>
										</thead>
										<tbody>
										    @foreach($notifications as $notif)
											<tr>
												<td><b>#{{ $i++ }}</b></td>
												@php
												$volunt = Util::getUserByEmail($notif->user);
												@endphp
												<td>
													<a href="/volunteers/view/{{ $volunt->id }}" target="_blank" class="text-body">
													<img src="https://theempowermentnetwork.ng/{{ $volunt->passport }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
													<span class="ml-2">{{ ucwords($volunt->name) }}</span>
													</a>
												</td>
												<td>
													@if($notif->sent_by != '' || $notif->sent_by != null)
													{{ ucwords($notif->sent_by) }}
													@else 
													System Administrator
													@endif
												</td>
												<td>{{ ucfirst($notif->message) }}</td>
												<td>
													<a href="javascript: void(0);">
													<img src="{{ $notif->icon }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
													</a>
												</td>
												<td>
												    @if($notif->status == 'not viewed')
													<span class="badge badge-light-secondary">Not viewed</span>
													@elseif($notif->status == 'viewed')
													<span class="badge badge-light-success">Viewed</span>
													@elseif($notif->status == 'deleted')
													<span class="badge badge-light-danger">Deleted</span>
													@endif
												</td>
												<td>
													{{ date('M d, Y', strtotime($notif->created_at)) }} at {{ date('h:i A', strtotime($notif->created_at)) }}
												</td>
												<td>
													<div class="btn-group dropdown">
														<a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
														    @if($notif->status == 'deleted')
														    <a class="dropdown-item" href="/notifications/undo_delete/{{ $notif->id }}"><i class="mdi mdi-alpha-j-circle mr-2 text-muted font-18 vertical-middle"></i>Undo delete</a>
														    @elseif($notif->status == 'viewed')
															<a class="dropdown-item" href="/notifications/delete/{{ $notif->id }}"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
															<a class="dropdown-item" href="/notifications/mark_unread/{{ $notif->id }}"><i class="mdi mdi-star mr-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a>
															@elseif($notif->status == 'not viewed')
															<a class="dropdown-item" href="/notifications/mark_read/{{ $notif->id }}"><i class="mdi mdi-star mr-2 font-18 text-muted vertical-middle"></i>Mark as Read</a>
															<a class="dropdown-item" href="/notifications/delete/{{ $notif->id }}"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
															@endif
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
@endsection


@section('foot')
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
        <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>
@endsection 