<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPanduanController extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        $query = PanduanModel::query();

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('jenis_misa', 'like', '%' . $request->keyword . '%')
                  ->orWhere('perayaan', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_publish', $request->status);
        }

        $ekaristi = $query->latest()->get();

        if ($request->ajax()) {
            return view('admin.pages.panduan.components.list', compact('ekaristi'))->render();
        }

        return view('admin.pages.panduan.index', compact('ekaristi', 'tab'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_misa' => 'required|string|max:255',
            'perayaan'   => 'nullable|string|max:255',
            'ayat_alkitab' => 'nullable|string',
            'sumber_ayat' => 'nullable|string|max:255',
            'file' => 'required|mimes:pdf|max:10240', 
        ]);

        try {
            $ekaristi = PanduanModel::create([
                'jenis_misa' => $request->jenis_misa,
                'perayaan' => $request->perayaan,
                'ket_perayaan' => $request->ket_perayaan,
                'ayat_alkitab' => $request->ayat_alkitab,
                'sumber_ayat' => $request->sumber_ayat,
                'tanggal' => $request->tipe_tanggal === 'tunggal' ? $request->tanggal : null,
                'tanggal_mulai' => $request->tipe_tanggal === 'rentang' ? $request->tanggal_mulai : null,
                'tanggal_akhir' => $request->tipe_tanggal === 'rentang' ? $request->tanggal_akhir : null,
                'is_publish' => $request->is_publish ?? 0,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $namaFile = 'panduan-' . time() . '-' . $ekaristi->id . '.pdf';
                $originalName = $file->getClientOriginalName();

                $file->storeAs('public/PanduanFile', $namaFile);

                $ekaristi->update([
                    'file' => $namaFile,
                    'original_filename' => $originalName
                ]);
            }

            return back()->with('swal_success', 'Panduan Ekaristi berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_misa'    => 'sometimes|required|string|max:255',
            'perayaan'      => 'nullable|string|max:255',
            'ket_perayaan'  => 'sometimes|nullable|string',
            'ayat_alkitab'  => 'nullable|string',
            'sumber_ayat'   => 'nullable|string|max:255',

            'tipe_tanggal' => 'required|in:tunggal,rentang',

            'tanggal'       => 'sometimes|required_if:tipe_tanggal,tunggal|date',
            'tanggal_mulai' => 'sometimes|required_if:tipe_tanggal,rentang|date',
            'tanggal_akhir' => 'sometimes|required_if:tipe_tanggal,rentang|date|after_or_equal:tanggal_mulai',

            'is_publish'    => 'sometimes|boolean',

            'file'          => 'sometimes|file|mimes:pdf|max:51200',
        ]);

        $data = PanduanModel::findOrFail($id);

        try {
            $updateData = [];

            if ($request->has('jenis_misa')) {
                $updateData['jenis_misa'] = $request->jenis_misa;
            }

            if ($request->has('perayaan')) {
                $updateData['perayaan'] = $request->perayaan;
            }

            if ($request->has('ket_perayaan')) {
                $updateData['ket_perayaan'] = $request->ket_perayaan;
            }

            if ($request->has('ayat_alkitab')) {
                $updateData['ayat_alkitab'] = $request->ayat_alkitab;
            }

            if ($request->has('sumber_ayat')) {
                $updateData['sumber_ayat'] = $request->sumber_ayat;
            }

           if ($request->tipe_tanggal === 'tunggal') {
                $updateData['tanggal'] = $request->tanggal;
                $updateData['tanggal_mulai'] = null;
                $updateData['tanggal_akhir'] = null;

            } else {

                $updateData['tanggal'] = null;
                $updateData['tanggal_mulai'] = $request->tanggal_mulai;
                $updateData['tanggal_akhir'] = $request->tanggal_akhir;

            }

            if ($request->has('is_publish')) {
                $updateData['is_publish'] = $request->is_publish ?? 0;
            }

            if (!empty($updateData)) {
                $data->update($updateData);
            }

            if ($request->hasFile('file')) {

                if (
                    $data->file &&
                    Storage::exists('public/PanduanFile/' . $data->file)
                ) {
                    Storage::delete('public/PanduanFile/' . $data->file);
                }

                $file = $request->file('file');
                $namaFile = 'panduan-' . time() . '-' . $data->id . '.pdf';
                $originalName = $file->getClientOriginalName();

                $file->storeAs('public/PanduanFile', $namaFile);

                $data->update([
                    'file' => $namaFile,
                    'original_filename' => $originalName
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Panduan Ekaristi berhasil diperbarui'
                ]);
            }

            return back()->with('swal_success', 'Panduan Ekaristi berhasil diperbarui');

        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->with('swal_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = PanduanModel::findOrFail($id);

            if ($data->file && Storage::exists('public/PanduanFile/' . $data->file)) {
                Storage::delete('public/PanduanFile/' . $data->file);
            }

            $data->delete();

            return back()->with('swal_success', 'Panduan Ekaristi berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('swal_error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        $data = PanduanModel::findOrFail($id);

        $path = storage_path('app/public/PanduanFile/' . $data->file);
        $size = filesize($path);

        if ($data->original_filename) {
            $nama = $data->original_filename;
        } else {
            $nama = 'dokumen-panduan-' .
                str_replace(' ', '-', strtolower($data->jenis_misa)) .
                ' (' . round($size / 1024 / 1024, 2) . ' MB).pdf';
        }

        return response()->download($path, $nama);
    }

}
