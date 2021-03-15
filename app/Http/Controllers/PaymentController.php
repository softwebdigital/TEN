<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Globals as Utils;
use Illuminate\Support\Facades\Auth;
use App\Traits\AppResponse;

class PaymentController extends Controller
{
    use AppResponse;

    public function __construct()
    {
        $this->middleware('role_or_permission:user|view payments', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:user|edit payments', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:user|delete payments', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:user|create payments', ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->is_admin){
            $data['entities'] = Payment::latest()->get();
            return view('admins.payments.index', $data);
        }else {
            $data['entities'] = Payment::whereHas('beneficiary', function($q) use($user){
                $q->whereHas('group', function($quer) use ($user){
                    $quer->where('user_id', $user->id);
                });
            })->get();
            if(request()->wantsJson()) return $this->success("Entries retrieved", $data);
            return view('users.payments.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
