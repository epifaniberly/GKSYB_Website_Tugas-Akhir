<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function index()
    {
        $data = GalleryModel::first();
        return view('admin.pages.gallery.index', compact('data'));
    }

    public function store(Request $request)
    {
        try{
            $data = $request->only([
                'url',
            ]);

            $gallery = GalleryModel::first();

            if ($gallery) {
                $gallery->update($data);
            } else {
                GalleryModel::create($data);
            }
        

            return back()->with('swal_success', 'URL Galeri berhasil diperbarui');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal memperbarui URL Galeri: ' . $e->getMessage());
        }
    }
}
