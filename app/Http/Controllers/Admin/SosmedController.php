<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoModel;
use App\Models\SosmedModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SosmedController extends Controller
{
    public function store(Request $request)
    {
        try{
            $data = $request->only([
                'url_ig',
                'url_yt',
                'url_tiktok',
                'url_gmaps',
            ]);

            $sosmed = SosmedModel::first();

            if ($sosmed) {
                $sosmed->update($data);
            } else {
                SosmedModel::create($data);
            }
        
            return redirect()->back()->with('swal_success', 'Data sosmed berhasil disimpan.');
        }catch(\Exception $e){
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan saat menyimpan data sosmed.');
        }
    }

    public function storeSeo(Request $request)
    {
        try {

            $data = $request->only([
                'meta_desc',
                'meta_keyword',
                'google_id',
                'maintenance_mode',
            ]);

            $data['maintenance_mode'] = $request->has('maintenance_mode') ? 1 : 0;

            $seo = SeoModel::first();

            if ($seo) {
                $seo->update($data);
            } else {
                SeoModel::create($data);
            }

            return redirect()->back()->with('swal_success', 'Pengaturan SEO berhasil disimpan.');
        }catch(\Exception $e){
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan saat menyimpan data SEO.');
        }
    }
}
