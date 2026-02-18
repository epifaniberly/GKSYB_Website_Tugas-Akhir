<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriDokumenModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriDokParoki extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        try{
            KategoriDokumenModel::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return back()->with('swal_success', 'Kategori berhasil ditambahkan');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menyimpan kategori: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        try{
            $kategori = KategoriDokumenModel::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return back()->with('swal_success', 'Kategori berhasil diperbarui');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $kategori = KategoriDokumenModel::findOrFail($id);
            
            if($kategori->dokumen()->count() > 0){
                return back()->with('swal_error', 'Kategori tidak bisa dihapus karena masih digunakan oleh ' . $kategori->dokumen()->count() . ' dokumen');
            }

            $kategori->delete();

            return back()->with('swal_success', 'Kategori berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
