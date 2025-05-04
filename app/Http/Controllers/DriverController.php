<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function list_drivers()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'users/getall/Driver');
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return view('drivers_list',['data'=>$data]);
    }
    
    
    public function drivers_earning()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'payments/alldue');
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return view('driver/drivers_earning',['data'=>$data]);
    }    
    public function driver_pay_apnimarzika(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'userId'  =>$request->userId, 
            'amount'  =>$request->amount 
        );   
        
        $url = env('BASE_URL')."payments/make";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
       
        if($data->ResponseCode == "0" ){
            return redirect()->route('drivers_earning')->with("error", $data->ResponseMessage );
        }
        else{
            return redirect()->route('drivers_earning')->with("warning" , $data->ResponseMessage);
        }
    }
    
    
    public function ratingss(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'driverId'  =>$request->id 
        );
        $url = env('BASE_URL')."/driver/rating/admin";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
       
        $response = $response->getBody()->getContents();
        $graphdata= json_decode($response);
        return $graphdata->Response;
    }
    
    public function driver_bank(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'userId'  =>$request->id 
        );
        $url = env('BASE_URL')."/payments/due/rider/admin";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
        
        
        $client1 = new \GuzzleHttp\Client();
        $url1 = env('BASE_URL')."/payments/payments/driver/".$request->id;
        $client1 = new \GuzzleHttp\Client();
        $response1 = $client1->get($url1, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ]);
        $response1 = $response1->getBody()->getContents();
        $data1= json_decode($response1);
        return [
            'data' =>  $data->Response,
            'data1' =>  $data1->Response
        ]; 
    }
    
    
    public function driver_rides(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL').'/booking/getallbydriver/'.$request->id;
        $response = $client->get($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
        return $data->Response;
        
        // $client = new \GuzzleHttp\Client();
        // $request = $client->get(env('BASE_URL').'/booking/getallbydriver/'.$request->id);
        // $response = $request->getBody()->getContents();
        // $data= json_decode($response);
        // return response()->json(['data'=>$data->Response,]);
    }
    
    public function que_drivers()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'/driver/waitapproval');
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return view('driver/que_drivers',['data'=>$data->Response]);
    }
    
    public function waiting_drivers_details($id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'/driver/review/'.$id);
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        $url = env('BASE_URL');
        return view('driver/que_drivers_details',['data'=>$data->Response, 'id' => $id,'url'=>$url]);
    }
    
    public function active_que_driver($id)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'userId'=>$id
        );
        $url = env('BASE_URL')."/driver/approve/";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('info',' Activated Successfully!');
        return redirect()->back();
    }

    public function driver_detail($id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'/driver/getby/'.$id);
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return response()->json(['data'=>$data,'status'=>true]);
    }

    // public function drivers_earning()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $request = $client->get(env('BASE_URL').'/driver/driverearnings/');
    //     $response = $request->getBody()->getContents();
    //     $data= json_decode($response);
    //     return view('driver.drivers_earning',['data'=>$data->Response]);
    // }
}
