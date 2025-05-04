<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Cookie;
class RolesController extends Controller
{
    public function index(Request $request)
    {
        $url = env('BASE_URL')."/users/all/roles";
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ]);
        $response= $response->getBody()->getContents();
        $data=json_decode($response);
        
        $roles = $data->Response;
        return view('all_roles')->with('roles',$roles);
    }
    
    
    public function all_roles(Request $request)
    {
       
        if(isset($request->name)){$data['name'] = $request->name;}
        if(isset($request->DashBoard)){$data['DashBoard'] = '1';}else{$data['DashBoard'] = '0';}
        if(isset($request->Users)){$data['Users'] = '1';}else{$data['Users'] = '0';}
        if(isset($request->Admin)){$data['Admin'] = '1';}else{$data['Admin'] = '0';}
        if(isset($request->Employees)){$data['Employees'] = '1';}else{$data['Employees'] = '0';}
        if(isset($request->Drivers)){$data['Drivers'] = '1';}else{$data['Drivers'] = '0';}
        if(isset($request->Coupons)){$data['Coupons'] = '1';}else{$data['Coupons'] = '0';}
        if(isset($request->Charges)){$data['Charges'] = '1';}else{$data['Charges'] = '0';}
        if(isset($request->Bookings)){$data['Bookings'] = '1';}else{$data['Bookings'] = '0';}
        if(isset($request->Mails)){$data['Mails'] = '1';}else{$data['Mails'] = '0';}
        if(isset($request->Categories)){$data['Categories'] = '1';}else{$data['Categories'] = '0';}
        if(isset($request->Banners)){$data['Banners'] = '1';}else{$data['Banners'] = '0';}
        if(isset($request->RestrictedItems)){$data['RestrictedItems'] = '1';}else{$data['RestrictedItems'] = '0';}
        if(isset($request->Vehicles)){$data['Vehicles'] = '1';}else{$data['Vehicles'] = '0';}
        if(isset($request->RequestHistory)){$data['RequestHistory'] = '1';}else{$data['RequestHistory'] = '0';}
        if(isset($request->PendingRequests)){$data['PendingRequests'] = '1';}else{$data['PendingRequests'] = '0';}
        if(isset($request->PaymentHistory)){$data['PaymentHistory'] = '1';}else{$data['PaymentHistory'] = '0';}
        if(isset($request->Earnings)){$data['Earnings'] = '1';}else{$data['Earnings'] = '0';}
        if(isset($request->FrontEndSettings)){$data['FrontEndSettings'] = '1';}else{$data['FrontEndSettings'] = '0';}

       
        $url = env('BASE_URL')."/users/add/role";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response= $response->getBody()->getContents();
        $data=json_decode($response);
        if($data->ResponseCode==0)
        {
            return redirect()->back()->with('warning', $data->ResponseMessage );
        }
        else
        {
            return redirect()->back()->with('info', $data->ResponseMessage );
        }
    }
    
    
    public function block_role($id)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'status'=>false
         );
        $url = env('BASE_URL')."/users/update/role/".$id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
         ]);
        session()->flash('error','Blocked Successfully!');
        return redirect()->back();
    }
    
    public function active_role($id)
    {
        $client = new \GuzzleHttp\Client();
        $data = array(
            'status'=>true
        );
        $url = env('BASE_URL')."/users/update/role/".$id;
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        session()->flash('warning',' Activated Successfully!');
        return redirect()->back();
    }
    
    public function update_permissions(Request $request)
    {
        // if(isset($request->name)){$data['name'] = $request->name;}
        if(isset($request->DashBoard)){$data['DashBoard'] = '1';}else{$data['DashBoard'] = '0';}
        if(isset($request->Users)){$data['Users'] = '1';}else{$data['Users'] = '0';}
        if(isset($request->Admin)){$data['Admin'] = '1';}else{$data['Admin'] = '0';}
        if(isset($request->Employees)){$data['Employees'] = '1';}else{$data['Employees'] = '0';}
        if(isset($request->Drivers)){$data['Drivers'] = '1';}else{$data['Drivers'] = '0';}
        if(isset($request->Coupons)){$data['Coupons'] = '1';}else{$data['Coupons'] = '0';}
        if(isset($request->Charges)){$data['Charges'] = '1';}else{$data['Charges'] = '0';}
        if(isset($request->Bookings)){$data['Bookings'] = '1';}else{$data['Bookings'] = '0';}
        if(isset($request->Mails)){$data['Mails'] = '1';}else{$data['Mails'] = '0';}
        if(isset($request->Categories)){$data['Categories'] = '1';}else{$data['Categories'] = '0';}
        if(isset($request->Banners)){$data['Banners'] = '1';}else{$data['Banners'] = '0';}
        if(isset($request->RestrictedItems)){$data['RestrictedItems'] = '1';}else{$data['RestrictedItems'] = '0';}
        if(isset($request->Vehicles)){$data['Vehicles'] = '1';}else{$data['Vehicles'] = '0';}
        if(isset($request->RequestHistory)){$data['RequestHistory'] = '1';}else{$data['RequestHistory'] = '0';}
        if(isset($request->PendingRequests)){$data['PendingRequests'] = '1';}else{$data['PendingRequests'] = '0';}
        if(isset($request->PaymentHistory)){$data['PaymentHistory'] = '1';}else{$data['PaymentHistory'] = '0';}
        if(isset($request->Earnings)){$data['Earnings'] = '1';}else{$data['Earnings'] = '0';}
        if(isset($request->FrontEndSettings)){$data['FrontEndSettings'] = '1';}else{$data['FrontEndSettings'] = '0';}

        $url = env('BASE_URL')."/users/update/permissions/".$request->id;
        
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        
        $response= $response->getBody()->getContents();
        
        $data=json_decode($response);
        $permissions = $data->Response;
     
        return redirect()->back()->with('permissions',$permissions);
    }
    
    public function role_detail(Request $request , $id)
    {
        $url = env('BASE_URL')."/users/permissions/".$id;
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ]);
        $response= $response->getBody()->getContents();
        $data=json_decode($response);
        $role_details = $data->Response;
        return $role_details;
    }
    
    
    public function role_assign(Request $request)
    {
        $url = env('BASE_URL')."users/assign/role";
        $data = [
            'UserId' => $request->UserId,
            'RoleId' => $request->RoleId
            ];
        
        $client = new \GuzzleHttp\Client();
         $response = $client->PUT($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response= $response->getBody()->getContents();
        $data=json_decode($response);
        return $data;
    }
        
}
