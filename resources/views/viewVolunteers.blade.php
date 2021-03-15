@php
use App\Http\Controllers\Globals as utils;
@endphp

@extends('layouts.app')

@section('title') View Volunteer @endsection

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Volunteers</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Volunteers</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="https://www.theempowermentnetwork.ng/{{ $beneficiary->passport }}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">
                                    <h4 class="mb-0">{{ ucwords($beneficiary->name) }}</h4>
                                    <p class="text-muted">{{ strtolower($beneficiary->email) }}</p>
                                    @if($beneficiary->registration_status == 'completed' && $beneficiary->status == null || $beneficiary->status != 'approved')
                                    <a href="/volunteer/approve/{{ $beneficiary->id }}" onclick="return confirm('Are you sure you want to activate this account?');" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Activate</a>
                                    
                                    @endif
                                    <a href="/volunteer/delete/{{ $beneficiary->id }}" onclick="return confirm('Are you sure you want to delete this account history completely from database?')" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Delete</a>
                                
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong> <span class="ml-2">{{ $beneficiary->phone }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>BVN :</strong> <span class="ml-2 ">{{ $beneficiary->bvn }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2 ">{{ ucfirst($beneficiary->address) }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Bank :</strong> <span class="ml-2 ">{{ $beneficiary->bank }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Account Number :</strong> <span class="ml-2 ">{{ $beneficiary->bank_number }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ml-2 ">{{ $beneficiary->gender }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Employment Status :</strong> <span class="ml-2 ">{{ $beneficiary->occupation }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Date of birth :</strong> <span class="ml-2 ">{{ $beneficiary->date_of_bith }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Nationality :</strong> <span class="ml-2 ">{{ $beneficiary->nationality}}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>State of origin :</strong> <span class="ml-2 ">{{ $beneficiary->state_of_origin}}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>State of residence :</strong> <span class="ml-2 ">{{$beneficiary->state_of_residence}}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Local government Area :</strong> <span class="ml-2 ">{{ ucwords($beneficiary->local_governmnet) }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Dependents :</strong> <span class="ml-2 ">{{ $beneficiary->number_of_kids}}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Marital Status :</strong> <span class="ml-2 ">{{ $beneficiary->marital_status }}</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Date joined :</strong> <span class="ml-2 ">{{ date('F d, Y', strtotime($beneficiary->created_at)) }}</span></p>
                                    
                                        <p class="text-muted mb-2 font-13"><strong>Identity card :</strong><span class="ml-2"><img src="https://www.theempowermentnetwork.ng/{{$beneficiary->identification}}" width="160px" height="160px"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-->
                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg">
                                        <li class="nav-item">
                                            <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <i class="mdi mdi-timeline mr-1"></i>User Overview
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline mr-1"></i>Edit User
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="timeline">
                                            <!-- comment box -->
                                            <form action="{{ route('process_message') }}" method="post" class="comment-area-box mt-2 mb-3">
                                            @csrf
                                            	<input type="hidden" name="role" value="System administrator">
                                            	<input type="hidden" name="user" value="{{ $beneficiary->email }}">
                                                <span class="input-icon">
                                                <textarea rows="3" name="message" class="form-control" placeholder="Write something..."></textarea>
                                                </span>
                                                <div class="comment-area-btn">
                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-sm btn-dark waves-effect waves-light">Send</button>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="btn btn-sm btn-light text-white-50"><i class="far fa-user"></i></a>
                                                        <a href="#" class="btn btn-sm btn-light text-white-50"><i class="fa fa-map-marker-alt"></i></a>
                                                        <a href="#" class="btn btn-sm btn-light text-white-50"><i class="fa fa-camera"></i></a>
                                                        <a href="#" class="btn btn-sm btn-light text-white-50"><i class="far fa-smile"></i></a>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- end comment box -->
                                            <div class="row">
			                            <div class="col-12">
			                                <div class="card-box">
			                                    <h4 class="header-title">Sortable Table</h4>
			                                    <p class="sub-header">
			                                        Default appearance (with optional sortable-switch)
			                                    </p>
			                                    <table class="tablesaw table mb-0" data-tablesaw-sortable data-tablesaw-sortable-switch>
			                                        <thead>
			                                            <tr>
			                                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Group Name</th>
			                                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Description</th>
			                                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Members</th>
			                                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Date Last added</th>
			                                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Created at</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        @foreach($groups as $group)
			                                            <tr>
			                                                <td>{{ "Group ".$group->group_name }}</td>
			                                                <td>{{ ucfirst($group->description) }}</td>
			                                                <td>{{ utils::getGroupCount($group->id) }}</td>
			                                                <td>{{ utils::getLastDateAdded($group->id) }}<td>
			                                                <td>{{ date('M d, Y', strtotime($group->created_at)) }}</td>
			                                            </tr>
			                                        @endforeach
			                                        </tbody>
			                                    </table>
			                                </div>
			                                <!-- end card-box-->
			                            </div>
			                            <!-- end col-->
			                        </div>
                                        </div>
                                        <!-- end timeline content-->
                                        <div class="tab-pane" id="settings">
                                            <form action="{{ route('update_user') }}" method="post">
                                                @csrf
                                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $beneficiary->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $beneficiary->email }}" readonly>
                                                            <span class="form-text text-muted"><small>You can't change user's email address</small></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $beneficiary->phone }}">
                                                            <span class="form-text text-muted"><small>you can't change user's phone number</small></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" class="form-control" name="address" value="{{ $beneficiary->address }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Financial Info</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Bank Name</label>
                                                            <input type="text" class="form-control" name="bank" value="{{ $beneficiary->bank }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Account Number</label>
                                                            <input type="text" class="form-control" name="bank_number" value="{{ $beneficiary->bank_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <<label>Bank Verification Number</label>
                                                            <input type="text" class="form-control" name="bvn" value="{{ $beneficiary->bvn }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Others</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Employment Status</label>
                                                            <input type="text" class="form-control" name="occupation" value="{{ $beneficiary->occupation }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date of Birth</label>
                                                            <input type="text" class="form-control" name="date_of_birth" value="{{ $beneficiary->date_of_birth }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <input type="text" class="form-control" name="gender" value="{{ $beneficiary->gender }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Nationality</label>
                                                            <input type="text" class="form-control" name="nationality" value="{{ $beneficiary->nationality }}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>State of Origin</label>
                                                            <input type="text" class="form-control" name="state_of_origin" value="{{ $beneficiary->state_of_origin }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>State of Residence</label>
                                                            <input type="text" class="form-control" name="state_of_residence" value="{{ $beneficiary->state_of_residence }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Local governmnet</label>
                                                            <input type="text" class="form-control" name="local_government" value="{{ $beneficiary->local_government }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="cwebsite">Number of kids</label>
                                                            <input type="text" class="form-control" name="number_of_kids" value="{{ $beneficiary->number_of_kids }}">
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