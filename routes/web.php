<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;


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
//     return view('user.home');
// });

// Route::get('/index', function () {
//     return view('user.home');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth') ;

Route::get('/',[HomeController::class,'redirect']);

Route::get('/index',[HomeController::class,'redirect']);

// Admin Show All Category Route
Route::get('/showcategory',[AdminController::class,'showcategory']);

// Admin Add Category Route
Route::get('/AddcategoryForm',[AdminController::class,'AddcategoryForm']);

// Admin Upload Category Route
Route::post('/uploadCategory',[AdminController::class,'uploadCategory']);

// Admin Delete Category Route
Route::get('/Delete_Category/{id}',[AdminController::class,'Delete_Category']);

// Admin Show All Products Route
Route::get('/showproducts',[AdminController::class,'showproducts']);

// Admin Add Products Route
Route::get('/Addproducts',[AdminController::class,'Addproducts']);

// Admin Upload Product Route
Route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

// Admin Update Product Route
Route::get('/updateproduct/{id}',[AdminController::class,'updateproduct']);

// Admin Do Update Product Route
Route::post('/do_update_product/{id}',[AdminController::class,'do_update_product']);

// Admin Delete Category Route
Route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

// Admin Show All Orders Route
Route::get('/showorders',[AdminController::class,'showorders']);

// Admin Update Delivered Order Route
Route::get('/updateDeliveredstatus/{id}',[AdminController::class,'updateDeliveredstatus']);

// Admin Print PDF Order Route
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);

// Admin Search Order Route
Route::get('/searchOrders',[AdminController::class,'searchOrdersdata']);





// User Product Detail Page Route
Route::get('/product_detail/{id}',[HomeController::class,'product_detail']);

// User Add Product To cart Route
Route::post('/AddToCart/{id}',[HomeController::class,'AddToCart']);

// User Show cart Route
Route::get('/ShowCart',[HomeController::class,'ShowCart']);

// User Show Orders Route
Route::get('/Showorders',[HomeController::class,'Showorders']);

// User Delete From Cart Route
Route::get('/DeleteFromCart/{id}',[HomeController::class,'DeleteFromCart']);

// User Delete From Orders Route
Route::get('/Cancelorder/{id}',[HomeController::class,'Cancelorder']);

// User Make Order Route
Route::get('/cash_order',[HomeController::class,'cash_order']);

// User Stripe Payment Route
Route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);

Route::post('stripe/{totalprice}',[HomeController::class, 'stripePost'])->name('stripe.post');

// User Comment Route
Route::post('/add_comment',[HomeController::class,'add_comment']);

// User Reply Route
Route::post('/add_reply',[HomeController::class,'add_reply']);

// User Search Products Route
Route::get('/searchproducts',[HomeController::class,'searchproductsdata']);

// User Products Page Route
Route::get('/products',[HomeController::class,'products']);