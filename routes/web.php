<?php

use App\Http\Controllers\Admin\AdminDonasiController;
use App\Http\Controllers\Admin\AdminPanduanController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminJadwalDoa;
use App\Http\Controllers\Admin\AdminKategoriJadwal;
use App\Http\Controllers\Admin\AdminKontakController;
use App\Http\Controllers\Admin\AdminPastorParoki;
use App\Http\Controllers\Admin\TilikSejarahController;
use App\Http\Controllers\Admin\AdminSakramenController;
use App\Http\Controllers\Admin\AdminTerhubungController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DoaController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\identitasController;
use App\Http\Controllers\Admin\ManajemenRole;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Admin\TulisanBintaranController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/sejarah', [LandingController::class, 'sejarah'])->name('landing.sejarah');
Route::get('/gembala', [LandingController::class, 'gembala'])->name('landing.gembala');
Route::get('/doa', [LandingController::class, 'doa'])->name('landing.doa');
Route::get('/sakramen', [LandingController::class, 'sakramen'])->name('landing.sakramen');
Route::get('/tulisan', [LandingController::class, 'tulisan'])->name('landing.tulisan');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');
Route::get('/ssd', [LandingController::class, 'ssd'])->name('landing.ssd');
Route::get('/donasi', [LandingController::class, 'donasi'])->name('landing.donasi');
Route::get('/dokumen', [LandingController::class, 'dokumen'])->name('landing.dokumen');
Route::get('/dokumen/download/{id}', [LandingController::class, 'downloadDokumen'])->name('landing.dokumen.download');

Route::get('/ujud', [LandingController::class, 'ujud'])->name('landing.ujud');
Route::post('/ujud/store', [LandingController::class, 'storeUjud'])->name('landing.ujud.store');

Route::get('/panduan-perayaan-ekaristi', [LandingController::class, 'panduanPerayaan'])->name('landing.panduan');
Route::get('/panduan-perayaan-ekaristi/detail/{id}', [LandingController::class, 'detailPanduanPerayaan'])->name('landing.panduan.detail');


