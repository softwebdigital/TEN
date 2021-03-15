<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function user()
    {
	    return $this->belongsTo(User::class);
    }

    public function beneficiaries()
    {
	    return $this->hasMany(Beneficiary::class);
    }
}
