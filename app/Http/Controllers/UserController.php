<?php

namespace App\Http\Controllers;

use App\User;
use App\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Globals as Utils;
use App\Traits\FileUploadManager;
use App\Traits\AppResponse;
use Notification;
use App\Notifications\BeneficiaryNotification;

class UserController extends Controller
{
    use FileUploadManager;
    use AppResponse;

    public function __construct()
    {
        $this->middleware('role_or_permission:user|view volunteers', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:user|edit volunteers', ['only' => ['edit', 'update', 'approveVolunteer']]);
        $this->middleware('role_or_permission:user|delete volunteers', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:user|create volunteers', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['entities'] = User::where('is_admin', false)->where('details', '!=', null)->latest()->get();
        return view('admins.users.index', $data);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['entity'] = User::findOrFail($id);
        $data['banks'] = Utils::getBank();
        $data['countries'] = json_decode(file_get_contents("https://api.printful.com/countries"));
        return view('admins.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=0)
    {
        $user = Auth::user();
        if($user->is_admin){
            $person = User::find($id);
            $data['details'] = $request->except(['_token', '_method', 'passport', 'identification', 'name', 'email', 'phone', 'address']);
            $data['details']['passport'] = $this->uploadSingle($request->passport, 'Passports');
            $data['details']['identification'] = $this->uploadSingle($request->identification, 'Identification');
            $data['details']['status'] = 'pending';
            $person->update($data);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully updated a user.</div></div>');
        }else {
            $data['details'] = $request->except(['_token', '_method', 'passport', 'identification', 'name', 'email', 'phone', 'address']);
            $data['details']['passport'] = $this->uploadSingle($request->passport, 'Passports');
            $data['details']['identification'] = $this->uploadSingle($request->identification, 'Identification');
            $data['details']['status'] = 'pending';
            $user->update($data);
            if(request()->wantsJson()) return $this->success("Entry saved");
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have completed your registration process.</div></div>');
        }
        
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
        if($user->groups->count() > 0){
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fe-alert-triangle mr-2"></i>Volunteer cannot be deleted.</div>');
        }else {
            $user->delete();
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Volunteer deleted successfully.</div></div>');
        }
    }

    public function profile()
    {
        $user = Auth::user();
        if(request()->wantsJson()){
            $data = [
                'user'=>$user,
                'groups'=>$user->groups,
                'notifications'=>$user->notifications
            ];
            return $this->success("Entries retrieved", $data);
        }else {
            $data['user'] = $user;
            if($user->details == null){
                $data['banks'] = Utils::getBank();
                $data['countries'] = json_decode(file_get_contents("https://api.printful.com/countries"));
            }
            return view('users.profile', $data);
        }
    } 

    public function approveVolunteer($id){
        $update = User::find($id)->update([
            'details->status'=>'approved',    
        ]);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="mdi mdi-check-all mr-2"></i>User has been activated successfully</div>');
    }

    public function login()
    {
        if(Auth::attempt(['email' => request()->email, 'password' => request()->password])){ 
            $user = Auth::user(); 
            if($user->is_admin){
                Auth::logout();
                return $this->error('You cannot access the mobile application with a staff account!');
            }else {
                if($user->is_active){
                    $token = $user->createToken(Auth::user()->name.'-'.time());
                    $data['token'] =  $token->plainTextToken;
                    $data['user'] = $user;
                    return $this->success('Account authentication successful', $data);
                }else {
                    Auth::logout();
                    return $this->error('Your account has been restricted. Please contact support for assistance.');
                }
            }
        } else {
            return $this->error('Email address or password not found on our server!');
        }
    }

    public function notify(Request $request)
    {
        $user = User::find($request->user);
        Notification::send($user, new BeneficiaryNotification($request->body, $request->title, explode(' ', $user->name)[0], '<div class="notify-icon bg-success"><i class="mdi mdi-message-alert"></i></div>'));
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="mdi mdi-check-all mr-2"></i>User Notified!</div>');
    }
}
