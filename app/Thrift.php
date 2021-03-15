<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thrift extends Model
{
    protected $guarded = [];

    public function beneficiary()
    {
	    return $this->belongsTo(Beneficiary::class);
    }

    public function status() : string
    {
        $status = $this->status;
        switch ($status) {
            case 'pending':
                return '<span class="badge badge-warning">Pending</span>';
                break;

            case 'approved':
                return '<span class="badge badge-success">Approved</span>';
                break;

            case 'declined':
                return '<span class="badge badge-danger">Declined</span>';
                break;
            
            default:
                break;
        }
    }
}
