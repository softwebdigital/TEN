<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Globals as Utils;
use App\Traits\FileUploadManager;
use App\Traits\AppResponse;

class GroupController extends Controller
{
    use FileUploadManager, AppResponse;

    public function __construct()
    {
        $this->middleware('role_or_permission:user|view groups', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:user|edit groups', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:user|delete groups', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:user|create groups', ['only' => ['create', 'store']]);
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
            $data['entities'] = Group::latest()->get();
            return view('admins.groups.index', $data);
        }else {
            $data['entities'] = $user->groups()->latest()->get();
            if(request()->wantsJson()) return $this->success("Entities retrieved", $data);
            return view('users.groups.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.groups.create');
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
        $groups = $user->groups()->has('beneficiaries', '<', 10)->orDoesntHave('beneficiaries')->count();
        if($groups > 0){
            if(request()->wantsJson()){
                return $this->error("You have some groups that are not full!");
            }else {
                return redirect('/groups')->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fe-alert-triangle mr-2"></i>You have some groups that are not full!</div>');
            }
        } 
        $data = $request->except(['_token']);
        $data['name'] = 'Group '.$user->groups()->count()+1;
        $user->groups()->save(new Group($data));
        if(request()->wantsJson()) return $this->success("You have successfully added a new group.");
        return redirect('/groups')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully added a new group.</div></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $data['entity'] = Group::find($id);
        if($user->is_admin){
            return view('admins.groups.show', $data);
        }else {
            return view('users.groups.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $data['entity'] = Group::find($id);
        if($user->is_admin){
            return view('admins.groups.edit', $data);
        }else {
            return view('users.groups.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $group = Group::find($id);
        $group->update($request->except(['_token', '_method']));
        if($user->is_admin) return redirect()->route('admin.groups.index')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully edited a group.</div></div>');
        else {
            if(request()->wantsJson()){
                return $this->success("You have successfully edited a group.");
            }else {
                return redirect()->route('groups.index')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully edited a group.</div></div>');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
