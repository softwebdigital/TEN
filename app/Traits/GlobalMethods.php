<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait GlobalMethods
{
	public $secret_key = 'sk_live_3d51ace0f531e89cf5c5dc40497c2e0ac183d711';
  public $public_key = 'pk_live_4f9e0320cd7c1ad9ddc87e35e275ce3ac6b8d031';

  public function paystackGet($url){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
          "authorization: Bearer ".$this->secret_key,
          "content-type: application/json",
          "cache-control: no-cache",
        ],
      ));
      $response = curl_exec($curl);
      return json_decode($response);
  }

  public function paystackPost($url, $param){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($param),
		CURLOPT_HTTPHEADER => [
		    "authorization: Bearer ".$this->secret_key,
		    "content-type: application/json",
		    "cache-control: no-cache",
		  ],
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		$tranx = json_decode($response,true);
		return $tranx;
  }

  public function search_banks($search, $array) { 
      $ret = 0;
      foreach($array as $key => $arr) {
          if($arr->code == ucwords($search)){
              $ret += $key;
          }
      }
      return $ret;
  }

  public function randomId($table, $column = 'code'){
    $id = str_random(8);
    $validator = \Validator::make([$column=>$id],[$column=>'unique:'.$table]);
    if($validator->fails()){
        return $this->randomId();
    }
    return $id;
  }


}
