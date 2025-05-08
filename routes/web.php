<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LapakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\AdminMiddleware; // Tambahkan ini

// Halaman Utama
Route::get('/', [BuyerController::class, 'index'])->name('buyer.home');

// Halaman Login dan Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman utama (Hanya untuk pengguna yang login)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/category/{kategori?}', [ProductController::class, 'index'])->name('home.category');

    // Profil pengguna
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    Route::put('/akun', [ProfileController::class, 'update'])->name('profil.update');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/products/{product}/ratings', [RatingController::class, 'store'])->name('ratings.store');


    // Lapak penjual
    Route::get('/lapak', [LapakController::class, 'index'])->name('lapak');
    Route::get('/lapak/create', [LapakController::class, 'create'])->name('lapak.create');
    Route::post('/lapak/store', [LapakController::class, 'store'])->name('lapak.store');

    // Kelola Lapak
    Route::get('/lapak/manage', [LapakController::class, 'lapakmanage'])->name('lapak.manage');
    Route::delete('/lapak/delete/{id}', [LapakController::class, 'delete'])->name('lapak.delete');
    Route::put('/lapak/update/{id}', [LapakController::class, 'update'])->name('lapak.update');

    // Verifikasi pembayaran
    Route::post('/payment/notification', [PaymentController::class, 'handlePaymentNotification']);
    Route::get('/payment/create/{order_id}', [PaymentController::class, 'createTransaction'])->name('payment.create');
    Route::post('/payment/upload', [PaymentController::class, 'uploadBuktiTransfer'])->name('payment.upload');
    Route::get('/payment/verify/{amount}/{product_id}', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::post('/payment/notify', [PaymentController::class, 'notifyAdmin'])->name('payment.notify');

    Route::middleware(['auth'])->group(function () {
        // ...existing routes...

        // Tambahkan route untuk pembayaran
        Route::get('/lapak/payment/{product}', [LapakController::class, 'showPayment'])->name('lapak.payment');
        Route::post('/payment/upload', [PaymentController::class, 'uploadBuktiTransfer'])->name('payment.upload');
    });
});

// Rute admin dengan middleware AdminMiddleware
Route::middleware(['auth:admin', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard'); // Rute untuk dashboard admin
    Route::get('/payment', [AdminController::class, 'showPayments'])->name('payments'); // Rute untuk halaman pembayaran
    Route::put('/payment/{id}/verify', [AdminController::class, 'verifyPayment'])->name('verifyPayment'); // Rute untuk verifikasi pembayaran
});

// Rute untuk login dan registrasi admin
Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Halaman About
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Halaman Pembeli
Route::get('/buyer/home', [BuyerController::class, 'index'])->name('buyer.home');
Route::get('/buyer/login', [AuthController::class, 'showBuyerLoginForm'])->name('buyer.login.form');
Route::post('/buyer/login', [AuthController::class, 'loginBuyer'])->name('buyer.login');
Route::get('/buyer/register', [AuthController::class, 'showBuyerRegisterForm'])->name('buyer.register.form');
Route::post('/buyer/register', [AuthController::class, 'registerBuyer'])->name('buyer.register');
Route::post('/buyer/logout', [AuthController::class, 'logout'])->name('buyer.logout');
Route::get('/buyer/profile', [BuyerController::class, 'profile'])->name('buyer.profile');

// Halaman untuk pencarian produk
Route::get('/search', [BuyerController::class, 'search'])->name('search.products');
