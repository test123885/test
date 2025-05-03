<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\FavoratController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
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

 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->role=="admin") {
            return view('admin.admindashboard');
            
        }else{
            return view('index');

        } 

    })->name('dashboard');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/about',function(){
    return view('about');
});
     
Route::get('/admindashboard',function(){
    return view('admin.admindashboard');
});
Route::get('/myaccount',function(){
    return view('user.myaccount');
    })->name('myaccount');
    
 Route::get('/account',function(){
        return view('user.account');
    })->name('account');    

Route::resource('/contacts',ContactsController::class);
Route::resource('/subscription',SubscriptionController::class);
Route::resource('/category',CategoryController::class);
Route::get('/categorybook/{id}',[CategoryController::class,"categorybook"]);
Route::resource('/favorat',FavoratController::class); 
Route::resource('/offer',OfferController::class); 
Route::resource('/book',BookController::class);
Route::get('/openpdf/{pdf}',[BookController::class ,"openpdf"]);
Route::get('/download/{pdf}',[BookController::class ,"download"]);
Route::get('/authorbooksforadmin/{id}',[BookController::class ,"authorbooksforadmin"]);
Route::get('/adminbooks',[BookController::class,"adminbooks"]);
Route::get('/addbook',[BookController::class,"addbook"]);
Route::get('/recommended',[BookController::class,"recommended"]);
Route::get('/updatebookstatuse/{book}',[BookController::class ,"updatebooktatuse"])->name('updatebookstatuse');
Route::get('/updatepageofcategory',[BookController::class ,"updatepageofcategory"])->name('updatepageofcategory');
Route::get('/filterprice',[BookController::class ,"filterprice"])->name('filterprice');
Route::get('/acceptbook/{book}',[BookController::class ,"acceptbook"]);
Route::get('/authorownbook',[BookController::class,"authorownbook"]);
Route::get('/details/{id}',[BookController::class,"details"]);
Route::get('/pendingbooks',[BookController::class,"pendingbooks"]);
Route::get('/canceldbooks',[BookController::class,"canceldbooks"]);
Route::get('/newbooks',[BookController::class,"newbooks"]);
Route::get('/bestselling',[BookController::class,"bestselling"]);
Route::get('/kidsbook',[BookController::class,"kidsbook"]);
Route::get('/search',[BookController::class,"search"]);
Route::get('/bookrequest',[UserController::class,"bookrequest"]);
Route::get('/blockuser/{id}',[UserController::class,"blockuser"]);
Route::resource('/user',UserController::class);
Route::get('/allauthors',[UserController::class,"allauthors"]);
Route::get('/notification',[UserController::class,"notification"]);
Route::get('/users',[UserController::class,"users"]);
Route::get('/authors',[UserController::class,"authors"]);
Route::get('/authorbook/{id}',[UserController::class,"authorbook"]);
Route::get('/explain',[UserController::class ,"explain"])->name('explain');
// Route::get('/orders/{order}/pay',[PaymentController::class ,"create"])->name('orders.payment');
 
// Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

// Route::get('/payment', [PaymentController::class, "index"]);
// Route::post('/charge', [PaymentController::class, "pay"]);



Route::resource('/checkout',CheckoutController::class);

Route::resource('/cart',CartController::class);
Route::get('/clearcart',[CartController::class,"clearcart"]);

Route::get('/updatebookquantaty/{cart}',[CartController::class,"updatebookquantaty"]);
Route::resource('/order',OrderController::class);
Route::get('/orderdetails/{id}',[OrderController::class,'orderdetails']);
Route::get('/userbooks',[OrderController::class,'userbooks']);
Route::get('/updateorderstatuse/{id}',[OrderController::class ,"updateorderstatuse"])->name('updateorderstatuse');
Route::get('/pendingorders',[OrderController::class,"pendingorders"]);
Route::get('/canceldorders',[OrderController::class,"canceldorders"]);
Route::get('/deleverdorders',[OrderController::class,"deleverdorders"]);
Route::resource('/rate',RateController::class);
Route::resource('/review',ReviewController::class);



Route::get('/checkoutpage', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');

































