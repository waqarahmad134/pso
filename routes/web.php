<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\MobilOilController;
use App\Http\Controllers\DipController;
use App\Http\Controllers\StockWastageController;
use App\Http\Controllers\StockTestingController;
use App\Http\Controllers\ShiftDataController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;




//Clear Cache facade value:
Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('config:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/delete-db', function () {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    $tables = DB::select('SHOW TABLES');
    $dbName = 'Tables_in_' . DB::getDatabaseName();
    foreach ($tables as $table) {
        Schema::drop($table->$dbName);
    }

    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    return 'All tables dropped successfully!';
});

Route::get('/migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations executed successfully!';
});

Route::get('/seed', function () {
    Artisan::call('db:seed', ['--force' => true]);
    return 'Database seeded successfully!';
});


Route::middleware(['checktoken'])->group(function () {
});

    Route::get('all_roles', [App\Http\Controllers\RolesController::class, 'index'])->name('all_roles');
    Route::get('role_detail/{id}', [App\Http\Controllers\RolesController::class, 'role_detail'])->name('role_detail');
    Route::post('all_roles', [App\Http\Controllers\RolesController::class, 'all_roles'])->name('all_roles1');
    Route::get('block_role/{id}', [App\Http\Controllers\RolesController::class, 'block_role'])->name('block_role');
    Route::get('active_role/{id}', [App\Http\Controllers\RolesController::class, 'active_role'])->name('active_role');
    Route::post('update_permissions', [App\Http\Controllers\RolesController::class, 'update_permissions'])->name('update_permissions');
    Route::post('role_assign', [App\Http\Controllers\RolesController::class, 'role_assign'])->name('role_assign');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('homess');
    Route::get('/banners', [App\Http\Controllers\HomeController::class, 'banners'])->name('banners');
    Route::get('/delete_banner/{id}', [App\Http\Controllers\HomeController::class, 'delete_banner'])->name('delete_banner');
    Route::get('restricted_items', [App\Http\Controllers\HomeController::class, 'restricted_items'])->name('restricted_items');
    Route::get('restricted_delete/{id}', [App\Http\Controllers\HomeController::class, 'restricted_delete'])->name('restricted_delete');
    Route::post('add_restricted_items', [App\Http\Controllers\HomeController::class, 'add_restricted_items'])->name('add_restricted_items');
    Route::post('add_front', [App\Http\Controllers\HomeController::class, 'add_front'])->name('add_front');
    Route::get('settings',  [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');
    Route::get('settings_mobile',  [App\Http\Controllers\HomeController::class, 'settings_mobile'])->name('settings_mobile');
    Route::post('settings_update', [App\Http\Controllers\HomeController::class, 'settings_update'])->name('settings_update');
    Route::post('settings_update1', [App\Http\Controllers\HomeController::class, 'settings_update1'])->name('settings_update1');
    Route::post('site_settings', [App\Http\Controllers\HomeController::class, 'site_settings'])->name('site_settings');


    Route::get('send_parcel', function () {
        return view('send_parcel');
    })->name('send_parcel');




    Route::get('pickup_details', function () {
        return view('pickup_details');
    })->name('pickup_details');


    // Route::get('mails', function () {
    //     return view('mails');
    // })->name('mails');

    Route::get('mails', [App\Http\Controllers\HomeController::class, 'mails'])->name('mails');
    Route::get('mails_read', [App\Http\Controllers\HomeController::class, 'mails_read'])->name('mails_read');



    Route::get('list_users', [App\Http\Controllers\UserController::class, 'list_users'])->name('list_users');
    Route::get('employees', [App\Http\Controllers\UserController::class, 'employees'])->name('employees');
    Route::post('add_employees', [App\Http\Controllers\UserController::class, 'add_employee'])->name('add_employees');
    Route::get('delete_admin/{id}', [App\Http\Controllers\UserController::class, 'delete_admin'])->name('delete_admin');

    Route::post('add_admin', [App\Http\Controllers\UserController::class, 'add_admin'])->name('add_admins');

    Route::get('add_admin', function () {
        return view('admin/add_admin');
    })->name('add_admin');

    Route::get('drivers', function () {
        return view('driver/drivers');
    })->name('drivers');

    Route::get('drivers_earning', [App\Http\Controllers\DriverController::class, 'drivers_earning'])->name('drivers_earning');
    Route::post('driver_pay_apnimarzika', [App\Http\Controllers\DriverController::class, 'driver_pay_apnimarzika'])->name('driver_pay_apnimarzika');

    Route::get('drivers_earning', function () {
        return view('driver/drivers_earning');
    })->name('drivers_earning');


    Route::get('list_drivers', [App\Http\Controllers\DriverController::class, 'list_drivers'])->name('list_drivers');
    Route::get('drivers_earning', [App\Http\Controllers\DriverController::class, 'drivers_earning'])->name('drivers_earning');

    // Route::get('que_drivers_details', function () {
    //     return view('driver/que_drivers_details');
    // })->name('que_drivers_details');

    Route::get('que_drivers', [App\Http\Controllers\DriverController::class, 'que_drivers'])->name('que_drivers');
    Route::get('que_drivers_details', [App\Http\Controllers\DriverController::class, 'que_drivers_details'])->name('que_drivers_details');
    Route::get('waiting_drivers_details/{id}', [App\Http\Controllers\DriverController::class, 'waiting_drivers_details'])->name('waiting_drivers_details');
    Route::get('active_que_driver/{id}', [App\Http\Controllers\DriverController::class, 'active_que_driver'])->name('active_que_driver');
    Route::post('ratingss', [App\Http\Controllers\DriverController::class, 'ratingss'])->name('ratingss');
    Route::post('driver_bank', [App\Http\Controllers\DriverController::class, 'driver_bank'])->name('driver_bank');
    Route::get('driver_rides', [App\Http\Controllers\DriverController::class, 'driver_rides'])->name('driver_rides');

    Route::get('register', function () {
        return view('auth/register');
    })->name('register');

    Route::post('register', [App\Http\Controllers\UserController::class, 'register'])->name('registers');
  

    Route::get('admin_earnings', [App\Http\Controllers\EarningController::class, 'index'])->name('admin_earnings');

    Route::get('change_password', function () {
        return view('front-end-settings/change_password');
    })->name('change_password');
    Route::post('change_password', [App\Http\Controllers\UserController::class, 'change_password_post'])->name('change_password_post');




Route::get('login', [App\Http\Controllers\UserController::class, 'loginget'])->name('login');
Route::post('login', [App\Http\Controllers\UserController::class, 'login'])->name('logins');
Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('homess');
    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('update_profile', [App\Http\Controllers\UserController::class, 'update_profile'])->name('update_profile');
});


