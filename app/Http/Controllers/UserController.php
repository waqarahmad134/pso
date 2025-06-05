<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Machine;
use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\MobilOil;
use App\Models\Dip;
use App\Models\ExpenseHistory;
use App\Models\Transaction;
use App\Models\ShiftData;
use App\Models\ShiftReading;
use App\Models\Expense;

use Cookie;

class UserController extends Controller
{
    public function delete_user($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/users/deladmin/" . $id;
        $request = $client->delete($url);
        session()->flash('error', 'User Deleted Successfully!');
        return redirect()->route('list_users');
    }

    public function list_users()
    {
        $data = User::where('usertype', 'customer')
                    ->orderBy('created_at', 'desc')
                    ->get(); 
        return view('admin.list_users', ['data' => $data]);
    }

    public function customers()
    {
        $data = User::where('usertype', 'customer')
                    ->orderBy('created_at', 'desc')
                    ->get(); 
        return view('admin.customers', ['data' => $data]);
    }

    public function staffs()
    {
        $data = User::where('usertype', 'staff')
                    ->orderBy('created_at', 'desc')
                    ->get(); 
        return view('admin.staffs', ['data' => $data]);
    }

    public function suppliers()
    {
        $data = User::where('usertype', 'supplier')
                    ->orderBy('created_at', 'desc')
                    ->get(); 
        return view('admin.suppliers', ['data' => $data]);
    }

    public function list_admin()
    {
        $data = User::where('usertype', 'admin')
                    ->orderBy('created_at', 'desc')
                    ->get(); 
        return view('admin.list_admin', ['data' => $data]);
    }

    public function update_status($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->back()->with('danger', 'User not found.');
        }
    
        // Toggle status
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
    
        $statusText = $user->status == 1 ? 'activated' : 'blocked';
    
