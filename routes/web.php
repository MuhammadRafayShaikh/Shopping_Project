<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BackOrderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('admin.dashboard', [AdminController::class, 'counts'])->name('admin.dashboard')->middleware('userValid');
Route::resource('category', CategoryController::class)->middleware('userValid');
Route::resource('subcategory', SubcategoryController::class)->middleware('userValid');
Route::resource('brand', BrandController::class)->middleware('userValid');
Route::resource('product', ProductController::class)->middleware('userValid');
Route::delete('product/{id}/{cat_id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('userValid');
Route::resource('user', UserController::class)->middleware('userValid');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('userValid');
Route::post('/update-header-status', [SubCategoryController::class, 'updateHeaderStatus'])->name('updateHeaderStatus');
Route::post('/update-footer-status', [SubCategoryController::class, 'updateFooterStatus'])->name('updateFooterStatus');
Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
Route::get('/get-brands/{sub_category_id}', [ProductController::class, 'brands']);
Route::get('/singleuser/{id}', [UserController::class, 'singleuser'])->name('singleuser')->middleware('auth');
Route::post('/blockuser', [UserController::class, 'blockuser'])->name('blockuser')->middleware('userValid');
Route::post('/blockuser2', [UserController::class, 'blockuser2'])->name('blockuser2')->middleware('userValid');
Route::get('/back', [UserController::class, 'back'])->name('back');
Route::get('adminRegistration', [AdminController::class, 'create']);
Route::get('adminreviews', [AdminController::class, 'reviews'])->name('adminreviews')->middleware('userValid');
Route::delete('admindeletereviews/{id}', [AdminController::class, 'deleteReview'])->name('admindeletereviews')->middleware('userValid');
Route::get('/', [FrontController::class, 'products'])->name('home');
Route::get('allProducts', [FrontController::class, 'allProducts'])->name('allProducts');
Route::get('/singleProduct/{id}', [FrontController::class, 'singleProduct'])->name('singleProduct');
Route::get('/frontcategory/{id}', [FrontController::class, 'category'])->name('frontcategory');
Route::get('/frontbrand/{id}', [FrontController::class, 'brand'])->name('frontbrand');
Route::get('/live-search', [FrontController::class, 'liveSearch'])->name('liveSearch');
Route::get('/singleuserview', [FrontController::class, 'singleuserview'])->name('singleuserview')->middleware('auth');
Route::get('/singleUser', [FrontController::class, 'singleUser'])->name('singleUser')->middleware('auth');
Route::resource('cart', CartController::class);
Route::post('/cartupdate/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cartdelete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('cart/{id}', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::resource('wishlist', WishlistController::class);
Route::post('wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store')->middleware('auth');
Route::post('/wishdelete/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order')->middleware('auth');
Route::get('/order', [OrderController::class, 'show'])->name('order')->middleware('auth');
Route::resource('backorder', BackOrderController::class)->middleware('userValid');
Route::put('backorder2/{id}', [BackOrderController::class, 'update2'])->name('backorder.update2')->middleware('userValid');
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::resource('review', ReviewController::class);
Route::post('review/{id}', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');
Route::delete('review/{id}/{pid}', [ReviewController::class, 'destroy'])->name('review.destroy');
Route::get('/payment/{amount}', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment', [OrderController::class, 'placeOrder']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('dashboard');
});
