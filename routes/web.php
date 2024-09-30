<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/',[ProductsController::class,'index'])->name('allProducts');
Route::get("products", [ProductsController::class,'index'])->name('allProducts');
//men
Route::get("products/men", [ProductsController::class,'menProducts'])->name('menProducts');
//women
Route::get("products/women", [ProductsController::class,'womenProducts'])->name('womenProducts');
//other
Route::get("products/other", [ProductsController::class,'otherProducts'])->name('otherProducts');
//search
Route::get("search", [ProductsController::class,'search'])->name('searchProducts');


Route::get('product/addToCart/{id}',[ProductsController::class, 'addProductToCart'])->name('AddToCartProduct');
//show cart item
Route::get("cart", [ProductsController::class,'showCart'])->name('cartproducts');  
//delet cart item
Route::get('product/deleteitemfromcart/{id}',[ProductsController::class, 'deleteItemFromCart'])->name('DeleteItemFromCart');
//inc product
Route::get('product/increaseSingleProduct/{id}',[ProductsController::class, 'increaseSingleProduct'])->name('IncreaseSingleProduct');
//dec product
Route::get('product/decreaseSingleProduct/{id}',[ProductsController::class, 'decreaseSingleProduct'])->name('DecreaseSingleProduct');
//check out pro
Route::get('product/checkoutProducts/',[ProductsController::class, 'checkoutProducts'])->name('checkoutProducts');

//process checkout page
Route::post('product/createNewOrder/',[ProductsController::class, 'createNewOrder'])->name('createNewOrder');

//create order
Route::get('product/createOrder/',[ProductsController::class, 'createOrder'])->name('createOrder');

//payment
Route::get('payment/paymentPage/',[App\Http\Controllers\Payment\PaymentsController::class, 'showPaymentPage'])->name('showPaymentPage');

//payment recipt
Route::get('payment/paymentreceipt/{paymentID}/{payerID}',[App\Http\Controllers\Payment\PaymentsController::class, 'showPaymentReceipt'])->name('showPaymentReceipt');


//user auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//admin panel
Route::get('admin/products', [App\Http\Controllers\Admin\AdminProductsController::class,'index'])->name('adminDisplayProducts')->middleware('restrictToAdmin');
//display edit prodcut form
Route::get('admin/editProductForm/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'editProductForm'])->name('adminEditProductForm');
// display edit product img
Route::get('admin/editProductImageForm/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'editProductImageForm'])->name('adminEditProductImageForm');
//update product image
Route::post('admin/updateProductImage/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'updateProductImage'])->name('adminUpdateProductImage');
//update product data
Route::post('admin/updateProduct/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'updateProduct'])->name('adminUpdateProduct');
//insert new prodcut 
Route::get('admin/createProductForm', [App\Http\Controllers\Admin\AdminProductsController::class,'createProductForm'])->name('adminCreateProductForm');
//send new data to db
Route::post('admin/sendCreateProductForm', [App\Http\Controllers\Admin\AdminProductsController::class,'sendCreateProductForm'])->name('adminSendCreateProductForm');
//delete product
Route::get('admin/deleteProduct/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'deleteProduct'])->name('adminDeleteProduct');
