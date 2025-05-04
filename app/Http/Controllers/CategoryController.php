<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function cat_activate($id)
    {
        $data = array
            (
                'status'=>true
            );
        $url = env('BASE_URL')."/category/updatestatus/".$id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('warning','Category Activated!');
        return redirect()->back();
    }
    
    public function cat_block($id)
    {
        $data = array(
            'status'=>false
        );
        $url = env('BASE_URL')."/category/updatestatus/".$id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('error','Category Blocked!');
        return redirect()->back();
    }
    
    
    
    public function categories()
    {
        if(session()->get('token'))
        {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(env('BASE_URL').'category/getallcat');
            $response = $request->getBody()->getContents();
            // return  json_decode($response);
            $data= json_decode($response);
            return view('categories',['data'=>$data->Response->categories]);
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function add_category(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'status'=>true
        );
        
        $image_path = $request['Image']->getPathname();
        $image_mime = $request['Image']->getmimeType();
        $image_org  = $request['Image']->getClientOriginalName();
        $url = env('BASE_URL')."/category/add";
        $client = new \GuzzleHttp\Client();
        $response = $client->post(url($url), [
          
            'multipart' => [
                [
                    'name'     => 'image',
                    'filename' => $image_org,
                    'Mime-Type'=> $image_mime,
                    'contents' => fopen( $image_path, 'r' ),
                ],
                [
                    'name'     => 'name',
                    'contents' => $request->name
                ],
                [
                    'name'     => 'status',
                    'contents' => true
                ],
                [
                    'name'     => 'adult_18plus',
                    'contents' => $request->adult_18plus
                ]
            ],
        ]);
        $response = $response->getBody()->getContents();
        $data= json_decode($response);
   
        if($data->ResponseCode == "0" ){
            return redirect()->route('categories')->with("error", $data->ResponseMessage );
        }
        else{
            return redirect()->route('categories')->with("warning" , $data->ResponseMessage);
        }
        
    }

    public function cat_delete($id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->delete(env('BASE_URL').'/category/cat_delete/'.$id);
        $response = $request->getBody()->getContents();
        $data= json_decode($response);
        return redirect()->back();
    }
}