Route::get('/sakramen/detail/{id}', [LandingController::class, 'detailSakramen'])->name('landing.sakramen.detail');
Route::get('/tulisan/detail/{id}', [LandingController::class, 'detailTulisan'])->name('landing.news.detail');
Route::post('/contact/store', [LandingController::class, 'storeContact'])->name('landing.contact.store');

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');
Route::post('/auth-logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::prefix('forgot-password')->group(function () {
    Route::get('/', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
    Route::post('/send-otp', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendOtp'])->name('password.email');
    Route::get('/otp', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showOtpForm'])->name('password.otp');
    Route::post('/verify-otp', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyOtp'])->name('password.verify_otp');
    Route::get('/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('admin.dashboard.index'); 
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru telah dikirim ke email Anda!');
    })->middleware('throttle:6,1')->name('verification.send');
    Route::middleware(['role:0'])->group(function () {
        
    });
    Route::middleware(['role:1,2'])->group(function () {
        Route::get('/admin-dashboard',[DashboardAdminController::class, 'index'])->name('admin.dashboard.index');

        Route::prefix('admin-jadwal')->name('admin.jadwal.')->controller(AdminJadwalController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
        });

        Route::prefix('admin-kategori-jadwal')->name('admin.kategori.')->controller(AdminKategoriJadwal::class)->group(function(){
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-jadwal-doa')->name('admin.jadwal.')->controller(AdminJadwalDoa::class)->group(function(){
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-dokumen-paroki')->name('admin.dokparoki.')->controller(\App\Http\Controllers\Admin\DokParokiController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::match(['PUT', 'PATCH'], '/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/download/{id}', 'download')->name('download');
        });

        Route::prefix('admin-kategori-dok-paroki')->name('admin.kategori-dokparoki.')->controller(\App\Http\Controllers\Admin\KategoriDokParoki::class)->group(function(){
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-panduan')->name('admin.panduan.')->controller(AdminPanduanController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::match(['PUT', 'PATCH', 'POST'], '/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/download/{id}', 'download')->name('download');
        });

        Route::prefix('admin-tilik-sejarah')->name('admin.sejarah.')->controller(TilikSejarahController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-sakramen')->name('admin.sakramen.')->controller(AdminSakramenController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-donasi')->name('admin.donasi.')->controller(AdminDonasiController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            // tf
            Route::post('/transfer/store', 'storeTransfer')->name('transfer.store');
            Route::patch('/transfer/edit/{id}', 'EditTransfer')->name('transfer.edit');
            Route::delete('/transfer/destroy/{id}', 'DestroyTransfer')->name('transfer.destroy');
            // qr
            Route::post('/qr/store', 'StoreQrCode')->name('qr.store');
            Route::patch('/qr/edit/{id}', 'UpdateQrCode')->name('qr.edit');
            Route::delete('/qr/destroy/{id}', 'DestroyQrCode')->name('qr.destroy');
        });

        Route::prefix('admin-pastor-paroki')->name('admin.paroki.')->controller(AdminPastorParoki::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-terhubung')->name('admin.terhubung.')->controller(AdminTerhubungController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::patch('/update-status/{id}', 'updateStatus')->name('update.status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-doa')->name('admin.doa.')->controller(DoaController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::patch('/update-status/{id}', 'updateStatus')->name('update.status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-faq')->name('admin.faq.')->controller(FaqController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
            Route::post('/kategori/store', 'storeKategori')->name('kategori.store');
            Route::patch('/kategori/update/{id}', 'updateKategori')->name('kategori.update');
            Route::delete('/kategori/destroy/{id}', 'destroyKategori')->name('kategori.destroy');
            Route::post('/faq/store', 'storeFaq')->name('store');
            Route::patch('/faq/update/{id}', 'updateFaq')->name('update');
            Route::delete('/faq/destroy/{id}', 'destroyFaq')->name('destroy');
        });

        Route::prefix('admin-settings')->name('admin.settings.')->controller(SettingsController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
        });

        Route::prefix('admin-identitas')->name('admin.identitas.')->controller(identitasController::class)->group(function(){
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin/kontak')->name('admin.kontak.')->group(function () {
            Route::post('/store', [AdminKontakController::class, 'store'])->name('store');
            Route::post('/jam/store', [AdminKontakController::class, 'storeJam'])->name('jam.store');
            Route::put('/jam/{id}', [AdminKontakController::class, 'updateJam'])->name('jam.update');
            Route::delete('/jam/{id}', [AdminKontakController::class, 'destroyJam'])->name('jam.destroy');
        });

        Route::post('/admin-sosmed/store', [SosmedController::class, 'store'])->name('admin.sosmed.store');
        Route::post('/admin-seo/store', [SosmedController::class, 'storeSeo'])->name('admin.seo.store');

        Route::prefix('admin-blog')->name('admin.blog.')->controller(TulisanBintaranController::class)->group(function(){
            Route::get('/{tab?}', 'index')->name('index');
            Route::post('/kategori/store', 'storeKategori')->name('kategori.store');
            Route::patch('/kategori/update/{id}', 'updateKategori')->name('kategori.update');
            Route::delete('/kategori/destroy/{id}', 'deleteKategori')->name('kategori.destroy');
            // tulisan
            Route::post('/store', 'store')->name('store');
            Route::get('/detail/{id}', 'show')->name('detail');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin-gallery')->name('admin.gallery.')->controller(GalleryController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });
        
        Route::prefix('admin-manajemen-role')->name('admin.role.')->controller(ManajemenRole::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::post('/send-otp', 'sendVerificationCode')->name('send.otp');
            Route::post('/verify-otp', 'checkVerificationCode')->name('verify.otp');
            Route::post('/send-security-otp', 'sendAdminSecurityCode')->name('send.security.otp');
            Route::post('/verify-security-otp', 'checkAdminSecurityCode')->name('verify.security.otp');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('delete');
        });
    });
    Route::middleware(['role:2'])->group(function () {
      
    });
});