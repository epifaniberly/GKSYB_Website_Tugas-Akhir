<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBintaranModel;
use App\Models\TulisanBintaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TulisanBintaranController extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        $kategori = KategoriBintaranModel::all();

        $query = TulisanBintaranModel::with(['kategoriBintaran', 'user', 'images']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_tulisan', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%");
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_bintaran_id', $request->kategori);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_published', $request->status);
        }

        $tulisan = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.pages.blog.components.list', compact('tulisan'));
        }

        return view('admin.pages.blog.index', compact('kategori', 'tulisan', 'tab'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'warna' => 'nullable|string|max:20',
        ]);

        try{
            KategoriBintaranModel::create([
                'nama_kategori' => $request->nama_kategori,
                'slug' => $request->slug ?? \Illuminate\Support\Str::slug($request->nama_kategori),
                'warna' => $request->warna ?? '#8C1007',
            ]);

            return back()->with('swal_success', 'Kategori berhasil ditambahkan');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|max:255',
            'warna' => 'nullable|string|max:20',
        ]);

        try{
            $kategori = KategoriBintaranModel::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori ?? $kategori->nama_kategori,
                'slug' => $request->slug ?: \Illuminate\Support\Str::slug($request->nama_kategori ?? $kategori->nama_kategori),
                'warna' => $request->warna,
            ]);

            return back()->with('swal_success', 'Kategori berhasil diperbarui');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function deleteKategori($id)
    {
        try{
            $kategori = KategoriBintaranModel::findOrFail($id);

            if($kategori->tulisanBintaran()->count() > 0){
                 return back()->with('swal_error', 'Kategori tidak bisa dihapus karena masih digunakan oleh ' . $kategori->tulisanBintaran()->count() . ' tulisan');
            }

            $kategori->delete();

            return back()->with('swal_success', 'Kategori berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('swal_error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $tulisan = TulisanBintaranModel::with(['kategoriBintaran', 'images'])->findOrFail($id);
        return response()->json($tulisan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_tulisan' => 'required|string|max:255',
            'kategori_bintaran_id' => 'required',
            'konten' => 'required|string|min:300',
            'images.*' => 'nullable|mimes:jpg,jpeg,png|max:10240',
            'images' => 'max:5',
            'ringkasan' => 'required|string|min:50|max:255',
        ], [
            'images.max' => 'Maksimal 5 gambar yang diperbolehkan.'
        ]);

        try {
            $tulisan = TulisanBintaranModel::create([
                'judul_tulisan' => $request->judul_tulisan,
                'kategori_bintaran_id' => $request->kategori_bintaran_id,
                'user_id' => auth()->id() ?? 1,
                'ringkasan' => $request->ringkasan,
                'konten' => $request->konten,
                'is_published' => $request->is_published ? 1 : 0
            ]);

            if ($request->hasFile('images')) {
                foreach($request->file('images') as $index => $file) {
                    $ext = $file->getClientOriginalExtension();
                    $fileName = 'foto-bintaran-' . $tulisan->id . '-' . $index . '.' . $ext;
                    $file->storeAs('public/BintaranImage', $fileName);

                    \App\Models\TulisanBintaranImage::create([
                        'tulisan_bintaran_id' => $tulisan->id,
                        'image' => $fileName,
                        'caption' => $request->captions[$index] ?? null
                    ]);

                    if ($index === 0) {
                        $tulisan->update(['image' => $fileName]);
                    }
                }
            }

            return back()->with('swal_success', 'Tulisan berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menambahkan tulisan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'judul_tulisan' => 'sometimes',
                'kategori_bintaran_id' => 'sometimes|exists:kategori_bintaran,id',
                'ringkasan' => 'sometimes|string|min:50|max:255',
                'konten' => 'sometimes|string|min:300',
                'images.*' => 'nullable|mimes:jpg,jpeg,png|max:10240',
                'images' => 'max:5',
            ]);

            $tulisan = TulisanBintaranModel::findOrFail($id);

            $tulisan->update([
                'judul_tulisan' => $request->judul_tulisan,
                'kategori_bintaran_id' => $request->kategori_bintaran_id,
                'ringkasan' => $request->ringkasan,
                'konten' => $request->konten,
                'is_published' => $request->is_published ? 1 : 0
            ]);

            if ($request->hasFile('image')) {

                if ($tulisan->image && 
                    Storage::exists('public/BintaranImage/' . $tulisan->image)) {

                    Storage::delete('public/BintaranImage/' . $tulisan->image);
                }

                $ext = $request->file('image')->getClientOriginalExtension();
                $fileName = 'foto-bintaran-' . $tulisan->id . '.' . $ext;

                $request->file('image')
                    ->storeAs('public/BintaranImage', $fileName);

                $tulisan->update([
                    'image' => $fileName
                ]);
            }

            if ($request->has('existing_captions')) {
                foreach ($request->existing_captions as $imgId => $caption) {
                    \App\Models\TulisanBintaranImage::where('id', $imgId)
                        ->where('tulisan_bintaran_id', $tulisan->id)
                        ->update(['caption' => $caption]);
                }
            }

            if ($request->hasFile('images')) {
                foreach($request->file('images') as $index => $file) {
                    $ext = $file->getClientOriginalExtension();
                    $fileName = 'foto-bintaran-' . $tulisan->id . '-' . uniqid() . '.' . $ext;
                    
                    $file->storeAs('public/BintaranImage', $fileName);

                    \App\Models\TulisanBintaranImage::create([
                        'tulisan_bintaran_id' => $tulisan->id,
                        'image' => $fileName,
                        'caption' => $request->captions[$index] ?? null
                    ]);
                }
            }

            return back()->with('swal_success', 'Tulisan berhasil diperbarui');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal memperbarui tulisan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $tulisan = TulisanBintaranModel::findOrFail($id);

            if ($tulisan->image && 
                Storage::exists('public/BintaranImage/' . $tulisan->image)) {
                Storage::delete('public/BintaranImage/' . $tulisan->image);
            }
            if ($tulisan->images && $tulisan->images->count() > 0) {
                foreach ($tulisan->images as $image) {
                    if (Storage::exists('public/BintaranImage/' . $image->image)) {
                        Storage::delete('public/BintaranImage/' . $image->image);
                    }
                    $image->delete();
                }
            }

            $tulisan->delete();

            return back()->with('swal_success', 'Tulisan berhasil dihapus');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('swal_error', 'Tulisan tidak ditemukan');
        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menghapus tulisan: ' . $e->getMessage());
        }
    }
}
