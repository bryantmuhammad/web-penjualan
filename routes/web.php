<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    UserController,
    KategoriController,
    ProdukController,
    SupplierController,
    PembelianController,
    PenjualanController as penjualanAdmin
};

use App\Http\Controllers\User\{
    UserController as CustomerUser,
    AlamatController,
    ProdukController as ProdukUser,
    KeranjangController,
    PenjualanController,
    OngkirController
};

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
Route::get('/', [DashboardController::class, 'index']);


Route::get('/dashboard/index', [DashboardController::class, 'index_admin'])->middleware('auth')->name('dashboard.index');


//ROUTE LOGIN ADMIN
Route::get('/loginadmin', [AuthController::class, 'loginadmin'])->middleware('guest')->name('admin.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ROUTE LOGIN USER
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('user.login');
Route::get('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/register', [AuthController::class, 'create'])->name('user.register.create');

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
    Route::get('create', [PembelianController::class, 'create'])->name('dashboard.pembelians.create');
    Route::get('{pembelian}', [PembelianController::class, 'show'])->name('dashboard.pembelians.show');
    Route::get('{pembelian}/print-invoice', [PembelianController::class, 'print_invoice'])->name('dashboard.pembelians.print-invoice');
    Route::post('store', [PembelianController::class, 'store'])->name('dashboard.pembelians.store');
    Route::get('{pembelian}/edit', [PembelianController::class, 'edit'])->name('dashboard.pembelians.edit');
    Route::put('/{pembelian}', [PembelianController::class, 'update'])->name('dashboard.pembelians.update');
    Route::delete('{pembelian}', [PembelianController::class, 'destroy'])->name('dashboard.pembelians.destory');
});


//ROUTE PENJUALAN ADMIN
Route::middleware(['auth', 'can:crud_admin'])->prefix('dashboard/penjualans')->group(function () {
    Route::get('belumbayar', [penjualanAdmin::class, 'belumbayar'])->name('dashboard.penjualans.belumbayar');
    Route::get('sudahbayar', [penjualanAdmin::class, 'sudahbayar'])->name('dashboard.penjualans.sudahbayar');
    Route::get('selesai', [penjualanAdmin::class, 'selesai'])->name('dashboard.penjualans.selesai');
    Route::get('{penjualan}/print-invoice', [penjualanAdmin::class, 'print_invoice'])->name('dashboard.penjualans.print-invoice');
    Route::put('/{penjualan}', [penjualanAdmin::class, 'update'])->name('dashborad.penjualans.update');
    Route::get('{penjualan}', [penjualanAdmin::class, 'show'])->name('dashboard.penjualans.show');
    Route::delete('{penjualan}', [penjualanAdmin::class, 'destroy'])->name('dashboard.penjualans.destroy');
});

Route::middleware('auth', 'can:laporan_admin')->prefix('dashboard/laporan')->group(function () {
    Route::get('/penjualan', [penjualanAdmin::class, 'laporan_index'])->name('laporan.penjualan');
    Route::get('/penjualan/print', [penjualanAdmin::class, 'laporan_print']);
    Route::get('/pembelian', [PembelianController::class, 'laporan_index'])->name('laporan.pembelian');
    Route::get('/pembelian/print', [PembelianController::class, 'laporan_print']);
    Route::get('/produk', [ProdukController::class, 'laporan'])->name('laporan.produk');
    Route::get('/produk/print', [ProdukController::class, 'laporan_print']);
});


// PROFIL USER
Route::get('/profil', [CustomerUser::class, 'profil'])->name('user.profil')->middleware('auth', 'can:crud_customer');
Route::put('/profil/{user}', [CustomerUser::class, 'update'])->name('user.update')->middleware('auth', 'can:crud_customer');
Route::get('/profil/alamat', [AlamatController::class, 'index'])->name('user.alamat');
Route::get('/profil/alamat/create', [AlamatController::class, 'create'])->name('user.alamat.create');
Route::post('/profil/alamat/store', [AlamatController::class, 'store'])->name('user.alamat.store');
Route::put('/profil/alamat/{alamat}/aktif', [AlamatController::class, 'aktif'])->name('user.alamat.aktif');

//ROUTE PRODUK
Route::prefix('produk')->group(function () {
    Route::get('/list', [ProdukUser::class, 'index'])->name('produk.list');
    Route::get('/list/{kategori}', [ProdukUser::class, 'filter_by_category'])->name('produk.list.category');
    Route::get('/detailproduk/{produk}', [ProdukUser::class, 'show'])->name('produk.detail');
});

//ROUTE KERANJANG
Route::middleware('auth', 'can:crud_customer')->prefix('keranjang')->group(function () {
    Route::get('/listkeranjang', [KeranjangController::class, 'index'])->name('keranjang.listkeranjang');
    Route::post('/tambahkeranjang', [KeranjangController::class, 'store'])->name('keranjang.tambah');
    Route::put('/{keranjang}', [KeranjangController::class, 'update']);
    Route::delete('/{keranjang}', [KeranjangController::class, 'destroy']);
});
Route::get('keranjang/jumlah', [KeranjangController::class, 'jumlah']);

//ROUTE PENJUALAN
Route::middleware('auth', 'can:crud_customer')->prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/listpenjualan', [PenjualanController::class, 'list_penjualan'])->name('penjualan.list');
    Route::post('/checkout', [PenjualanController::class, 'checkout'])->name('penjualan.checkout');
    Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/{penjualan}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::put('/{penjualan}/diterima', [PenjualanController::class, 'barang_diteirma']);
});

Route::get('/ongkir/getongkir', [OngkirController::class, 'get_ongkir']);


//ROUTE LIST PENJUALAN



























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
