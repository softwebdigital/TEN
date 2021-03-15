@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends('layouts.app')

@section('title') Roles @endsection

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
                                            <li class="breadcrumb-item active">Roles</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Roles</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add Roles</button><br><br>
                        <!-- /.modal -->
                        	<form action="{{ route('add_roles') }}" method="post">
                        	@csrf
                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add new roles</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Name</label>
                                                                <input type="text" class="form-control" name="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-2" class="control-label">Volunteers</label>
                                                                <select class="form-control" name="volunteers">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Beneficiaries</label>
                                                                <select class="form-control" name="beneficiaries">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-4" class="control-label">Administrator</label>
                                                                <select class="form-control" name="administrator">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-5" class="control-label">Roles</label>
                                                                <select class="form-control" name="roles">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-6" class="control-label">Groups</label>
                                                                <select class="form-control" name="groups">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-7" class="control-label">Notifications</label>
                                                                <select class="form-control" name="notifications">
                                                                    <option value="4">View only</option>
                                                                    <option value="6">View & Edit </option>
                                                                    <option value="5">View & delete</option>
                                                                    <option value="7">View, edit & delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-8" class="control-label">Support</label>
                                                                <select class="form-control" name="support">
                                                                    <option value="4">View only</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /.modal -->
                        </div>
                                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Admins' Data Table</h4>
                                        
                                        <table id="basic-datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Name</th>
                                                    <th>Volunteers</th>
                                                    <th>Beneficiaries</th>
                                                    <th>Admin</th>
                                                    <th>Roles</th>
                                                    <th>Groups</th>
                                                    <th>Notifications</th>
                                                    <th>Support</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($roles as $role)
                                                @php
                                                $roled = explode(",", $role->role_attributes);
                                                @endphp
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ ucwords($role->role_name) }}</td>
                                                    <td>{{ Util::convertRoles($roled[0]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[1]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[2]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[3]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[4]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[5]) }}</td>
                                                    <td>{{ Util::convertRoles($roled[6]) }}</td>
                                                    <td><a href="/roles/delete/{{ $role->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this role from database?');"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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