<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beneficiary;
use App\Group;
use App\Thrift;
use App\Payment;
use App\Http\Controllers\Globals as Util;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $user = \Auth::user();
        $data['user'] = $user;
        $data['beneficiaries'] = Beneficiary::whereHas('group', function($q) use($user){
            $q->where('user_id', $user->id);
        })->get();
        $data['entities'] = Thrift::whereHas('beneficiary', function($q) use($user){
            $q->whereHas('group', function($quer) use ($user){
                $quer->where('user_id', $user->id);
            });
        })->get();
        $data['total_paid'] = Payment::whereHas('beneficiary', function($q) use($user){
            $q->whereHas('group', function($q) use($user){
                $q->where('user_id', $user->id);
            });
        })->sum('amount');
        return view('users.index', $data);
    }
}
