<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentHistory extends Controller
{
    public function payment_history(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/payments/history');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        if ($data->ResponseCode == 0) {
            $data->Response = [];
        }
        return view('pay/payment_history', ['data' => $data->Response]);
    }

    public function payment()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/payments/requesthistory');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('pay/payment', ['data' => $data->Response]);
    }

    public function pending_payment()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/payments/requestpending');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('pay/pending_payment', ['data' => $data->Response]);
    }

    public function pending_payment_accept($id, $amount, $userId)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/payments/make/pending/";
        $data = [
            "requestId" => "$id",
            "amount" => "$amount",
            "userId" => $userId
        ];
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('info', 'Pay Successfully!');
        return redirect()->back();
    }

    public function payment_methods(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . 'method/get_payment_methods');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('payment_methods', ['data' => $data->Response]);
    }
    public function update_payment_method(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/method/update_payment_method";
        $data = [
            "id" => $request->id,
            "title" => $request->update_title,
            "clientKey" => $request->update_clientKey,
            "secretKey" => $request->update_secretKey
        ];
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('info', 'Payment method updated Successfully!');
        return redirect()->back();
    }
    public function get_payment_method(Request $request)
    {
        $token = session()->get('token');       
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "users/get_payment_method";   
        $data = [
            "password" => $request->password,
            "paymentMethodId" => $request->paymentMethodId,
        ];
        
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json' , 'accessToken' => $token ],
            'body'    => json_encode($data)
        ]);
        return $response;
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        return $data->Response;
    }
    public function add_payment_method(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/method/add_payment_method";
        $data = [

            "title" => $request->update_title,
            "clientKey" => $request->update_clientKey,
            "secretKey" => $request->update_secretKey
        ];
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        if ($data->ResponseCode == 1) {
            session()->flash('info', 'Payment Method Added Successfully!');
            return redirect()->back();
        }
        if ($data->ResponseCode == 0) {
            session()->flash('info', $data->ResponseMessage);
            return redirect()->back();
        }
    }
    public function block_payment_method(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/method/block_payment_method";
        $data = [

            "id" => $id
        ];

        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('info', 'Payment method blocked Successfully!');
        return redirect()->back();
    }

    public function active_payment_method(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/method/active_payment_method";
        $data = [

            "id" => $id
        ];

        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('info', 'Payment method activated Successfully!');
        return redirect()->back();
    }
}
