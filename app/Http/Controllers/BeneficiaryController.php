<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Group;
use App\Transaction;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Globals as Utils;
use App\Traits\FileUploadManager;
use App\Traits\AppResponse;
use App\Traits\GlobalMethods;

class BeneficiaryController extends Controller
{
    use FileUploadManager, AppResponse, GlobalMethods;

    public function __construct()
    {
        $this->middleware('can:view pending payments', ['only' => ['pendingPayments']]);
        $this->middleware('can:create pending payments', ['only' => ['payNow']]);
        $this->middleware('role_or_permission:user|view beneficiaries', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:user|edit beneficiaries', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:user|delete beneficiaries', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:user|create beneficiaries', ['only' => ['create', 'store']]);
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
            $data['entities'] = Beneficiary::latest()->get();
            return view('admins.beneficiaries.index', $data);
        }else {
            $data['entities'] = Beneficiary::whereHas('group', function($q) use($user){
                $q->where('user_id', $user->id);
            })->get();
            if(request()->wantsJson()){
                return $this->success("Entries Retrieved Successfull", $data);
            }else {
                return view('users.beneficiaries.index', $data);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $data['banks'] = Utils::getBank();
        $data['countries'] = json_decode(file_get_contents("https://api.printful.com/countries"));
        return view('users.beneficiaries.create', $data);
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
        $bank = $this->paystackGet("https://api.paystack.co/bank/resolve?account_number=".request()->account_number."&bank_code=".request()->bank);
        if($bank->status){
            $banks = $this->paystackGet('https://api.paystack.co/bank')->data;
            $id = $this->search_banks(request()->bank, $banks);

            $data = $request->only(['name', 'email', 'phone', 'address']);
            $data['details'] = $request->except(['_token', '_method', 'passport', 'identification', 'name', 'email', 'phone', 'address', 'account_number', 'account_name']);
            $data['details']['passport'] = $this->uploadSingle($request->passport, 'Passports');
            $data['details']['identification'] = $this->uploadSingle($request->identification, 'Identification');
            $data['details']['level'] = '1';
            $data['details']['level_payment_status'] = 'pending';
            $data['details']['level_thrift_status'] = 'pending';
            $data['details']['bank'] = $banks[$id]->name;
            $data['details']['account_number'] = request()->account_number;
            $data['details']['account_name'] = $bank->data->account_name;
            $group = $user->groups()->has('beneficiaries', '<', 10)->orDoesntHave('beneficiaries')->first();
            if(!$group) {
                $count = $user->groups()->count()+1;
                $group = $user->groups()->save(new Group(['name'=>"Group {$count}", 'description'=>'Please add description']));
            }
            $group->beneficiaries()->save(new Beneficiary($data));
            if(request()->wantsJson()) return $this->success("Data saved successfully");
            return redirect('beneficiaries')->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully added a new beneficiary.</div></div>')->withInput();
            
        }else {
            return redirect()->back()->with('error_bottom', "<script>$(function(){ Swal.fire({ position: 'top-end', icon: 'error',title: '".$bank->message."',showConfirmButton: false,timer: 3000});});</script>")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if($user->is_admin){
            $data['entity'] = Beneficiary::find($id);
            return view('admins.beneficiaries.show', $data);
        }else {
            $data['entity'] = Beneficiary::find($id);
            return view('users.beneficiaries.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiary $beneficiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $beneficiary = Beneficiary::find($id);
        $data = $request->only(['name', 'address']);
        $beneficiary->update($data);
        return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>You have successfully updated a beneficiary.</div></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::find($id);
        if($beneficiary->payments()->count() > 0){
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fe-alert-triangle mr-2"></i>Beneficiary cannot be deleted!</div>');
        }else {
            $beneficiary->delete();
            if(request()->wantsJson()) return $this->success("Beneficiary Deleted!");
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Beneficiary deleted!</div></div>');
        }
    }

    public function pendingPayments()
    {
        $user = Auth::user();
        $data['entities'] = Beneficiary::where(
            [
                ['details->level', '!=', 'completed'],
                ['details->level_payment_status', '=', 'pending'],
                ['details->level_thrift_status', '=', 'pending'],
            ]
        )->latest()->get();
        return view('admins.beneficiaries.pending_payments', $data);
    }

    public function payNow($id)
    {
        $entity = Beneficiary::find($id);
        $volunteer = $entity->group->user;
        if($entity->data()->level_payment_status == 'pending'){
            $payments = [
                'amount'=>$entity->pendingPay(),
            ];
            $entity->payments()->save(new Payment($payments));
            $entity->update(['details->level_payment_status'=>'paid']);
            return redirect()->back()->with('message', '<div class="alert alert-success alert-dismissible show fade alert-has-icon"><div class="alert-icon"><i class="far fa-lightbulb"></i></div><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>Beneficiary paid!</div></div>');
        }else {
            return redirect()->back()->with('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fe-alert-triangle mr-2"></i>Beneficiary already paid for this stage!</div>');
        }
    }

    public function confirmBank(){
        $bank = $this->paystackGet("https://api.paystack.co/bank/resolve?account_number=".request()->account_number."&bank_code=".request()->bank);
        if($bank->status){
            return $this->success($bank->message, $bank->data);
        }
        return $this->error($bank->message);
    }
}
