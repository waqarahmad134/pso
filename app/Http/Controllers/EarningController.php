<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'booking/earnings');
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        $dashboard_booking_info = $this->dashboard_booking_info();
        return view('earnings/admin_earnings',['data'=>$data->Response,])->with('dashboard_booking_info' , $dashboard_booking_info->Response);
    }
    
    
    public function dashboard_booking_info()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'booking/details/earnings');
        $response = $request->getBody()->getContents();
        $dashboard_booking_info= json_decode($response);
        return $dashboard_booking_info;
    }
    
    
    public function earning_filter(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        session()->put('from',$request->from);
        session()->put('to',$request->to);
        $client = new \GuzzleHttp\Client();
        $data = array(
            'from'  =>$request->from ,
            'to'    =>$request->to
        );
        
        $url = env('BASE_URL')."booking/filtered/earnings";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
         $response = $response->getBody()->getContents();
        $data= json_decode($response);
        $dashboard_booking_info = $this->dashboard_booking_info();
        return view('earnings/filter',['data'=>$data->Response,])->with('dashboard_booking_info' , $dashboard_booking_info->Response);
    }
    
}
