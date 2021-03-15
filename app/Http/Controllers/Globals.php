<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\AdminNotification;
use Creativeorange\Gravatar\Facades\Gravatar;
use App\Role;
use App\User;
use App\Group;
use App\Beneficiary;

class Globals extends Controller
{
    public static function paystackGet($url){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => [
            "authorization: Bearer sk_live_05670408f356db831a10c3e7f102c2fb1dcc2870",
            "content-type: application/json",
            "cache-control: no-cache",
          ],
        ));
        $response = curl_exec($curl);
        return json_decode($response);
    }

    public static function getBank(){
        $bank = self::paystackGet("https://api.paystack.co/bank");
        return $bank;
    }

    public static function randomId($table, $column = 'code'){
      $id = str_random(8);
      $validator = \Validator::make([$column=>$id],[$column=>'unique:'.$table]);
      if($validator->fails()){
          return $this->randomId();
      }
      return $id;
    }
}
