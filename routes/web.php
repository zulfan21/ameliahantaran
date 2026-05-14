<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');

// Products
Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/keranjang/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/hapus/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/keranjang/count', [CartController::class, 'count'])->name('cart.count');

// Testimonials
Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials.index');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/pembayaran/{orderNumber}', [CheckoutController::class, 'payment'])->name('checkout.payment');

    // Orders
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan/{orderNumber}/upload-bukti', [OrderController::class, 'uploadPayment'])->name('orders.upload-payment');
    Route::post('/pesanan/{orderNumber}/batal', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/pesanan/{orderNumber}/selesai', [OrderController::class, 'complete'])->name('orders.complete');

    // Testimonials
    Route::get('/testimoni/buat', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', AdminProductController::class);
    Route::post('/products/{product}/upload-images', [AdminProductController::class, 'uploadImages'])->name('products.upload-images');
    Route::delete('/products/{product}/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::post('/products/{product}/stock', [AdminProductController::class, 'updateStock'])->name('products.update-stock');

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/payments/{paymentProof}/verify', [AdminOrderController::class, 'verifyPayment'])->name('payments.verify');
    Route::post('/orders/{order}/approve-cancel', [AdminOrderController::class, 'approveCancel'])->name('orders.approve-cancel');
    Route::post('/orders/{order}/reject-cancel', [AdminOrderController::class, 'rejectCancel'])->name('orders.reject-cancel');

    // Testimonials
    Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::post('/testimonials/{testimonial}/reject', [AdminTestimonialController::class, 'reject'])->name('testimonials.reject');
    Route::post('/testimonials/{testimonial}/toggle-featured', [AdminTestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');
    Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Gallery
    Route::resource('galleries', GalleryController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

});

require __DIR__.'/auth.php';
