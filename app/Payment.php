<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function beneficiary()
    {
	    return $this->belongsTo(Beneficiary::class);
    }
}
