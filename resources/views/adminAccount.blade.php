@php
use App\Http\Controllers\Globals as utils;
@endphp

@extends('layouts.app')

@section('title') View Beneficiary @endsection

@section('head')
        <link href="{{ asset('assets/libs/tablesaw/tablesaw.css') }}" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Account</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">My Account</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    @php
                                    $passport = utils::getPassport($myAccount);
                                    @endphp
                                    <img src="{{ $passport }}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">
                                    <h4 class="mb-0">{{ ucwords($myAccount->name) }}</h4>
                                    <p class="text-muted">{{ ucwords($role->role_name) }}</p>
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2">{{ $myAccount->email }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Date added :</strong> <span class="ml-2">{{ date('M d, Y', strtotime($myAccount->created_at)) }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Time added :</strong> <span class="ml-2">{{ date('h:i A', strtotime($myAccount->created_at)) }}</span>
                                        </p>
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Date last updated :</strong> <span class="ml-2">{{ date('M d, Y', strtotime($myAccount->updated_at)) }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Time last updated :</strong> <span class="ml-2">{{ date('h:i A', strtotime($myAccount->updated_at)) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg">
                                        <li class="nav-item">
                                            <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <i class="mdi mdi-timeline mr-1"></i>Access Overview
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline mr-1"></i>Edit Account
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="timeline">
                                            <div class="row">
			                            <div class="col-12">
			                                <div class="card-box">
			                                    <h4 class="header-title">My Access</h4>
			                                    @php
			                                    $arr = explode(",", $role->role_attributes);
			                                    @endphp
			                                    <table class="tablesaw table mb-0" data-tablesaw-mode="stack">
										<thead>
											<tr>
												<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">PAGES</th>
												<th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">ACCESS</th>
										</thead>
										<tbody>
											<tr>
												<td>Volunteers</td>
												<td>{{ utils::convertRole($arr[0]) }}</td>
											</tr>
											<tr>
												<td>Beneficiaries</td>
												<td>{{ utils::convertRole($arr[1]) }}</td>
											</tr>
											<tr>
												<td>Administrator</td>
												<td>{{ utils::convertRole($arr[2]) }}</td>
											</tr>
											<tr>
												<td>Roles</td>
												<td>{{ utils::convertRole($arr[3]) }}</td>
											</tr>
											<tr>
												<td>Groups</td>
												<td>{{ utils::convertRole($arr[4]) }}</td>
											</tr>
											<tr>
												<td>Notifications</td>
												<td>{{ utils::convertRole($arr[5]) }}</td>
											</tr>
											<tr>
												<td>Support</td>
												<td>{{ utils::convertRole($arr[6]) }}</td>
											</tr>
										</tbody>
									</table>
			                                </div>
			                            </div>
			                        </div>
                                        </div>
                                        <!-- end timeline content-->
                                        <div class="tab-pane" id="settings">
                                            <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Account Info</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $myAccount->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $myAccount->email }}" readonly>
                                                            <span class="form-text text-muted"><small>You can't change your email address</small></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="text" class="form-control" name="password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Passport</label>
                                                            <input type="file" class="form-control" name="passport">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection


@section('foot')
    	<script src="{{ asset('assets/libs/tablesaw/tablesaw.js') }}"></script>

        <script src="{{ asset('assets/js/pages/tablesaw.init.js') }}"></script>
@endsection