// users routes
Route::get('customers', [App\Http\Controllers\UserController::class, 'customers'])->name('customers');
Route::get('customers_balance', [App\Http\Controllers\UserController::class, 'customers_balance'])->name('customers_balance');
Route::get('staffs', [App\Http\Controllers\UserController::class, 'staffs'])->name('staffs');
Route::get('staffs_balance', [App\Http\Controllers\UserController::class, 'staffs_balance'])->name('staffs_balance');
Route::get('suppliers', [App\Http\Controllers\UserController::class, 'suppliers'])->name('suppliers');
Route::get('list_admin', [App\Http\Controllers\UserController::class, 'list_admin'])->name('list_admin');
Route::get('update_status/{id}', [App\Http\Controllers\UserController::class, 'update_status'])->name('update_status');
Route::post('add_user', [App\Http\Controllers\UserController::class, 'add_user'])->name('add_user');

//fuel routes


// Fuel Routes
Route::get('fuels', [App\Http\Controllers\FuelController::class, 'index'])->name('fuel.index');
Route::post('fuels', [App\Http\Controllers\FuelController::class, 'store'])->name('fuel.store');
Route::get('fuels/update_status/{id}', [App\Http\Controllers\FuelController::class, 'updateStatus'])->name('fuel.updateStatus');
Route::put('fuels/{id}', [App\Http\Controllers\FuelController::class, 'update'])->name('fuel.update');
Route::delete('fuels/{id}', [App\Http\Controllers\FuelController::class, 'destroy'])->name('fuel.delete');
Route::post('fuel/assign', [App\Http\Controllers\FuelController::class, 'assignFuel'])->name('fuel.assign');


