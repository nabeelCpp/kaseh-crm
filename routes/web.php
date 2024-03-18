<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\{ProductController, CustomerController,CaregiverController,InvoiceController,QuotationController, SalesOrderController};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicCaregiver;
use App\Http\Controllers\SettingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::get('/caregiver/{id}', [PublicCaregiver::class, 'CareGiver'])->name('caregiver');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('caregivers', CaregiverController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('orders', SalesOrderController::class);
    Route::resource('settings', SettingController::class);
    Route::patch('/orders/scheduling/{id}', [SalesOrderController::class, 'schedule'])->name('orders.schedule');
    Route::get('/get-product-price/{id}', [ProductController::class, 'getProductPrice']);
    Route::get('/orders/download/{order_no}', [SalesOrderController::class, 'downloadSalesOrder'])->name('download.order');
    Route::get('/schedulings/{id}', [SalesOrderController::class, 'fetchSchedulings']);
});

// path for user images
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path("app/$path");

    if (file_exists($filePath)) {
        return response()->file($filePath);
    }

    return response('File not found.', 404);
})->where('path', '.+');
