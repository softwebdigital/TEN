<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Beneficiary extends Model
{
    use Notifiable;
    
    protected $guarded = [];

    public function group()
    {
	    return $this->belongsTo(Group::class);
    }

    public function setDetailsAttribute($value)
    {
    	$this->attributes['details'] = json_encode($value);
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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function thrifts()
    {
        return $this->hasMany(Thrift::class);
    }

    public function status() : string
    {
        $status = $this->data()->status;
        switch ($status) {
            case 'pending':
                return '<span class="badge badge-warning">Pending</span>';
                break;

            case 'active':
                return '<span class="badge badge-success">Active</span>';
                break;
            
            default:
                break;
        }
    }

    public function pendingPay()
    {
        $amount = 0;
        if($this->data()->level == '1') $amount = 20000;
        elseif($this->data()->level == '2') $amount = 30000;
        elseif($this->data()->level == '3') $amount = 50000;
        return $amount;
    }
}
