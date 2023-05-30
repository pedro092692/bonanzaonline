<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacebookLogin;
use App\Http\Controllers\GoogleLogin;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Contact;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\PaymentOrder;
use App\Http\Livewire\ProductShow;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', WelcomeController::class);

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('products/{product}', ProductShow::class)->name('products.show');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::get('contact', Contact::class)->name('contact');

Route::get('privacy-policies', function(){
    return view('privacyPolicies.index');
})->name('privacy-policies');

Route::get('about', function(){
    return view('about.index');
})->name('about');

Route::middleware(['auth'])->group(function(){

    Route::get('orders',  [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/create',  CreateOrder::class)->name('orders.create');

    Route::get('orders/{order}',  [OrderController::class, 'show'])->name('orders.show');
    
    Route::get('orders/{order}/payment',  PaymentOrder::class)->name('orders.payment');
});

Route::post('reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('login-google', function(){
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('google-callback', GoogleLogin::class);

Route::get('login-facebook', function(){
    return Socialite::driver('facebook')->redirect();
})->name('facebook.login');

Route::get('facebook-callback', FacebookLogin::class);

Route::fallback(function () {
    abort(404);
});




