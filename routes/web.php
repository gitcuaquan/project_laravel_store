<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\ClientContrller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;


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

Route::get('/', [ClientContrller::class, 'home']);

Route::get('product/{cat_id}', [ClientContrller::class, 'product']);
Route::get('product/show/{id}', [ClientContrller::class, 'show'])->name('show');




// ================ auth and verified ==========================

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // chúy ý chố này cần thêm middleware " verified"
    // ================= route Product zone ========================
    Route::get('admin/product/index', [ProductController::class, 'index'])->name('product.show');
    Route::get('admin/product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('admin/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('admin/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    // ==================end product zone ===================

    // ================= route oder zone ========================
    Route::get('admin/oder/index', [OderController::class, 'index'])->name('oder.show');
    // ==================end oder zone ===================

    // ================= route user zone ========================
    Route::get('admin/user/index', [UserController::class, 'index'])->name('user.show');
    Route::get('admin/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('admin/user/add', [UserController::class, 'create'])->name('user.add');
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('admin/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('admin/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // ==================end user zone ===================
    // ======================== cataegory =======================

    Route::get('admin/cat/add_children', [CategoriController::class, 'add_children'])->name('cat.add_children');
    Route::get('admin/cat/add_parent', [CategoriController::class, 'add_parent'])->name('cat.add_parent');
    Route::post('admin/cat/create', [CategoriController::class, 'create'])->name('cat.create');
    Route::post('admin/cat/create_parent', [CategoriController::class, 'create_parent'])->name('cat.create_parent');

    //  ===========================end cataegory =====================

    // ========================cart auth ================================

    // =========================end cart ===================================

    // ================= route post zone ========================
    Route::get('admin/post/index', [PostController::class, 'index'])->name('post.show');
    Route::get('admin/post/add', [PostController::class, 'add'])->name('post.add');
    Route::post('admin/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('admin/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('admin/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('admin/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    // ==================end post zone ===================
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__ . '/auth.php';


// =========================== email verify ====================================

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// =============================== ajax ===========================================

Route::post('admin/product/ajax', [ProductController::class, 'ajax'])->name('product.ajax');
Route::post('admin/post/ajax', [PostController::class, 'ajax'])->name('post.ajax');
Route::post('admin/user/ajax', [UserController::class, 'ajax'])->name('user.ajax');
Route::post('admin/product/ajax/muti', [ProductController::class, 'ajaxMuti'])->name('product.ajax.muti');
Route::post('admin/product/ajaxCat', [ProductController::class, 'ajaxCat'])->name('product.ajaxCat');

// ======================= search =================================================

Route::post('admin/user/search', [UserController::class, 'search'])->name('user.search');



// ============== ajax route ==========================
Route::post('ajax/ajaxCat', [AjaxController::class, 'ajaxCat'])->name('ajaxCat');



// =========================== cart route ===================

Route::get("cart/add/{id}", [CartController::class, 'add'])->name('cart.add');
Route::get("cart/detail_add/{id}", [CartController::class, 'detail_add'])->name('cart.detail_add');
Route::get("cart/show/{id}", [CartController::class, 'show'])->name('cart.show');
Route::post('cart/delete', [ClientContrller::class, 'delete']);
Route::post('cart/store',[CartController::class,'store']);
Route::post('cart/update',[CartController::class,'update']);