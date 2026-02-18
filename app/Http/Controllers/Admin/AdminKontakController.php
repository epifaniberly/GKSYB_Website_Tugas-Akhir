<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamPelayananModel;
use App\Models\KontakModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKontakController extends Controller
{
    public function store(Request $request)
    {
        try{
            KontakModel::updateOrCreate(
                ['id' => $request->id],
                $request->only('alamat','telepon','whatsapp','email')
            );
        

            return redirect()->back()->with('swal_success', 'Data kontak berhasil disimpan.');
        }catch(\Exception $e){
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan saat menyimpan data kontak.');
        }
    }

    public function storeJam(Request $request)
    {
        try {
            $kontak = KontakModel::first();
            
            if (!$kontak) {
                $kontak = KontakModel::create([
                    'alamat' => 'Alamat belum diatur',
                    'telepon' => '',
                    'whatsapp' => '',
                    'email' => ''
                ]);
            }

            $data = $request->all();
            $data['kontak_id'] = $kontak->id;

            JamPelayananModel::create($data);
            
            return redirect()->back()->with('swal_success', 'Jam pelayanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateJam(Request $request, $id)
    {
        $jam = JamPelayananModel::findOrFail($id);

        $jam->update(array_filter($request->only([
            'hari_dari','hari_sampai','jam_mulai','jam_selesai'
        ])));

        return back()->with('swal_success', 'Jam pelayanan diperbarui.');
    }

    public function destroyJam($id)
    {
        JamPelayananModel::findOrFail($id)->delete();
        return redirect()->back()->with('swal_success', 'Jam pelayanan berhasil dihapus.');
    }
}
