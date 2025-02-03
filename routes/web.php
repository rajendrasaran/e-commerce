<?php
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ListController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributevalueController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NotForFrontUser;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('list/{slug}', [ListController::class, 'index'])->name('list');
Route::get('product/{slug}', [ListController::class, 'product'])->name('product');
Route::get('detail/{slug}', [ListController::class, 'detail'])->name('detail');
Route::get('view-cart', [ListController::class, 'cartRecord'])->name('view-cart');


Route::post('cart/{id}', [QuoteController::class, 'cart'])->name('cart');
Route::post('cartUpdate/{id}', [QuoteController::class, 'cartUpdate'])->name('cartUpdate');
Route::post('cartDelete/{id}', [QuoteController::class, 'cartDelete'])->name('cartDelete');





Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkoutCreate', [CheckoutController::class, 'checkoutstore'])->name('checkoutCreate');
Route::get('success', [CheckoutController::class, 'success'])->name('success');
Route::post('wishlist', [CheckoutController::class, 'wishlist'])->name('wishlist');
Route::post('wishlist-delete/{id}', [CheckoutController::class, 'wishlistd'])->name('deletewishlist');


Route::get('my-account', [CustomerController::class, 'myaccount'])->name('my-account');
Route::get('loginCustomer', [CustomerController::class, 'login'])->name('loginAdmin');
Route::get('registration', [CustomerController::class, 'registration'])->name('registration');
Route::post('registra', [CustomerController::class, 'rejisteruser'])->name('registra');
Route::post('loginCustomer', [CustomerController::class, 'loginCustomer'])->name('loginCustomer');
Route::get('Customer/logout', [CustomerController::class, 'logout'])->name('Customerlogout');
Route::post('Customer/account-update', [CustomerController::class, 'accountupdate'])->name('account-update');
Route::post('Customer/new-password', [CustomerController::class, 'newpassword'])->name('new-password');

Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('rejisteruser', [LoginController::class, 'rejisteruser'])->name('rejisteruser');

Route::get('search', [SearchController::class, 'search'])->name('search');


Route::get('admin', [LoginController::class, 'login'])->name('login');
Route::post('admin/login-user', [LoginController::class, 'loginuser'])->name('login-user');


Route::group(['middleware' => ['auth', 'notforfrontuser'], 'prefix' => 'admin'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('block', BlockController::class);
    Route::resource('page', PageController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('orders', [SaleController::class, 'index'])->name('orders');
    Route::resource('attribute',AttributeController::class);
    Route::resource('attribute-value',AttributevalueController::class);

});
