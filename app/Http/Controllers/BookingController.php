<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function booking_data($id)
    {

        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/booking/getall/' . $id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('booking/booking_data', ['data' => $data->Response, 'id' => $id]);
    }

    public function booking_details($id)
    {
        $data = array(
            'bookId' => $id,
        );
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . '/booking/getby';
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $data = json_decode($response->getBody()->getContents());
        return view('booking/booking_details', ['data' => $data->Response, 'id' => $id]);
    }

    public function all_bookings()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . 'booking/get/all');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('all_bookings', ['data' => $data->Response]);
    }

    // public function all_bookings()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $request = $client->get(env('BASE_URL').'/users/get/allusers');
    //     $response = $request->getBody()->getContents();
    //     $data=json_decode($response);
    //     return view('all_bookings',['data'=>$data]);
    // }


    // public function booking_detail($id)
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $request = $client->get(env('BASE_URL').'/booking/getby/'.$id);
    //     $response = $request->getBody()->getContents();
    //     $data= json_decode($response);
    //     return response()->json(['data'=>$data]);
    // }


    public function roles_post(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'status' => true
        );
        $url = env('BASE_URL') . "/role/add";

        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        session()->flash('warning', 'Role Added!');
        return redirect()->back();
    }


    public function role_activate($id)
    {
        $data = array(
            'status' => true
        );
        $url = env('BASE_URL') . "/role/updatestatus/" . $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('warning', 'Role Activated!');
        return redirect()->back();
    }


    public function role_block($id)
    {
        $data = array(
            'status' => false
        );
        $url = env('BASE_URL') . "/role/updatestatus/" . $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('error', 'Role Blocked!');
        return redirect()->back();
    }

    public function roles()
    {
        if (session()->get('token')) {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(env('BASE_URL') . '/role/getall');
            $response = $request->getBody()->getContents();
            $data = json_decode($response);
            return view('all_roles', ['data' => $data]);
        } else {
            return redirect()->route('login');
        }
    }


    public function cancel_bookings()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . 'booking/cancelled');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('cancel_bookings', ['data' => $data]);
    }

    public function deleterole($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/role/deleterole/" . $id;
        $request = $client->delete($url);
        session()->flash('error', 'Role Deleted!');
        return redirect()->route('roles');
    }
}
