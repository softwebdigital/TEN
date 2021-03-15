<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beneficiary;
use App\Payment;
use App\Thrift;
use App\Group;
use Hash;
use App\Http\Controllers\Globals as Util;

class AdminController extends Controller
{

    public function __invoke()
    {
        $data['users'] = User::where('is_admin', false)->count();
        $data['beneficiaries'] = Beneficiary::get();
        $data['groups'] = Group::count();
        $data['entities'] = Thrift::limit(10)->latest()->get();
        $data['total_paid'] = Payment::sum('amount');
        return view('admins.home', $data);
    }
}
