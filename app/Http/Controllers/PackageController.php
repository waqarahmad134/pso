<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function packages()
    {
        if(session()->get('token'))
        {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL').'/package/all');
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return view('packages',['data'=>$data->Response]);
        }
        else {
            {
                return redirect()->route('login');
            }
        }
    }

    public function delete_package($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://192.168.10.36:3001/package/delete/".$id;
        $request = $client->delete($url);
        session()->flash('warning','Package Deleted Successfully!');
        return redirect()->back();
    }
    
    public function add_banner(Request $request)
    {
        $image_path = $request->image->getPathname();
        $image_mime =  $request->image->getmimeType();
        $image_org  =  $request->image->getClientOriginalName();
        $url = env('BASE_URL')."appsettings/addbanner";
        $client = new \GuzzleHttp\Client();
        $response = $client->post(url($url), [

            'multipart' => [
                [
                'name'     => 'value',
                    'filename' => $image_org,
                    'Mime-Type'=> $image_mime,
                    'contents' => fopen( $image_path, 'r' ),
                ],
        ]]);
        
        $response=$response->getBody()->getContents();
        $data= json_decode($response);
        return $data;
    }
}
