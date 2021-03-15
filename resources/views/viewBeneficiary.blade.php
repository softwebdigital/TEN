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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Beneficaries</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Beneficiary</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                            <form action="{{ route('pay_user') }}" method="post">
                                @csrf
                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pay User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Amount</label>
                                                                <input type="text" class="form-control" name="amount" required>
                                                                <input type="hidden" value="{{ $beneficiary->email }}" name="user">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('paid_beneficiary') }}" method="post">
                                @csrf
                                    <div id="cond-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pay User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Amount</label>
                                                                <input type="text" class="form-control" name="amount" required>
                                                                <input type="hidden" value="{{ $beneficiary->email }}" name="user">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="owing">Owing</option>
                                                                    <option value="paid">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="https://www.theempowermentnetwork.ng/{{ $beneficiary->passport }}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">
                                    <h4 class="mb-0">{{ ucwords($beneficiary->name) }}</h4>
                                    <p class="text-muted">{{ strtolower($beneficiary->email) }}</p>
                                    @if($beneficiary->pay_status != 'owing')
                                    <a href="/beneficiary/disburse/{{ $beneficiary->id }}" data-toggle="modal" data-target="#con-close-modal" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Pay</a>
                                    @else
                                    <a href="/beneficiary/paid/{{ $beneficiary->id }}" data-toggle="modal" data-target="#cond-close-modal" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Paid</a>
                                    @endif
                                    <a href="/beneficiary/delete/{{ $beneficiary->id }}" onclick="return confirm('Are you sure you want to delete this account history completely from database?')" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Delete</a>
                                
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13"><strong>Level :</strong> <span class="ml-2">{{ $beneficiary->level }}</span>
                                        </p>
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
                                        <p class="text-muted mb-2 font-13"><strong>Group name :</strong><span class="ml-2">{{ "Group ".$group->group_name }}</span>
                                        </p>
                                        @php
                                        $volunteer = utils::getUserByEmail($beneficiary->volunteer);
                                        @endphp
                                        <p class="text-muted mb-2 font-13"><strong>Volunteer</strong><span class="ml-2"><a target="_blank" href="/volunteers/view/{{$volunteer->id }}"><i class="fa fa-link"></i>{{ ucwords($volunteer->name) }}</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-->
                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg">
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <i class="mdi mdi-settings-outline mr-1"></i>Edit User
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="settings">
                                            <form action="{{ route('update_beneficiary') }}" method="post">
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
                                                    <!-- end col -->
                                                </div>
                                                <!-- end row -->
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end settings content-->
                                    </div>
                                    <!-- end tab-content -->
                                </div>
                                <!-- end card-box-->
                            </div>
                            <!-- end col -->
                        </div>
@endsection


@section('foot')
    	<script src="{{ asset('assets/libs/tablesaw/tablesaw.js') }}"></script>

        <script src="{{ asset('assets/js/pages/tablesaw.init.js') }}"></script>
@endsection