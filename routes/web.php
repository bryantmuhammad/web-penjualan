<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    UserController,
    KategoriController,
    ProdukController,
    SupplierController,
    PembelianController
};
use App\Http\Controllers\AuthController;
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


// Dashboard
Route::get('/dashboard/index', function () {
    return view('pages.dashboard-general-dashboard');
})->middleware('auth')->name('dashboard.index');

Route::redirect('/register/redirect', '/dashboard/index');

Route::get('/loginadmin', function () {
    return view('auth.login');
})->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::resource('user', UserController::class);

//ROUTE USER
Route::middleware(['auth', 'can:crud_admin'])->prefix('dashboard/admins')->group(function () {
    Route::get('index', [UserController::class, 'index'])->name('dashboard.admins.index');
    Route::get('create', [UserController::class, 'create'])->name('dashboard.admins.create');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('dashboard.admins.edit');
    Route::post('store', [UserController::class, 'store'])->name('dashboard.admin.store');
    Route::put('/{user}', [UserController::class, 'update'])->name('dashboard.admins.update');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('dashboard.admins.destory');
});

//ROUTE KATEGORI
Route::middleware(['auth', 'can:crud_admin'])->prefix('dashboard/kategoris')->group(function () {
    Route::get('index', [KategoriController::class, 'index'])->name('dashboard.kategoris.index');
    Route::get('create', [KategoriController::class, 'create'])->name('dashboard.kategoris.create');
    Route::post('store', [KategoriController::class, 'store'])->name('dashboard.kategoris.store');
    Route::get('{kategori}/edit', [KategoriController::class, 'edit'])->name('dashboard.kategoris.edit');
    Route::put('/{kategori}', [KategoriController::class, 'update'])->name('dashboard.kategoris.update');
    Route::delete('{kategori}', [KategoriController::class, 'destroy'])->name('dashboard.kategoris.destory');
});


//ROUTE PRODUK
Route::middleware(['auth', 'can:crud_admin'])->prefix('dashboard/produks')->group(function () {
    Route::get('index', [ProdukController::class, 'index'])->name('dashboard.produks.index');
    Route::get('create', [ProdukController::class, 'create'])->name('dashboard.produks.create');
    Route::post('store', [ProdukController::class, 'store'])->name('dashboard.produks.store');
    Route::get('{produk}/edit', [ProdukController::class, 'edit'])->name('dashboard.produks.edit');
    Route::put('/{produk}', [ProdukController::class, 'update'])->name('dashboard.produks.update');
    Route::delete('{produk}', [ProdukController::class, 'destroy'])->name('dashboard.produks.destory');
});

//ROUTE SUPPLIER
Route::middleware(['auth', 'can:crud_admin'])->prefix('dashboard/suppliers')->group(function () {
    Route::get('index', [SupplierController::class, 'index'])->name('dashboard.suppliers.index');
    Route::get('create', [SupplierController::class, 'create'])->name('dashboard.suppliers.create');
    Route::post('store', [SupplierController::class, 'store'])->name('dashboard.suppliers.store');
    Route::get('{supplier}/edit', [SupplierController::class, 'edit'])->name('dashboard.suppliers.edit');
    Route::put('/{supplier}', [SupplierController::class, 'update'])->name('dashboard.suppliers.update');
    Route::delete('{supplier}', [SupplierController::class, 'destroy'])->name('dashboard.suppliers.destory');
});


//ROUTE PEMBELIAN
Route::middleware(['auth', 'can:transaksi_admin'])->prefix('dashboard/pembelians')->group(function () {
    Route::get('index', [PembelianController::class, 'index'])->name('dashboard.pembelians.index');
    Route::get('{pembelian}', [PembelianController::class, 'show'])->name('dashboard.pembelians.show');
    Route::get('create', [PembelianController::class, 'create'])->name('dashboard.pembelians.create');
    Route::post('store', [PembelianController::class, 'store'])->name('dashboard.pembelians.store');
    Route::get('{pembelian}/edit', [PembelianController::class, 'edit'])->name('dashboard.pembelians.edit');
    Route::put('/{pembelian}', [PembelianController::class, 'update'])->name('dashboard.pembelians.update');
    Route::delete('{pembelian}', [PembelianController::class, 'destroy'])->name('dashboard.pembelians.destory');
});






// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('pages.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('pages.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('pages.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('pages.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('pages.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('pages.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('pages.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('pages.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('pages.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('pages.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('pages.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('pages.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('pages.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('pages.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('pages.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('pages.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('pages.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('pages.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('pages.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('pages.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('pages.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('pages.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('pages.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('pages.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('pages.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('pages.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('pages.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('pages.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('pages.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('pages.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('pages.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('pages.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('pages.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('pages.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('pages.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('pages.forms-validation', ['type_menu' => 'forms']);
});

// google maps
// belum tersedia

// modules
Route::get('/modules-calendar', function () {
    return view('pages.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('pages.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('pages.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('pages.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('pages.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('pages.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('pages.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('pages.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('pages.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('pages.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('pages.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('pages.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
Route::get('/auth-forgot-password', function () {
    return view('pages.auth-forgot-password', ['type_menu' => 'auth']);
});
Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('pages.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('pages.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('pages.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('pages.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('pages.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('pages.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('pages.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('pages.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('pages.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('pages.features-post', ['type_menu' => 'features']);
});
Route::get('/features-profile', function () {
    return view('pages.features-profile', ['type_menu' => 'features']);
});
Route::get('/features-settings', function () {
    return view('pages.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('pages.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('pages.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('pages.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('pages.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('pages.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
