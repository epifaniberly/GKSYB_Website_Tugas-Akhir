<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SakramenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSakramenController extends Controller
{
    public function index()
    {
        $sakramen = SakramenModel::limit(7)->get();
        return view('admin.pages.sakramen.index', compact('sakramen'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_sakramen' => 'required|string|max:255',
                'deskripsi_singkat' => 'required|string|max:255',
                'kutipan_ayat' => 'nullable|string',
                'sumber_ayat' => 'nullable|string|max:255',
                'deskripsi_lengkap' => 'nullable|string',
                'icon_sakramen' => 'nullable|image|max:10240',
                'slides' => 'nullable|array|max:5',
                'slides.*.caption' => 'nullable|string|max:255',
                'slides.*.file' => 'nullable|image|max:10240'
            ]);

            $iconPath = null;
            if ($request->hasFile('icon_sakramen')) {
                $iconPath = $request->file('icon_sakramen')->store('IconSakramen', 'public');
            }

            $slideArray = [];
            if ($request->slides) {
                foreach ($request->slides as $slide) {
                    if (!isset($slide['file'])) continue;
                    $filePath = $slide['file']->store('GambarSakramen', 'public');

                    $slideArray[] = [
                        'caption' => $slide['caption'] ?? '',
                        'file' => $filePath
                    ];
                }
            }

            SakramenModel::create([
                'icon_sakramen' => $iconPath,
                'judul_sakramen' => $request->judul_sakramen,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'kutipan_ayat' => $request->kutipan_ayat,
                'sumber_ayat' => $request->sumber_ayat,
                'deskripsi_lengkap' => $request->deskripsi_lengkap,
                'gambar_slide' => $slideArray
            ]);

            return back()->with('swal_success', 'Sakramen berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->with('swal_error', 'Gagal menambahkan sakramen: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $sakramen = SakramenModel::findOrFail($id);

            $request->validate([
                'judul_sakramen' => 'sometimes|string|max:255',
                'deskripsi_singkat' => 'sometimes|string|max:255',
                'kutipan_ayat' => 'nullable|string',
                'sumber_ayat' => 'nullable|string|max:255',
                'deskripsi_lengkap' => 'nullable|string',
                'icon_sakramen' => 'nullable|image|max:10240',
                'slides' => 'nullable|array|max:5',
                'slides.*.caption' => 'nullable|string|max:255',
                'slides.*.file' => 'nullable|image|max:10240'
            ]);

            if ($request->hasFile('icon_sakramen')) {

                if ($sakramen->icon_sakramen) {
                    Storage::disk('public')->delete($sakramen->icon_sakramen);
                }

                $iconPath = $request->file('icon_sakramen')->store('IconSakramen', 'public');
                $sakramen->icon_sakramen = $iconPath;
            }

            $slides = $sakramen->gambar_slide;
            if (is_string($slides)) {
                $slides = json_decode($slides, true);
            }
            if (!is_array($slides)) {
                $slides = [];
            }

            $newSlides = [];
            
            if ($request->existing_slides) {
                foreach ($request->existing_slides as $index => $filePath) {
                    $newSlides[] = [
                        'file' => $filePath,
                        'caption' => $request->slides[$index]['caption'] ?? ''
                    ];
                }
            }

            if ($request->slides) {
                foreach ($request->slides as $index => $slide) {
                    if (isset($slide['file']) && $request->hasFile("slides.{$index}.file")) {
                        $filePath = $slide['file']->store('GambarSakramen', 'public');
                        $newSlides[] = [
                            'file' => $filePath,
                            'caption' => $slide['caption'] ?? ''
                        ];
                    }
                }
            }

            $newSlides = array_slice($newSlides, 0, 5);

            $sakramen->update([
                'judul_sakramen' => $request->judul_sakramen,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'kutipan_ayat' => $request->kutipan_ayat,
                'sumber_ayat' => $request->sumber_ayat,
                'deskripsi_lengkap' => $request->deskripsi_lengkap,
                'gambar_slide' => $newSlides
            ]);

            return back()->with('swal_success', 'Sakramen berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->with('swal_error', 'Gagal memperbarui sakramen: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sakramen = SakramenModel::findOrFail($id);

            if ($sakramen->icon_sakramen) {
                Storage::disk('public')->delete($sakramen->icon_sakramen);
            }

            if ($sakramen->gambar_slide) {
                foreach ($sakramen->gambar_slide as $g) {
                    Storage::disk('public')->delete($g['file']);
                }
            }

            $sakramen->delete();

            return back()->with('swal_success', 'Sakramen berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('swal_error', 'Gagal menghapus sakramen: ' . $e->getMessage());
        }
    }
}
