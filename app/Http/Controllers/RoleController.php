<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view roles', ['only' => ['index', 'show']]);
        $this->middleware('can:edit roles', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete roles', ['only' => ['destroy']]);
        $this->middleware('can:create roles', ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['entities'] = Role::where('name', '!=', 'user')->latest()->get();
        return view('admins.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permissions'] = Permission::all();
        return view('admins.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name');
        $permissions = $request->permissions;
        $role = Role::create($data);
        $role->syncPermissions($permissions);
        return redirect('/admin/roles')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully added a role.</div></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['permissions'] = Permission::all();
        $data['entity'] = Role::find($id);
        return view('admins.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $request->only('name');
        $permissions = $request->permissions;
        $role->update($data);
        $role->syncPermissions($permissions);
        return redirect('/admin/roles')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully updated a role.</div></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role->users->count() > 0){
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fe-alert-triangle mr-2"></i>Role has active users.</div>');
        }else {
            $role->users()->detach();
            $role->delete();
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Role deleted successfully.</div></div>');
        }
    }
}
