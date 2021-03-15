<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AppResponse;
use App\Http\Controllers\Globals as Utils;

class Utility extends Controller
{
    use AppResponse;

    public function getBanks()
    {
    	$banks = Utils::getBank();
    	return $this->success("Banks retrieved", $banks);
    }

    public function getCountries()
    {
    	$countries = json_decode(file_get_contents("https://api.printful.com/countries"));
    	return $this->success("Countries retrieved", $countries);
    }
}