        return redirect()->back()->with('success', "User has been {$statusText} successfully.");
    }


    public function add_user(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'leyka_donor_phone' => 'nullable|string|max:20',
                'password' => 'required|string|min:6',
                'usertype' => 'required|in:admin,staff,customer,supplier',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Validation failed. Please check the form fields.');
            }
    
            $user = new User();
            $user->name = $request->firstName . ' ' . $request->lastName;
            $user->username = strtolower($request->firstName . '.' . $request->lastName);
            $user->email = $request->email;
            $user->contact = $request->leyka_donor_phone;
            $user->usertype = $request->usertype;
            $user->password = Hash::make($request->password);
            $user->save();
    
            return redirect()->back()->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
    
    




    public function employees(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . '/users/all/employees');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);

        // $arr = array();

        $url1 = env('BASE_URL') . "/users/all/active/roles";
        $client1 = new \GuzzleHttp\Client();
        $response1 = $client1->get($url1, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ]);
        $response1 = $response1->getBody()->getContents();
        $data1 = json_decode($response1);
        $roles1 = $data1->Response;
        return view('admin.list_employee', ['data' => $data])->with('roles', $roles1);
    }

    public function add_employee(Request $request)
    {
        $phoneNum = '+' . $request->countrycode . ' ' . $request->leyka_donor_phone;
        $data = array(
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phoneNum' => $phoneNum,
            'password' => $request->password,
            'status' => true
        );
        $url = env('BASE_URL') . "/users/add/employee";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        if ($data->ResponseCode == 0) {
            return redirect()->route('employees')->with('error', $data->errors);
        } else {
            return redirect()->route('employees')->with('info', 'Employee Added Sucessfully');
        }
    }

 
    public function add_admin(Request $request)
    {

        $phoneNum = '+' . $request->countrycode . ' ' . $request->leyka_donor_phone;
        $data = array(
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phoneNum' => $phoneNum,
            'password' => $request->password,
            'status' => true
        );

        $url = env('BASE_URL') . "/users/add";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);

        if ($data->ResponseCode == 0) {
            return redirect()->route('list_admin')->with('error', $data->errors);
        } else {
            return redirect()->route('list_admin')->with('info', 'Admin Added Sucessfully');
        }
    }

    public function delete_admin($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = env('BASE_URL') . "/users/deladmin/" . $id;
        $request = $client->delete($url);
        session()->flash('error', 'Deleted Successfully!');
        return redirect()->back();
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('homess');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function change_password_post(Request $request)
    {
        $data = array(
            'oldPassword' => $request->old,
            'newPassword' => $request->neww,
        );
        $token = session()->get('token');
        $url = env('BASE_URL') . "/users/updatepassword";
        $client = new \GuzzleHttp\Client();
        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'accessToken' => $token,],
            'body'    => json_encode($data)
        ]);
        return $response;
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        return $data->Response;
    }

    public function loginget()
    {
        return view('auth/login');
    }

    public function register(Request $request)
    {
        $data = array(
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phoneNum' => $request->phoneNum,
            'password' => $request->password,
            'status' => true
        );
        $url = env('BASE_URL') . "/users/add";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        return $data;
    }

    // public function logout()
    // {
    //     session()->flush('token');
    //     session()->flush('response');
    //     session()->flash('warning', 'Logout!');
    //     return redirect()->route('login')->with('info', 'Logout!');
    // }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function push_notification()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('BASE_URL') . 'users/get_all_categories');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('pushnotifications.push_notification', ['data' => $data]);
    }

    public function send_notifications(Request $request)
    {
        $data = array(
            'userCategoryId' => $request->userCategoryId ?? '',
            'title' => $request->title,
            'body' => $request->body,
        );
        $url = env('BASE_URL') . "/users/send_notifications";

        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $response = $response->getBody()->getContents();
        $data = json_decode($response);
        if ($data->ResponseCode == 1) {
            return redirect()->route('push_notification')->with('info', $data->ResponseMessage);
        } else {
            return redirect()->route('push_notification')->with('danger', $data->errors);
        }
    }

    public function profile()
    {
        $data = Auth::user();
        return view('profile', ['data' => $data]);
    }


    public function update_profile(Request $request)
    {
    if (Auth::check()) {
        $user = Auth::user();

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'leyka_donor_phone' => 'required|string|max:15',
        ]);

        // Update the user's profile
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['leyka_donor_phone'],
        ]);

        // Redirect back with success message
        return redirect()->route('profile')->with('info', 'Profile updated successfully');
    } else {
        return redirect()->route('login')->with('error', 'Please log in to update your profile.');
    }
    }

    public function record()
    {
        $customers = User::where('usertype', 'customer')->get();
        $machines = Machine::all();
        $fuels = Fuel::with('fuelType')->get();
        $mobilOils = MobilOil::all();
        $dips = Dip::all();
        $expenses = Expense::all();
        

        return view('admin.record', compact('customers', 'machines', 'fuels', 'mobilOils', 'dips', 'expenses'));
    }


    protected function getFuelPrice($type)
    {
        $fuel = \App\Models\Fuel::where('name', 'like', $type)->first();
        return $fuel ? $fuel->price : 0;
    }

    public function add_daily_record(Request $request)
    {
        
        $user = Auth::user();

        // $request->validate([
        //     'shift_date' => 'required|date',
        //     'shift_type' => 'required',
        //     'cashier_id' => 'required|exists:users,id',
        //     'dip_petrol_id' => 'required|exists:dips,id',
        //     'dip_diesel_id' => 'required|exists:dips,id',
        //     'cash_in_hand' => 'required|numeric',
        //     'bank_online' => 'required|numeric',
        // ]);
    
        // Fetch fuel prices
        $petrolPrice = Fuel::where('name', 'petrol')->value('price');
        $dieselPrice = Fuel::where('name', 'diesel')->value('price');
    
        // Fail-safe fallback
        if (is_null($petrolPrice) || is_null($dieselPrice)) {
            return response()->json(['error' => 'Fuel prices not found for petrol or diesel'], 422);
        }
    
        // Save shift record
        $shift = ShiftData::create([
            'shift_date'     => $request->shift_date,
            'shift_type'     => $request->shift_type,
            'cashier_id'     => $request->cashier_id,
            'dip_petrol_id'  => $request->dip_petrol_id,
            'dip_diesel_id'  => $request->dip_diesel_id,
            'petrol_price'   => $petrolPrice,
            'diesel_price'   => $dieselPrice,
            'cash_in_hand'   => $request->cash_in_hand ?? 0,
            'bank_online'    => $request->bank_online ?? 0,
        ]);

        // if ($request->has('today_reading')) {
        //     foreach ($request->today_reading as $machineId => $todayReading) {
        //         if (!is_null($todayReading) && $todayReading !== '') {
        //             $machine = Machine::find($machineId);
        
        //             if (!$machine) {
        //                 continue;
        //             }
        
        //             $lastReading = $machine->last_reading ?? 0;
        //             $litres = $todayReading - $lastReading;
        //             $litres = $litres > 0 ? $litres : 0;
        
        //             $fuelPrice = optional($machine->fuelType)->price ?? 0;
        //             $amount = $litres * $fuelPrice;
        
        //             // Save shift reading
        //             ShiftReading::create([
        //                 'shift_data_id' => $shift->id, // from your main ShiftData creation
        //                 'machine_id'    => $machine->id,
        //                 'mobil_id'      => null,
        //                 'last_reading'  => $lastReading,
        //                 'today_reading' => $todayReading,
        //                 'litres'        => $litres,
        //                 'amount'        => $amount,
        //             ]);
        
        //             // Update machine: last_reading and deduct litres from inventory
        //             $machine->update([
        //                 'last_reading' => $todayReading,
        //                 'liters'       => $machine->liters - $litres,
        //             ]);
        //         }
        //     }
        // }
        

        if ($request->has('today_reading')) {
            foreach ($request->today_reading as $machineId => $todayReading) {
                if (!is_null($todayReading) && $todayReading !== '') {
                    $machine = Machine::find($machineId);
        
                    if (!$machine) {
                        continue;
                    }
        
                    $lastReading = $machine->last_reading ?? 0;
                    $litres = $todayReading - $lastReading;
                    $litres = $litres > 0 ? $litres : 0;
        
                    $fuel = $machine->fuel; 
                    
                    $fuelPrice = $fuel->price ?? 0;
                    $amount = $litres * $fuelPrice;
        
                    // Save shift reading
                    ShiftReading::create([
                        'shift_data_id' => $shift->id,
                        'machine_id'    => $machine->id,
                        'mobil_id'      => null,
                        'last_reading'  => $lastReading,
                        'today_reading' => $todayReading,
                        'litres'        => $litres,
                        'amount'        => $amount,
                    ]);
        
                    // Update machine last reading
                    $machine->update([
                        'last_reading' => $todayReading,
                    ]);
        
                    // Deduct litres from fuel stock (not from machine anymore)
                    if ($fuel && $litres > 0) {
                        $fuel->decrement('liters', $litres);
                    }
                }
            }
        }
        


        // ✅ Process Mobil Oils (quantity + price → ShiftReading)
        if ($request->has('quantity')) {
            foreach ($request->quantity as $mobilId => $qty) {
                if (!empty($qty) && $qty > 0) {
                    $salePrice = $request->mobil_oils[$mobilId]['sale_price'] ?? 0;
                    ShiftReading::create([
                        'shift_data_id' => $shift->id,
                        'mobil_id'      => $mobilId,
                        'litres'        => $qty,
                        'amount'        => $qty * $salePrice,
                        'last_reading'  => null,
                        'today_reading' => null,
                        'machine_id'    => null,
                    ]);
                    
                    // ✅ Deduct quantity from MobilOil inventory
                    $mobil = \App\Models\MobilOil::find($mobilId);
                    if ($mobil) {
                        $mobil->inventory = max(0, $mobil->inventory - $qty);
                        $mobil->save();
                    }
                }
            }
        }
        if ($request->filled('transactions')) {
            $transactions = json_decode($request->transactions, true);
            foreach ($transactions as $txn) {
                Transaction::create([
                    'user_id' => $txn['user_id'],
                    'transaction_type' => $txn['type'],
                    'payment_mode' => $txn['payment_mode'],
                    'amount' => $txn['amount'],
                    'description' => $txn['description'],
                    'transaction_date' => $txn['transaction_date'],
                    'shift_data_id' => $shift->id
                ]);
            }
        }

        if ($request->has('expenses') && is_array($request->expenses)) {
            foreach ($request->expenses as $expense) {
                if (
                    isset($expense['account_head']) &&
                    isset($expense['details']) &&
                    isset($expense['amount']) &&
                    is_numeric($expense['amount'])
                ) {
                    ExpenseHistory::create([
                        'expense_name' => $expense['account_head'],
                        'amount' => $expense['amount'],
                        'details' => $expense['details'],
                        'user_id' => $user->id,
                        'shift_data_id' => $shift->id
                    ]);
                }
            }
        }
        return redirect()->back()->with('sucess', 'New Record Added Sucessfully.');
    }
}
