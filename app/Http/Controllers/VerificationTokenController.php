<?php

namespace App\Http\Controllers;

use App\VerificationToken;
use Illuminate\Http\Request;
use Auth;
use App\Traits\AppResponse;

class VerificationTokenController extends Controller
{
    use AppResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = Auth::user();
        $data = request()->only('type');
        $data['token'] = \random_int(100000, 999999);
        $user->verification_tokens()->save(new VerificationToken($data));
        if(request()->wantsJson()) return $this->success("Token created");
        return redirect()->back()->with('resent', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationToken $verificationToken)
    {
        //
    }

    public function verify_page()
    {
        return view('auth.verify');
    }

    public function verify()
    {
        $user = Auth::user();
        $request = request()->only('token');
        $myT = $user->verification_tokens()->where($request)->first();;
        if($myT == null) {
            return redirect()->back()->with('message', '<div class="alert alert-danger">Invalid or Expired token!');
        }else {
            $user->update(['phone_verified_at'=>now()]);
            $myT->delete();
            return redirect('/home');
        }
        
    }

    public function verifyApi()
    {
        $user = Auth::user();
        $request = request()->only('token');
        $myT = $user->verification_tokens()->where($request)->first();;
        if($myT == null) {
            return $this->error("Token expired");
        }else {
            $myT->delete();
            return $this->success("Token validated");
        }
        
    }
}
