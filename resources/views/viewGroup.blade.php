@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends('layouts.app')

@section('title') View Group @endsection

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Group</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">View Group</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Group</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <h4 class="mb-0">Group {{ ucwords($group->group_name) }}</h4>
                                    <p class="text-muted"><a href="/volunteers/view/{{$owner->id}}" target="_blank"><i class="fa fa-link ml-2"></i>{{ ucwords($owner->name) }}</a></p>
                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13"><strong>Date Created :</strong> <span class="ml-2">{{ date('M d, Y', strtotime($group->created_at)) }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Time Created :</strong> <span class="ml-2">{{ date('h:i A', strtotime($group->created_at)) }}</span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Total beneficiaries :</strong> <span class="ml-2">{{ count($beneficiaries) }}</span>
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
                                            <i class="mdi mdi-settings-outline mr-1"></i>All beneficiaries
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="settings">
                                            <div class="row">
                                                <div class="col-12">s
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="header-title">Beneficiaries' Data Table</h4>
                                                            
                                                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SN</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Phone</th>
                                                                        <th>Volunteer</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $i = 1;
                                                                    @endphp
                                                                    @foreach($beneficiaries as $beneficiary)
                                                                    <tr>
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{ $beneficiary->name }}</td>
                                                                        <td>{{ $beneficiary->email }}</td>
                                                                        <td>{{ $beneficiary->phone }}</td>
                                                                        <td>
                                                                            @php
                                                                            $volunteer = Util::getUserByEmail($beneficiary->volunteer);
                                                                            @endphp
                                                                            {{ $volunteer->name }}
                                                                        </td>
                                                                        <td><a href="/beneficiaries/view/{{ $beneficiary->id }}" class="btn btn-success"><i class="fa fa-eye"></i></a><a onclick="return confirm('Are you sure you want to delete this beneficiary');" href="/beneficiaries/delete/{{ $beneficiary->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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