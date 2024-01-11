<?php

use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/home', [ProductController::class, 'index']);
Route::get('/categories', [Categorie::class, 'index'])->name('categories.index');


// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');


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

Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');

Route::get('/admin/editCategorie/{id}', [AdminController::class, 'editCategorie'])->name('admin.editCategorie');
Route::put('/admin/updateCategorie/{id}', [AdminController::class, 'updateCategorie'])->name('admin.updateCategorie');

Route::delete('/admin/destroyCategorie/{id}', [AdminController::class, 'destroyCategorie'])->name('admin.destroyCategorie');



Route::get('admin/createCategorie', [AdminController::class, 'createCategorie'])->name('admin.createCategorie');
Route::post('admin/storeCategorie', [AdminController::class, 'storeCategorie'])->name('admin.storeCategorie');




});