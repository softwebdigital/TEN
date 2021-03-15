@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends('layouts.app')

@section('title') Transactions @endsection

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
                                            <li class="breadcrumb-item active">Transactions</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Administrators</h4>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Transaction Data Table</h4>
                                        
                                        <table id="basic-datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Volunteer</th>
                                                    <th>Amount</th>
                                                    <th>Paid to</th>
                                                    <th>Paid by</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($transactions as $tran)
                                                @php
                                                $volunt = Util::getUserByEmail($tran->wallet);
                                                @endphp
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td><a href="/volunteers/view/{{ $volunt->id }}" target="_blank"><i class="fa fa-link mr-2"></i>{{ ucwords($volunt->name) }}</a></td>
                                                    <td>₦{{ number_format($tran->amount,2) }}</td>
                                                    <td>
                                                        @if($tran->type == 'debit')
                                                            TEN
                                                        @else 
                                                            @php
                                                            $ben = Util::getBenByEmail($tran->paid_by);
                                                            @endphp
                                                            <a href="/beneficiaries/view/{{ $ben->id }}" target="_blank"><i class="fa fa-link mr-2"></i> {{ ucwords($ben->name) }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($tran->type == 'credit')
                                                            @php
                                                            $ben = Util::getBenByEmail($tran->paid_by);
                                                            @endphp
                                                            <a href="/beneficiaries/view/{{ $ben->id }}" target="_blank"><i class="fa fa-link mr-2"></i> {{ ucwords($ben->name) }}</a>
                                                        @else
                                                            TEN    
                                                        @endif
                                                    </td>
                                                    <td>{{ ucfirst($tran->description) }}</td>
                                                    <td>{{ date('M d, Y', strtotime($tran->created_at)) }}</td>
                                                    <td>{{ date('h:i A', strtotime($tran->created_at)) }}</td>
                                                    <td></td>
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