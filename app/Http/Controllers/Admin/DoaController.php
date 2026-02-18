<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoaModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DoaController extends Controller
{
    public function index(Request $request)
    {
        $query = DoaModel::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('isi_doa', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        $total = DoaModel::count();
        $didoakan = DoaModel::where('status', 'didoakan')->count();
        $belum = DoaModel::where('status', 'belum')->count();

        return view('admin.pages.doa.index', compact(
            'data',
            'total',
            'didoakan',
            'belum'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $request->validate([
                'status' => 'required|in:baru,didoakan,belum',
            ]);

            $doa = DoaModel::findOrFail($id);
            $doa->status = $request->status;
            $doa->save();

            return redirect()->route('admin.doa.index')->with('swal_success', 'Status doa berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->route('admin.doa.index')->with('swal_error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $doa = DoaModel::findOrFail($id);
            $doa->delete();

            return redirect()->route('admin.doa.index')->with('swal_success', 'Pesan doa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.doa.index')->with('swal_error', 'Gagal menghapus pesan: ' . $e->getMessage());
        }
    }
}
