<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    
    public function coupons_detail($id)
    {
         $client = new \GuzzleHttp\Client();
            $request = $client->get(env('BASE_URL').'/coupons/getby/'.$id);
            $response = $request->getBody()->getContents();
            $data= json_decode($response);
              
            return $data;
    }
    
    public function update_coupon(Request $request)
    {
        $data = array(
            'id' => $request->id,
            'discount' => $request->discount,
            'from' => $request->from,
            'to' => $request->to,
            'name' => $request->name,
            'status'=>true
        );
    
        $url = env('BASE_URL')."/coupons/update_coupon";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        
        $response=$response->getBody()->getContents();
        $data= json_decode($response);
        return $data;
    }
    
    
    
    
    public function delete(Request $request)
    {
        $data = array(
            'name' => $request->name,            
        );
        $url = env('BASE_URL')."coupons/delete";
        $client = new \GuzzleHttp\Client();
        $response = $client->delete($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        session()->flash('warning','Coupon Deleted Sucessfully!');
        return redirect()->route('add_coupon');
    }
    public function activate(Request $request)
    {
        $data = array(
            'name' => $request->name,

            'status'=>true
        );
        $url = env('BASE_URL')."/coupons/updatestatus";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        session()->flash('warning','Coupon Activated!');
        return redirect()->route('add_coupon');
    }

    public function deactivate(Request $request)
    {
        $data = array(
            'name' => $request->name,

            'status'=>false
        );
        $url = env('BASE_URL')."/coupons/updatestatus";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        session()->flash('error','Coupon Blocked!');
        return redirect()->route('add_coupon');
    }

    public function coupons()
    {
        if(session()->get('token'))
        {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(env('BASE_URL').'/coupons/getall');
            $response = $request->getBody()->getContents();
            $data= json_decode($response);
              
            return view('coupon/add_coupon',['data'=>$data]);
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function add_coupon(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'discount' => $request->discount,
            'from'=>$request->from,
            'to'=>$request->to,
            'status'=>true,
            'type'=>'Flat'
        );
        $url = env('BASE_URL')."/coupons/add";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response=$response->getBody()->getContents();
            $data= json_decode($response);
            return $data;
    }
}
