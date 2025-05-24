<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\MobilOilController;
use App\Http\Controllers\DipController;
use App\Http\Controllers\StockWastageController;
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

    Route::get('orders', function () {
        return view('order/orders');
    })->name('orders');

    Route::get('list_business', function () {
        return view('business/list_business');
    })->name('list_business');

    Route::get('add_business', function () {
        return view('business/add_business');
    })->name('add_business');

    Route::get('categories', [App\Http\Controllers\CategoryController::class, 'categories'])->name('categories');
    Route::get('cat_activate/{id}', [App\Http\Controllers\CategoryController::class, 'cat_activate'])->name('cat_activate');
    Route::get('cat_block/{id}', [App\Http\Controllers\CategoryController::class, 'cat_block'])->name('cat_block');
    Route::get('cat_delete/{id}', [App\Http\Controllers\CategoryController::class, 'cat_delete'])->name('cat_delete');
    Route::post('categories', [App\Http\Controllers\CategoryController::class, 'add_category'])->name('add_category');

    Route::get('sizes', function () {
        return view('sizes');
    })->name('sizes');



    Route::get('payment_methods', [App\Http\Controllers\PaymentHistory::class, 'payment_methods'])->name('payment_methods');
    Route::post('update_payment_method', [App\Http\Controllers\PaymentHistory::class, 'update_payment_method'])->name('update_payment_method');
    Route::post('add_payment_method', [App\Http\Controllers\PaymentHistory::class, 'add_payment_method'])->name('add_payment_method');
    Route::get('block_payment_method/{id}', [App\Http\Controllers\PaymentHistory::class, 'block_payment_method'])->name('block_payment_method');
    Route::get('active_payment_method/{id}', [App\Http\Controllers\PaymentHistory::class, 'active_payment_method'])->name('active_payment_method');

    Route::post('get_payment_method', [App\Http\Controllers\PaymentHistory::class, 'get_payment_method'])->name('get_payment_method');


    Route::get('payment_history', [App\Http\Controllers\PaymentHistory::class, 'payment_history'])->name('payment_history');
    Route::get('payment', [App\Http\Controllers\PaymentHistory::class, 'payment'])->name('payment');
    Route::get('pending_payment', [App\Http\Controllers\PaymentHistory::class, 'pending_payment'])->name('pending_payment');
    Route::get('pending_payment_accept/{id}/{amount}/{userId}', [App\Http\Controllers\PaymentHistory::class, 'pending_payment_accept'])->name('pending_payment_accept');


    Route::get('register', function () {
        return view('auth/register');
    })->name('register');

    Route::post('register', [App\Http\Controllers\UserController::class, 'register'])->name('registers');
  


    Route::get('filter', function () {
        return view('earnings/filter');
    })->name('filter');


    Route::get('admin_earnings', [App\Http\Controllers\EarningController::class, 'index'])->name('admin_earnings');
    Route::get('dashboard_booking_info', [App\Http\Controllers\EarningController::class, 'dashboard_booking_info'])->name('dashboard_booking_info');
    Route::post('earning_filter', [App\Http\Controllers\EarningController::class, 'earning_filter'])->name('earning_filter');





    Route::get('push_notification', [App\Http\Controllers\UserController::class, 'push_notification'])->name('push_notification');
    Route::post('send_notifications', [App\Http\Controllers\UserController::class, 'send_notifications'])->name('send_notifications');


    Route::get('vehicleinfo', function () {
        return view('vehicle/vehicleinfo');
    })->name('vehicleinfo');




    Route::get('change_password', function () {
        return view('front-end-settings/change_password');
    })->name('change_password');
    Route::post('change_password', [App\Http\Controllers\UserController::class, 'change_password_post'])->name('change_password_post');



    Route::get('charges', [App\Http\Controllers\ChargeController::class, 'charges'])->name('charges');
    Route::post('update_amount', [App\Http\Controllers\ChargeController::class, 'update_amount'])->name('update_amount');
    Route::post('update_value', [App\Http\Controllers\ChargeController::class, 'update_value'])->name('update_value');
    Route::post('update_charge', [App\Http\Controllers\ChargeController::class, 'update_charge'])->name('update_charge');

    Route::post('add_coupon', [App\Http\Controllers\CouponController::class, 'add_coupon'])->name('add_coupons');
    Route::post('coupon_detail/{id}', [App\Http\Controllers\CouponController::class, 'coupon_detail'])->name('coupon_detail');
    Route::get('add_coupon', [App\Http\Controllers\CouponController::class, 'coupons'])->name('add_coupon');
    Route::post('deactivate', [App\Http\Controllers\CouponController::class, 'deactivate'])->name('deactivate');
    Route::post('activate', [App\Http\Controllers\CouponController::class, 'activate'])->name('activate');
    Route::post('update_coupon', [App\Http\Controllers\CouponController::class, 'update_coupon'])->name('update_coupon');
    Route::get('coupons_detail/{id}', [App\Http\Controllers\CouponController::class, 'coupons_detail'])->name('coupons_detail');
    Route::post('delete', [App\Http\Controllers\CouponController::class, 'delete'])->name('delete');



    Route::get('all_bookings', [App\Http\Controllers\BookingController::class, 'all_bookings'])->name('all_bookings');
    Route::get('cancel_bookings', [App\Http\Controllers\BookingController::class, 'cancel_bookings'])->name('cancel_bookings');
    Route::get('booking_detail/{id}', [App\Http\Controllers\BookingController::class, 'booking_detail'])->name('booking_detail');
    Route::get('booking_data/{id}', [App\Http\Controllers\BookingController::class, 'booking_data'])->name('booking_data');
    Route::get('booking_details/{id}', [App\Http\Controllers\BookingController::class, 'booking_details'])->name('booking_details');
    Route::get('driver_detail/{id}', [App\Http\Controllers\DriverController::class, 'driver_detail'])->name('driver_detail');


    Route::get('roles', [App\Http\Controllers\BookingController::class, 'roles'])->name('roles');
    Route::get('deleterole/{id}', [App\Http\Controllers\BookingController::class, 'deleterole'])->name('deleterole');
    Route::post('roles', [App\Http\Controllers\BookingController::class, 'roles_post'])->name('roles_post');
    Route::get('role_activate/{id}', [App\Http\Controllers\BookingController::class, 'role_activate'])->name('role_activate');
    Route::get('role_block/{id}', [App\Http\Controllers\BookingController::class, 'role_block'])->name('role_block');

    Route::get('all_vec', [App\Http\Controllers\VehicleController::class, 'all_vec'])->name('all_vec');
    Route::get('vehicle_delete/{id}', [App\Http\Controllers\VehicleController::class, 'vehicle_delete'])->name('vehicle_delete');
    Route::get('vec_detail/{id}', [App\Http\Controllers\VehicleController::class, 'vec_detail'])->name('vec_detail');
    Route::get('activate_vec/{id}', [App\Http\Controllers\VehicleController::class, 'activate'])->name('activate_vec');
    Route::get('block/{id}', [App\Http\Controllers\VehicleController::class, 'block'])->name('block');
    Route::post('add_vecs', [App\Http\Controllers\VehicleController::class, 'add_vec'])->name('add_vecs');
    Route::post('update_vec', [App\Http\Controllers\VehicleController::class, 'update_vec'])->name('update_vec');
    Route::get('vecdelete/{id}', [App\Http\Controllers\VehicleController::class, 'vecdelete'])->name('vecdelete');

    Route::get('packages', [App\Http\Controllers\PackageController::class, 'packages'])->name('packages');
    Route::get('delete_package/{id}', [App\Http\Controllers\PackageController::class, 'delete_package'])->name('delete_package');
    Route::post('add_banner', [App\Http\Controllers\PackageController::class, 'add_banner'])->name('add_banner');




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
Route::get('staffs', [App\Http\Controllers\UserController::class, 'staffs'])->name('staffs');
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


Route::get('record', [App\Http\Controllers\UserController::class, 'record'])->name('record');
Route::get('add_daily_record', [App\Http\Controllers\UserController::class, 'add_daily_record'])->name('add_daily_record');

Route::get('sucess', function () {
    return view('sucess');
})->name('sucess');

Route::get('error', function () {
    return view('error');
})->name('error');

Route::get('503', function () {
    return view('503');
})->name('503');