<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function update_vec(Request $request)
    {
        
        if ($request->image) {
            $image_path = $request->images->getPathname();
            $image_mime =  $request->images->getmimeType();
            $image_org  =  $request->images->getClientOriginalName();
        }
        $id = (int)$request->id;
        $url = env('BASE_URL') . "/vehicle/update/" . $id;
        $client = new \GuzzleHttp\Client();
        if ($request->image) {
            $response = $client->post(url($url), [
                'multipart' => [
                    [
                        'name'     => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),
                    ],
                    [
                        'name'     => 'name',
                        'contents' => $request->names
                    ],
                    [
                        'name'     => 'baseRateVehicle',
                        'contents' => (int)$request->baserate
                    ],
                    [
                        'name'     => 'ratePerMile',
                        'contents' => $request->ratemile
                    ],
                    [
                        'name'     => 'volumeCapacity',
                        'contents' => $request->volcap
                    ],
                    [
                        'name'     => 'weightCapacity',
                        'contents' => $request->wcap
                    ],
                    [
                        'name'     => 'status',
                        'contents' => true
                    ],
                ]
            ]);
        }

        $response = $client->post(url($url), [
            'multipart' => [
                [
                    'name'     => 'name',
                    'contents' => $request->names
                ],
                [
                    'name'     => 'baseRateVehicle',
                    'contents' => (int)$request->baserate
                ],
                [
                    'name'     => 'ratePerMile',
                    'contents' => $request->ratemile
                ],
                [
                    'name'     => 'volumeCapacity',
                    'contents' => $request->volcap
                ],
                [
                    'name'     => 'weightCapacity',
                    'contents' => $request->wcap
                ],
                [
                    'name'     => 'status',
                    'contents' => true
                ],
            ]
        ]);

        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        return $data;
    }

    public function vec_detail($id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/vehicle/vec_detail/' . $id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return $data;
    }

    public function activate($id)
    {
        $data = array(
            'status' => true,
        );

        $url = env('BASE_URL') . "/vehicle/update/" . $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('warning', 'Activated Successfully!');
        return redirect()->back();
    }

    public function block($id)
    {

        $data = array(
            'status' => false,
        );

        $url = env('BASE_URL') . "/vehicle/update/" . $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('error', 'Blocked Successfully');
        return redirect()->back();
    }

    public function all_vec()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/vehicle/getall');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('vehicle.vehicleinfo', ['data' => $data->Response]);
    }

    public function add_vec(Request $request)
    {
        //  return $request->all();
        $image_path = $request->image->getPathname();
        $image_mime =  $request->image->getmimeType();
        $image_org  =  $request->image->getClientOriginalName();

        $url = env('BASE_URL') . "/vehicle/add";
        $client = new \GuzzleHttp\Client();
        $response = $client->post(url($url), [

            'multipart' => [
                [
                    'name'     => 'image',
                    'filename' => $image_org,
                    'Mime-Type' => $image_mime,
                    'contents' => fopen($image_path, 'r'),
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
                    'name'     => 'baseRateVehicle',
                    'contents' => $request->baserates
                ],
                [
                    'name'     => 'ratePerMile',
                    'contents' => $request->ratemiles
                ],
                [
                    'name'     => 'volumeCapacity',
                    'contents' => $request->volcaps
                ],
                [
                    'name'     => 'weightCapacity',
                    'contents' => $request->wcaps
                ],

            ]
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        return $data;

        return redirect()->back();
    }

    // public function vehicle_delete($id)
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $url = env('BASE_URL')."/vehicle/delete/".$id;
    //     $request = $client->delete($url);
    //     session()->flash('warning','Vechile Deleted Successfully!');
    //     return redirect()->back();
    // }
    public function vehicle_delete($id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->delete(env('BASE_URL') . '/vehicle/delete/' . $id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        session()->flash('warning', "Vehicle Deleted Sucessfully");
        return redirect()->back();
    }
}
