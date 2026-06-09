<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicProductoController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\PublicCasaRuralController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\PostBlogController;
use App\Http\Controllers\Admin\TipoPostController;
use App\Http\Controllers\Admin\SemanaCasillaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/productos', [PublicProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{producto}', [PublicProductoController::class, 'show'])->name('productos.show');
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::get('/casa-rural', [PublicCasaRuralController::class, 'index'])->name('casa-rural.index');
Route::post('/casa-rural/reservar', [PublicCasaRuralController::class, 'reservar'])->name('casa-rural.reservar');

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/add/{producto}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/carrito/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('productos', ProductoController::class);
    Route::resource('pedidos', PedidoController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('posts', PostBlogController::class);
    Route::resource('tipo-posts', TipoPostController::class);
    Route::resource('semanas', SemanaCasillaController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
