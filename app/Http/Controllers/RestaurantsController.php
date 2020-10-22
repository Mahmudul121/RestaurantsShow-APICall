<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    //
    public function index(){
    	$data=array("none");
    	$restaurant_name=array(" ");
		return view('restaurants', ['postcode'=> $data,'name'=>$restaurant_name]);
	}
	public function search(Request $req){
		$lat= $req->lattitude;
		$log= $req->longitude;

		if($lat!=""&&$log!="")
		{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.mapbox.com/geocoding/v5/mapbox.places/Restaurants.json?types=poi&proximity=".$lat.",".$log."&access_token=pk.eyJ1IjoibWFobXVkdWwxMjEiLCJhIjoiY2tnZ3J5ZTZqMDdpYjJ4bXk3MXp6eDJ6OCJ9.91yQAvmtgn9SycQy3yC-QQ",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		$response = json_decode($response, true);

		if(count($response)=="1")
		{
			$req->session()->flash('Error', $response['message']);
			return redirect()->route('home');
		}
		else{
			$count=count($response['features']);

			$data=array();
			$restaurant_name=array();

			for($i=0;$i<$count;$i++){
				$restaurant_name[$i]=$response['features'][$i]['text'];
				$value=$response['features'][$i]['context']['0']['id'];
				$postcode=substr($value,0,8);
				if($postcode=="postcode")
				{
					$data[$i]=$response['features'][$i]['context']['0']['text'];
				}
				else{
					$data[$i]=$response['features'][$i]['context']['1']['text'];
				}

			}
			return view('restaurants', ['postcode'=> $data,'name'=>$restaurant_name]);
			}
		}
		else{
			return redirect()->route('home');
		}

	}
}
