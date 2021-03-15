<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view admins', ['only' => ['index', 'show']]);
        $this->middleware('can:edit admins', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete admins', ['only' => ['destroy']]);
        $this->middleware('can:create admins', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['entities'] = User::where('is_admin', true)->latest()->get();
        return view('admins.admins.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::where('name', '!=', 'user')->latest()->get();
        return view('admins.admins.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:11', 'min:11', 'unique:users'],
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $request->except(['_token', 'role']);
        $data['password'] = 'password2021@ten';
        $data['is_admin'] = true;
        $user = User::create($data);
        $roles[] = $request->role;
        $user->syncRoles($roles);
        return redirect('/admin/administrators')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully added a new admin.</div></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['entity'] = User::find($id);
        $data['roles'] = Role::where('name', '!=', 'user')->latest()->get();
        return view('admins.admins.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->except(['_token', 'role', 'email', 'phone']);
        $user->update($data);
        $roles[] = $request->role;
        $user->syncRoles($roles);
        return redirect('/admin/administrators')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully updated admin.</div></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/administrators')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully deleted an admin.</div></div>');
    }
}
