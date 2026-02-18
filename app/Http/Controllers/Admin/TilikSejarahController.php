<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TilikSejarahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TilikSejarahController extends Controller
{
    public function index()
    {
        $profil = TilikSejarahModel::first();
        return view('admin.pages.sejarah.index', compact('profil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'deskripsi' => 'required',
                'gambar_baru.*' => 'image|mimes:jpg,jpeg,png|max:10240'
            ], [
                'gambar_baru.*.image' => 'File harus berupa gambar',
                'gambar_baru.*.mimes' => 'Format hanya jpg, jpeg, png',
                'gambar_baru.*.max'   => 'Ukuran gambar maksimal 10MB'
            ]);

            $galeri = [];
            if ($request->hasFile('gambar_baru')) {
                foreach ($request->file('gambar_baru') as $index => $img) {
                    $file = $img->store('profil-gereja', 'public');
                    $galeri[] = [
                        'file' => $file,
                        'caption' => $request->keterangan_baru[$index] ?? ''
                    ];
                }
            }

            TilikSejarahModel::create([
                'nama' => $request->nama ?? null,
                'deskripsi' => $request->deskripsi,
                'sejarah' => $request->sejarah ?? null,
                'visi' => $request->visi ?? null,
                'misi' => $request->misi ?? [],
                'maps' => $request->maps ?? null,
                'galeri' => $galeri
            ]);

            return redirect()->route('admin.sejarah.index')->with('swal_success', 'Tilik Sejarah berhasil dibuat');
        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'deskripsi'     => 'required|string',
                'sejarah'       => 'required|string',
                'visi'          => 'required|string',
                'maps'          => 'required|string',
                'misi'          => 'required|array|min:1',
                'misi.*'        => 'required|string',
                'gambar_baru.*' => 'image|mimes:jpg,jpeg,png|max:10240'
            ], [
                'misi.required' => 'Misi tidak boleh kosong',
                'misi.min'      => 'Minimal harus ada satu misi',
                'gambar_baru.*.image' => 'File harus berupa gambar',
                'gambar_baru.*.mimes' => 'Format hanya jpg, jpeg, png',
                'gambar_baru.*.max'   => 'Ukuran gambar maksimal 10MB'
            ]);

            $profil = TilikSejarahModel::findOrFail($id);
            $galeriLamaDB = $profil->galeri ?? [];
            
            $galeriFinal = [];
            $filesDipertahankan = [];

            if ($request->has('gambar_lama')) {
                foreach ($request->gambar_lama as $index => $file) {
                    $caption = $request->keterangan_lama[$index] ?? '';
                    
                    $galeriFinal[] = [
                        'file' => $file,
                        'caption' => $caption
                    ];
                    $filesDipertahankan[] = $file;
                }
            }

            foreach ($galeriLamaDB as $item) {
                if (!in_array($item['file'], $filesDipertahankan)) {
                    if (Storage::disk('public')->exists($item['file'])) {
                        Storage::disk('public')->delete($item['file']);
                    }
                }
            }

            if ($request->hasFile('gambar_baru')) {
                $files = $request->file('gambar_baru');
                $captions = $request->keterangan_baru ?? [];
                
                $files = array_values($files);
                $captions = array_values($captions);

                foreach ($files as $index => $img) {
                    if (count($galeriFinal) >= 5) break; 

                    $path = $img->store('profil-gereja', 'public');
                    $caption = $captions[$index] ?? ''; 

                    $galeriFinal[] = [
                        'file' => $path,
                        'caption' => $caption
                    ];
                }
            }

            $data = [
                'deskripsi' => $request->deskripsi,
                'sejarah'   => $request->sejarah,
                'visi'      => $request->visi,
                'misi'      => $request->misi ?? [],
                'maps'      => $request->maps,
                'galeri'    => $galeriFinal
            ];

            $profil->update($data);

            return redirect()->route('admin.sejarah.index')->with('swal_success', 'Tilik Sejarah berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $profil = TilikSejarahModel::findOrFail($id);

        if ($profil->galeri) {
            foreach ($profil->galeri as $img) {
                Storage::disk('public')->delete($img['file']);
            }
        }

        $profil->delete();

        return redirect()->route('admin.sejarah.index')
            ->with('swal_success', 'Tilik Sejarah berhasil dihapus');
    }
}
