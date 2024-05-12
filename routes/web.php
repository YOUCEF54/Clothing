<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TemporaryFile;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;



Route::get('/', function () {
    return Inertia::render('HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => \App\Models\Category::all(),
        'products' => \App\Models\Product::all(),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/products/{slug}', function ($slug) {
    $product = \App\Models\Product::where('slug', $slug)->with('reviews')->with('category')->first();
    return Inertia::render("ProductDetails", ["product" => $product]);
});


Route::get('/ProductDetails', function () {
    return Inertia::render("ProductDetails");
})->middleware('auth')->name('ProductDetails');


Route::get('/ViewAll', function () {
    return Inertia::render("ViewAll");
})->middleware('auth')->name('ViewAll');

Route::get('/Cart', function () {
    return Inertia::render("Cart");
})->middleware('auth')->name('Cart');

Route::get('/Favorite', function () {
    return Inertia::render("Favorite");
})->middleware('auth')->name('Favorite');





require __DIR__ . '/auth.php';
