<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrCodeModel;
use App\Models\TransferBankModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class AdminDonasiController extends Controller
{
    public function index()
    {
        $transfer = TransferBankModel::all();
        $qrcode = QrCodeModel::all();
        return view('admin.pages.donasi.index', compact('transfer', 'qrcode'));
    }

    public function StoreTransfer(Request $request)
    {
        try{
            $request->validate([
                'nama_bank' => 'required|string|max:255',
                'nomor_rekening' => 'required|string|max:255',
                'atas_nama' => 'required|string|max:255',
                'kode_bank' => 'nullable|string|max:10',
            ]);

            TransferBankModel::create([
                'nama_bank' => $request->nama_bank,
                'nomor_rekening' => $request->nomor_rekening,
                'atas_nama' => $request->atas_nama,
                'kode_bank' => $request->kode_bank,
            ]);

            return redirect()->route('admin.donasi.index')->with('swal_success', 'Transfer Bank berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function EditTransfer(Request $request, $id)
    {
        try{
            $request->validate([
                'nama_bank' => 'sometimes|string|max:255',
                'nomor_rekening' => 'sometimes|string|max:255',
                'atas_nama' => 'sometimes|string|max:255',
                'kode_bank' => 'nullable|string|max:10',
            ]);

            $transfer = TransferBankModel::findOrFail($id);
            $transfer->update([
                'nama_bank' => $request->nama_bank,
                'nomor_rekening' => $request->nomor_rekening,
                'atas_nama' => $request->atas_nama,
                'kode_bank' => $request->kode_bank,
            ]);

            return redirect()->route('admin.donasi.index')->with('swal_success', 'Transfer Bank berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function DestroyTransfer($id)
    {
        try{
            $transfer = TransferBankModel::findOrFail($id);
            $transfer->delete();
            
            return redirect()->route('admin.donasi.index')->with('swal_success', 'Transfer Bank berhasil dihapus');
        }catch(\Exception $e){
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function StoreQrCode(Request $request)
    {
        try {

            $request->validate([
                'qr_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            ]);

            $image = $request->file('qr_img');
            $extension = $image->getClientOriginalExtension();

            $imageName = 'qr-' . time() . '.' . $extension;

            $path = public_path('QrCodesImg');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            $image->move($path, $imageName);

            QrCodeModel::create([
                'qr_img' => 'QrCodesImg/' . $imageName,
            ]);

            return redirect()->route('admin.donasi.index')->with('swal_success', 'QR Code berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal menyimpan QR Code: ' . $e->getMessage());
        }
    }

    public function UpdateQrCode(Request $request, $id)
    {
        try {

            $qr = QrCodeModel::findOrFail($id);

            $request->validate([
                'qr_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            ]);

            if ($request->hasFile('qr_img')) {
                if ($qr->qr_img && File::exists(public_path($qr->qr_img))) {
                    File::delete(public_path($qr->qr_img));
                }

                $image     = $request->file('qr_img');
                $extension = $image->getClientOriginalExtension();

                $imageName = 'qr-code-' . $qr->id . '.' . $extension;

                $path = public_path('QrCodesImg');

                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }

                $image->move($path, $imageName);

                $qr->update([
                    'qr_img' => 'QrCodesImg/' . $imageName,
                ]);
            }

            if ($request->hasFile('qr_img')) {
                // ... logic upload ...
            }
            
            return redirect()->route('admin.donasi.index')->with('swal_success', 'QR Code berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal memperbarui QR Code: ' . $e->getMessage());
        }
    }

    public function DestroyQrCode($id)
    {
        try {

            $qr = QrCodeModel::findOrFail($id);

            if ($qr->qr_img && File::exists(public_path($qr->qr_img))) {
                File::delete(public_path($qr->qr_img));
            }

            $qr->delete();

            return redirect()->route('admin.donasi.index')->with('swal_success', 'QR Code berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->route('admin.donasi.index')->with('swal_error', 'Gagal menghapus QR Code: ' . $e->getMessage());
        }
    }
}
