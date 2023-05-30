<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\CityComponent;
use App\Http\Livewire\Admin\UserComponent;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Livewire\Admin\WeightComponent;
use App\Http\Livewire\DollarComponent;

Route::get('products',  ShowProducts::class)->name('admin.index');

Route::get('products/create',  CreateProduct::class )->name('admin.products.create');

Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('categories',  [CategoryController::class, 'index'])->name('admin.categories.index');

Route::get('category/{category}',  ShowCategory::class)->name('admin.categories.show');

Route::get('brands',  BrandComponent::class)->name('admin.brands.index');

Route::get('/',  [OrderController::class, 'index'])->name('admin.orders.index');

Route::get('orders/{order}',  [OrderController::class, 'show'])->name('admin.orders.show');

Route::get('departments',  DepartmentComponent::class)->name('admin.departments.index');

Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');

Route::get('cities/{city}', CityComponent::class)->name('admin.cities.show');

Route::get('weights', WeightComponent::class)->name('admin.weights.index');

Route::get('users', UserComponent::class)->name('admin.users.index');

Route::get('dolar', DollarComponent::class)->name('admin.dollar.index');



