<?php

namespace App\Providers;

use App\Models\IdentitasModel;
use App\Models\KontakModel;
use App\Models\SosmedModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('identitasGlobal', IdentitasModel::first());
            $view->with('kontakGlobal', KontakModel::with('jamPelayanan')->first());
            $view->with('sosmedGlobal', SosmedModel::first());
            $view->with('galleryGlobal', \App\Models\GalleryModel::first());
            $view->with('previewGalleryGlobal', \App\Models\TulisanBintaranImage::latest()->take(6)->get());
            $view->with('tulisanBintaranGlobal', \App\Models\TulisanBintaranModel::where('is_published', true)->latest()->take(4)->get());
        });
    }
}
