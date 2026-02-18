<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenModel;
use App\Models\KategoriDokumenModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DokParokiController extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        $kategori = KategoriDokumenModel::all();
        $query = DokumenModel::with('kategori');

        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        if ($request->filled('keyword')) {
            $query->where('judul_dokumen', 'like', '%' . $request->keyword . '%');
        }

        $dokumen = $query->latest()->get();

        if ($request->ajax()) {
            return view('admin.pages.dokparoki.components.list', compact('dokumen'))->render();
        }

        return view('admin.pages.dokparoki.index', compact('kategori','dokumen', 'tab'));
    }

    public function download($id)
    {
        $dok = DokumenModel::findOrFail($id);
        $path = storage_path('app/public/DokParoki/' . $dok->file);

        if (!file_exists($path)) {
            Alert::error('Gagal', 'File tidak ditemukan di server');
            return back();
        }

        $namaDownload = $dok->original_filename ?? ($dok->judul_dokumen . '.pdf');
        return response()->download($path, $namaDownload);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_dokumen' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|string|max:255',
            'keterangan' => 'nullable',
            'file' => 'nullable|mimes:pdf,doc,docx|max:51200'
        ]);

        try {
            $dok = DokumenModel::findOrFail($id);

            if ($request->hasFile('file')) {
                if ($dok->file && $dok->file !== '-') {
                    $oldPath = storage_path('app/public/DokParoki/' . $dok->file);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $namaFile = 'dokumen-' . time() . '-' . $dok->id . '.' . $extension;
                $originalFilename = $file->getClientOriginalName();
                $file->storeAs('public/DokParoki', $namaFile);
                $dok->file = $namaFile;
                $dok->original_filename = $originalFilename;
            }

            $dok->update([
                'judul_dokumen' => $request->judul_dokumen,
                'kategori_id' => $request->kategori_id,
                'keterangan' => $request->keterangan,
                'is_active' => $request->is_active ?? 1,
                'file' => $dok->file, 
                'original_filename' => $dok->original_filename
            ]);

            return back()->with('swal_success', 'Dokumen Paroki berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $dok = DokumenModel::findOrFail($id);

            @unlink(storage_path('app/public/DokParoki/' . $dok->file));

            $dok->delete();

            return back()->with('swal_success', 'Dokumen Paroki berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menghapus dokumen: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori_id' => 'required',
            'keterangan' => 'nullable|string|max:500',
            'file' => 'required|mimes:pdf,doc,docx|max:51200'
        ]);

        try {
            $dok = DokumenModel::create([
                'judul_dokumen' => $request->judul_dokumen,
                'kategori_id' => $request->kategori_id,
                'keterangan' => $request->keterangan,
                'is_active' => $request->is_active ?? 1,
                'file' => '-'
            ]);
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $namaFile = 'dokumen-' . time() . '-' . $dok->id . '.' . $extension;
            $originalName = $file->getClientOriginalName();
            $file->storeAs('public/DokParoki', $namaFile);
            
            $dok->update([
                'file' => $namaFile,
                'original_filename' => $originalName
            ]);

            return back()->with('swal_success', 'Dokumen Paroki berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menambahkan dokumen: ' . $e->getMessage());
        }
    }
}
