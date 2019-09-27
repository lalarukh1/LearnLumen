<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function showAll()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev-p7h-jh1x.auth0.com/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"client_id\":\"qNF6lho5rKt7f2rWKCXFwXP89JA6wQFc\",\"client_secret\":\"0cHXwxcEb0WUP-LCw8PBJ0HhmjjBwayr-MlTdQHtzJY5rp3cLxgMIHnPafxbM8Z8\",\"audience\":\"test\",\"grant_type\":\"client_credentials\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $token = curl_exec($curl);
        $err = curl_error($curl);

        $token = json_decode($token, true);
        $token = $token['access_token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8000/api/test",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $token
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
        return response()->json(Test::all());
    }

    public function showOne($id)
    {
        return response()->json(Test::find($id));
    }
}