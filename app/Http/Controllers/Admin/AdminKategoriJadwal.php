<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriJadwal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriJadwal extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        try{
            KategoriJadwal::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return back()->with('swal_success', 'Kategori jadwal berhasil ditambahkan');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        try{
            $kategori = KategoriJadwal::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return back()->with('swal_success', 'Kategori jadwal berhasil diperbarui');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $kategori = KategoriJadwal::findOrFail($id);

            if($kategori->jadwals()->count() > 0){
                return back()->with('swal_error', 'Kategori tidak bisa dihapus karena masih digunakan oleh ' . $kategori->jadwals()->count() . ' jadwal');
            }

            $kategori->delete();

            return back()->with('swal_success', 'Kategori jadwal berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
    
}
