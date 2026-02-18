<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdentitasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class identitasController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_website' => 'required',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $logoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')
                    ->store('IdentitasFolder', 'public');
            }

            IdentitasModel::create([
                'nama_website' => $request->nama_website,
                'logo' => $logoPath
            ]);


            return redirect()->back()->with('swal_success', 'Identitas berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_website' => 'required',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $identitas = IdentitasModel::findOrFail($id);

            $logoPath = $identitas->logo;

            if ($request->hasFile('logo')) {

                if ($identitas->logo) {
                    Storage::disk('public')->delete($identitas->logo);
                }

                $logoPath = $request->file('logo')
                    ->store('IdentitasFolder', 'public');
            }

            $identitas->update([
                'nama_website' => $request->nama_website,
                'logo' => $logoPath
            ]);

            return redirect()->back()->with('swal_success', 'Identitas berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $identitas = IdentitasModel::findOrFail($id);

            if ($identitas->logo) {
                Storage::disk('public')->delete($identitas->logo);
            }

            $identitas->delete();

            return redirect()->back()->with('swal_success', 'Identitas berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
