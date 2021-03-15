<?php

namespace App\Http\Controllers;

use App\Thrift;
use App\Beneficiary;
use Illuminate\Http\Request;
use App\Http\Controllers\Globals as Utils;
use Illuminate\Support\Facades\Auth;
use App\Traits\AppResponse;

class ThriftController extends Controller
{

    use AppResponse;

    public function __construct()
    {
        $this->middleware('role_or_permission:user|view thrifts', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:user|edit thrifts', ['only' => ['edit', 'update', 'approve', 'decline']]);
        $this->middleware('role_or_permission:user|delete thrifts', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:user|create thrifts', ['only' => ['create', 'store']]);
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
            $data['entities'] = Thrift::latest()->get();
            return view('admins.thrifts.index', $data);
        }else {
            $data['entities'] = Thrift::whereHas('beneficiary', function($q) use($user){
                $q->whereHas('group', function($quer) use ($user){
                    $quer->where('user_id', $user->id);
                });
            })->get();
            if(request()->wantsJson()) return $this->success("Entries retrieved", $data);
            return view('users.thrifts.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('users.thrifts.create', ['id'=>$id]);
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
        $beneficiary = Beneficiary::find($request->beneficiary);
        $data = $request->only('amount');
        $beneficiary->thrifts()->save(new Thrift($data));
        if(request()->wantsJson()) return $this->success("Thrift added!");
        return redirect('/beneficiaries')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Thrift added!</div></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thrift  $thrift
     * @return \Illuminate\Http\Response
     */
    public function show(Thrift $thrift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thrift  $thrift
     * @return \Illuminate\Http\Response
     */
    public function edit(Thrift $thrift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thrift  $thrift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thrift $thrift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thrift  $thrift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thrift $thrift)
    {
        //
    }

    public function approve($id)
    {
        $entity = Thrift::find($id);
        $entity->update(['status'=>'approved']);
        return redirect('/admin/thrifts')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Thrift approved!</div></div>');
    }

    public function decline($id)
    {
        $entity = Thrift::find($id);
        $entity->update(['status'=>'declined']);
        return redirect('/admin/thrifts')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Thrift declined!</div></div>');
    }
}
