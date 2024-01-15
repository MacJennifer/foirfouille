<?php

use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionsController;

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

/***********************  ACCUEIL **********************************************/
Route::get('/', function () {
    return view('home');
});

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/home', [ProductController::class, 'index']);
Route::get('/categories', [Categorie::class, 'index'])->name('categories.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');

/***********  Deconnection  *************************************************/

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

/***********************  PANIER  ***********************************************/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{productId}', [CartController::class, 'addProduct'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeProduct'])->name('cart.remove');

Route::get('/cart/show', [CartController::class, 'show'])->name('cart.show');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
/**********************  ADMIN  ****************************************************/

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/storeProduct', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::get('/admin/storeProduct', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::put('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProducts'])->name('admin.destroyProducts');
    Route::get('/admin/products/{id}', [AdminController::class, 'destroyProducts'])->name('admin.destroyProducts');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/editCategorie/{id}', [AdminController::class, 'editCategorie'])->name('admin.editCategorie');
    Route::put('/admin/updateCategorie/{id}', [AdminController::class, 'updateCategorie'])->name('admin.updateCategorie');
    Route::delete('/admin/destroyCategorie/{id}', [AdminController::class, 'destroyCategorie'])->name('admin.destroyCategorie');
    Route::get('admin/createCategorie', [AdminController::class, 'createCategorie'])->name('admin.createCategorie');
    Route::post('admin/storeCategorie', [AdminController::class, 'storeCategorie'])->name('admin.storeCategorie');

    /****************************************  PROMOTION  *********************************************************/

    Route::get('/admin/promotions', [AdminController::class, 'promotions'])->name('admin.promotions');
    Route::get('/admin/createPromotion', [AdminController::class, 'createPromotion'])->name('admin.createPromotion');
    Route::post('/admin/storePromotion', [AdminController::class, 'storePromotion'])->name('admin.storePromotion');
    Route::get('/admin/promotions/edit/{id}', [AdminController::class, 'editPromotion'])->name('admin.editPromotion');
    Route::put('/admin/promotions/update/{id}', [AdminController::class, 'updatePromotion'])->name('admin.updatePromotion');
    Route::delete('/admin/promotions/destroy/{id}', [AdminController::class, 'destroyPromotion'])->name('admin.destroyPromotion');

    /***********************  RECHERCHE  ****************************************/

    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
});
