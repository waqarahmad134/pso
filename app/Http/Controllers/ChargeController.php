<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function update_amount(Request $request)
    {
        $data = array(
            'id' => (int)$request->cid,
            'amount' => (int)$request->amount,
           
         );
        
        $url = env('BASE_URL')."/charges/update";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
         ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
        return $data->Response;
    }
    
    public function update_value(Request $request)
    {
        $data = array(
            'id' => (int)$request->cid,
            'value' => (int)$request->value,
         );
        $url = env('BASE_URL')."/charges/update_value";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
        return $data->Response;
    }
    
    
    public function charges()
    {
        if(session()->get('token'))
        {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(env('BASE_URL').'/charges/get');
            $response = $request->getBody()->getContents();
            $data= json_decode($response);
            return view('chargesmanagement/charges',['data'=>$data->Response]);
        }
        else
        {
            return redirect()->route('login');
        }
    
    }

    public function update_charge(Request $request)
    {
        $data = array(
            'weight' => $request->weight,
            'dimension' => $request->dimension,
            'distance' => $request->distance,
           
         );
        //  return $data;
        $url = env('BASE_URL')."/charges/update_charge";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $requests = $client->get(env('BASE_URL').'/charges/get');
        $response = $requests->getBody()->getContents();
        $data= json_decode($response);
        return $data->Response;
    }

}