// Dip Routes
Route::get('dips', [App\Http\Controllers\DipController::class, 'index'])->name('dip.index');
Route::post('dips', [App\Http\Controllers\DipController::class, 'store'])->name('dip.store');
Route::get('dips/update_status/{id}', [App\Http\Controllers\DipController::class, 'updateStatus'])->name('dip.updateStatus');
Route::put('dips/{id}', [App\Http\Controllers\DipController::class, 'update'])->name('dip.update');
Route::delete('dips/{id}', [App\Http\Controllers\DipController::class, 'destroy'])->name('dip.delete');


Route::get('mobil_oil', [App\Http\Controllers\MobilOilController::class, 'index'])->name('mobil_oil.index');
Route::post('mobil_oil', [App\Http\Controllers\MobilOilController::class, 'store'])->name('mobil_oil.store');
Route::get('mobil_oil/update_status/{id}', [App\Http\Controllers\MobilOilController::class, 'updateStatus'])->name('mobil_oil.updateStatus');
Route::put('mobil_oil/{id}', [App\Http\Controllers\MobilOilController::class, 'update'])->name('mobil_oil.update');
Route::delete('mobil_oil/{id}', [App\Http\Controllers\MobilOilController::class, 'destroy'])->name('mobil_oil.delete');


Route::get('stock', [App\Http\Controllers\StockController::class, 'index'])->name('stock.index');
Route::post('stock', [App\Http\Controllers\StockController::class, 'store'])->name('stock.store');
Route::get('stock/update_status/{id}', [App\Http\Controllers\StockController::class, 'updateStatus'])->name('stock.updateStatus');
Route::put('stock/{id}', [App\Http\Controllers\StockController::class, 'update'])->name('stock.update');
Route::delete('stock/{id}', [App\Http\Controllers\StockController::class, 'destroy'])->name('stock.delete');


Route::get('machines', [App\Http\Controllers\MachineController::class, 'index'])->name('machines.index');
Route::post('machines', [App\Http\Controllers\MachineController::class, 'store'])->name('machines.store');
Route::get('machines/update_status/{id}', [App\Http\Controllers\MachineController::class, 'updateStatus'])->name('machines.updateStatus');
Route::put('machines/{id}', [App\Http\Controllers\MachineController::class, 'update'])->name('machines.update');
Route::delete('machines/{id}', [App\Http\Controllers\MachineController::class, 'destroy'])->name('machines.delete');


// Route::prefix('admin')->middleware('auth')->group(function () {

// });


// Stock Wastage Routes
Route::get('stock_wastage', [App\Http\Controllers\StockWastageController::class, 'index'])->name('stock_wastage.index');
Route::post('stock_wastage', [App\Http\Controllers\StockWastageController::class, 'store'])->name('stock_wastage.store');
Route::get('stock_wastage/update_status/{id}', [App\Http\Controllers\StockWastageController::class, 'updateStatus'])->name('stock_wastage.updateStatus');
Route::put('stock_wastage/{id}', [App\Http\Controllers\StockWastageController::class, 'update'])->name('stock_wastage.update');
Route::delete('stock_wastage/{id}', [App\Http\Controllers\StockWastageController::class, 'destroy'])->name('stock_wastage.delete');

// Stock testing Routes
Route::get('stock_testing', [App\Http\Controllers\StockTestingController::class, 'index'])->name('stock_testing.index');
Route::post('stock_testing', [App\Http\Controllers\StockTestingController::class, 'store'])->name('stock_testing.store');
Route::get('stock_testing/update_status/{id}', [App\Http\Controllers\StockTestingController::class, 'updateStatus'])->name('stock_testing.updateStatus');
Route::put('stock_testing/{id}', [App\Http\Controllers\StockTestingController::class, 'update'])->name('stock_testing.update');
Route::delete('stock_testing/{id}', [App\Http\Controllers\StockTestingController::class, 'destroy'])->name('stock_testing.delete');

Route::get('shift_data', [App\Http\Controllers\ShiftDataController::class, 'index'])->name('shift_data.index');

Route::get('record', [App\Http\Controllers\UserController::class, 'record'])->name('record');
Route::post('add_daily_record', [App\Http\Controllers\UserController::class, 'add_daily_record'])->name('add_daily_record');

Route::get('sucess', function () {
    return view('sucess');
})->name('sucess');

Route::get('error', function () {
    return view('error');
})->name('error');

Route::get('503', function () {
    return view('503');
})->name('503');