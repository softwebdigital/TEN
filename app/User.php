<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Twilio\Rest\Client;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    
    protected $guarded = [];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function verification_tokens()
    {
        return $this->hasMany(VerificationToken::class);
    }

    public function tokenize($type='both')
    {
        $code = \random_int(100000, 999999);
        $this->verification_tokens()->save(new VerificationToken(['token'=>$code, 'type'=>$type]));
    }

    public function smsNotify($message)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create('+234'.substr($this->phone,1), 
                ['from' => $twilio_number, 'body' => $message] );
    }

    public function data()
    {
        return json_decode($this->details);
    }

    public function passport()
    {
        if($this->data() != null){
            return asset('storage/'.$this->data()->passport);
        }else {
            return asset('avatar.png');
        }
    }

    public function nameSync(){
        $arr = explode(' ', $this->name);
        $add = $arr[0];
        $expr = '/(?<=\s|^)[a-z]/i';
        preg_match_all($expr, $arr[1], $matches);
        $add .= ' '.implode('', $matches[0]);
        return ucwords($add);
    }

    public function setDetailsAttribute($value){
        return $this->attributes['details'] = $value;
    }

    public function progress()
    {
        $progress = 25;
        if($this->details != null) $progress+= 70;
        if($this->details != null && $this->data()->status == 'approved') $progress += 5;
        return $progress;
    }

    public function status() : string
    {
        $status = $this->data()->status;
        switch ($status) {
            case 'pending':
                return '<span class="badge badge-warning">Pending</span>';
                break;

            case 'approved':
                return '<span class="badge badge-success">Approved</span>';
                break;
            
            default:
                break;
        }
    }

    public function active() : string
    {
        $status = $this->is_active;
        switch ($status) {
            case true:
                return '<span class="badge badge-success">Active</span>';
                break;

            case 'approved':
                return '<span class="badge badge-danger">Restricted</span>';
                break;
            
            default:
                break;
        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
