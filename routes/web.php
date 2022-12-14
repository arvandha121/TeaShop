<?php

use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// $disk = \Storage::disk('gcs');
// $disk->put('hola1.txt',"hola txt");

// Route::get('/config', function () {
//     Artisan::call('migrate');
//     // Artisan::call('db:seed');
// });

Route::get('/fresh', function () {
    Artisan::call('migrate:fresh', [
        '--force' => true
     ]);
    Artisan::call('db:seed', [
        '--force' => true
     ]);
});

Route::get('/config-clear', function () {
    Artisan::call('config:clear');
});

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/cart', function () {
    return view('user.cart');
})->name('cart');

Route::get('check-auth', [CartController::class, 'checkAuth'])->name('auth.check');
Route::post('cart/add', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/fetch', [CartController::class, 'fetchById'])->name('fetch');
Route::post('cart/delete/{id}', [CartController::class, 'destroy'])->name('destroy');
Route::post('cart/deletes/{userid}', [CartController::class, 'massDestroy'])->name('destroy.all');

Route::get('order/show/{id}', [OrderController::class, 'show'])->name('order.show');

Route::get('orders/{id}', [OrderController::class, 'fetchAll'])->name('order.all');

Route::get('order/email/{id}', function ($id) {
    Mail::to('firstnameforoptional@gmail.com')->send(new OrderMail($id));

    return redirect()->route('kasir.index');
})->name('mail.send');

Route::get('ongder', function () {
    return view('user.orders');
});

Route::put('order/menu/update/{order_id}', [OrderController::class, 'updateStock'])->name('order.stockUpdate');

Route::prefix('all-menus')->group(function () {
    Route::get('/', [MenuController::class, 'allMenus'])->name('user.menus')->withoutMiddleware(['role:admin', 'role:kasir', 'role:staff-dapur']);
    Route::get('/beverages', [MenuController::class, 'getBeverageData'])->withoutMiddleware(['role:admin', 'role:kasir', 'role:staff-dapur']);
    Route::get('/foods', [MenuController::class, 'getFoodData'])->withoutMiddleware(['role:admin', 'role:kasir', 'role:staff-dapur']);
    Route::get('/fetch-all', [MenuController::class, 'getAllMenus'])->withoutMiddleware(['role:admin', 'role:kasir', 'role:staf-dapur']);
});

Route::get('/menu/show/{id}', [MenuController::class, 'getMenu']);

Auth::routes(['verify' => true]);

Route::get('logout', [LoginController::class, 'logout']);

// route for buyer
Route::group(['middleware' => ['auth', 'role:buyer']], function () {
    Route::get('/order', function () {
        return view('user.order');
    })->middleware('verified'); // email must verified before accesing this route or page
    Route::get('/user/profile', function () {
        return view('user.profile');
    })->middleware('verified')->name('user.profile'); // email must verified before accesing this route or page
    Route::get('/user/edit_password/{id}', [UserController::class, 'edit_password'])
        ->middleware('verified')->name('user.edit_password'); // email must verified before accesing this route or page

    Route::post('order/add/{id}', [OrderController::class, 'store'])
        ->name('order.store')
        ->middleware('verified');
    // route for user
    Route::resource('user', UserController::class)->middleware('verified');
});

// routes for admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::get('/employee', [EmployeeController::class, 'index']);

        // route for employee
        Route::resource('employee', EmployeeController::class);

        // route for report
        Route::resource('report', ReportController::class);
        Route::get('/report_print', [ReportController::class, 'print_all'])->name('print');
    });
});

// routes for employee:staff-dapur
Route::group(['middleware' => ['auth', 'role:staff-dapur']], function () {
    Route::prefix('employee')->group(function () {
        //route for profile
        Route::get('/staff-dapur/profile/{id}', [EmployeeController::class, 'show_profile_staff'])->name('employee.staff.show_profile');
        Route::get('/staff-dapur/edit_profile/{id}', [EmployeeController::class, 'edit_profile_staff'])->name('employee.staff.edit_profile');
        Route::get('/staff-dapur/edit_password/{id}', [EmployeeController::class, 'edit_password_staff'])->name('employee.staff.edit_password');
        Route::put('/staff-dapur/update_profile/{id}', [EmployeeController::class, 'update_profile_staff'])->name('employee.staff.update_profile');
        Route::put('/staff-dapur/update_password/{id}', [EmployeeController::class, 'update_password_staff'])->name('employee.staff.update_password');

        Route::get('/staff-dapur', [MenuController::class, 'index']);

        // route for menu
        Route::resource('/staff-dapur/menu', MenuController::class);
    });
});

// routes for employee:kasir
Route::group(['middleware' => ['auth', 'role:kasir']], function () {
    Route::prefix('employee')->group(function () {
        //route for profile
        Route::get('/kasir/profile/{id}', [EmployeeController::class, 'show_profile_kasir'])->name('employee.kasir.show_profile');
        Route::get('/kasir/edit_profile/{id}', [EmployeeController::class, 'edit_profile_kasir'])->name('employee.kasir.edit_profile');
        Route::get('/kasir/edit_password/{id}', [EmployeeController::class, 'edit_password_kasir'])->name('employee.kasir.edit_password');
        Route::put('/kasir/update_profile/{id}', [EmployeeController::class, 'update_profile_kasir'])->name('employee.kasir.update_profile');
        Route::put('/kasir/update_password/{id}', [EmployeeController::class, 'update_password_kasir'])->name('employee.kasir.update_password');

        Route::get('/kasir', [PaymentController::class, 'index'])->name('kasir.index');

        // route for payment
        Route::resource('/kasir/payment', PaymentController::class);
        Route::get('/kasir/payment/print/{id}', [PaymentController::class, 'print'])->name('print_payment');

        Route::get('/kasir/payment/order/{token}', [OrderController::class, 'fetchByToken'])->name('order.fetchByToken');
        // Route::get('/ui-features/buttons', function () {
        //     return view('layouts.partials.ui-features.buttons');
        // });
        // Route::get('/ui-features/typography', function () {
        //     return view('layouts.partials.ui-features.typography');
        // });
        // Route::get('/icons/mdi', function () {
        //     return view('layouts.partials.icons.mdi');
        // });
        // Route::get('/forms/basic_elements', function () {
        //     return view('layouts.partials.forms.basic_elements');
        // });
        // Route::get('/charts/chartjs', function () {
        //     return view('layouts.partials.charts.chartjs');
        // });
        // Route::get('/tables/basic-table', function () {
        //     return view('layouts.partials.tables.basic-table');
        // });
        // Route::get('/samples/blank-page', function () {
        //     return view('layouts.partials.samples.blank-page');
        // });
        // Route::get('/samples/login', function () {
        //     return view('layouts.partials.samples.login');
        // });
        // Route::get('/samples/register', function () {
        //     return view('layouts.partials.samples.register');
        // });
        // Route::get('/samples/error-500', function () {
        //     return view('layouts.partials.samples.error-500');
        // });
        // Route::get('/samples/error-404', function () {
        //     return view('layouts.partials.samples.error-404');
        // });
    });
});