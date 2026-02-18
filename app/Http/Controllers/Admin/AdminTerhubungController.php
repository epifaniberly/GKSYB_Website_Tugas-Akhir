<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TerhubungModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTerhubungController extends Controller
{
    public function index(Request $request)
    {
        $query = TerhubungModel::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request){
                $q->where('email','like','%'.$request->search.'%')
                ->orWhere('isi_pesan','like','%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('tanggal_kirim', 'desc')->get();

        $total    = TerhubungModel::count();
        $baru     = TerhubungModel::where('status','baru')->count();
        $dibaca   = TerhubungModel::where('status','diterima')->count();
        $tindak   = TerhubungModel::where('status','gagal')->count();

        return view('admin.pages.terhubung.index', compact(
            'data', 'total', 'baru', 'dibaca', 'tindak'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        try{
            $request->validate([
                'status' => 'required|in:baru,diterima,gagal',
            ]);

            $terhubung = TerhubungModel::findOrFail($id);
            $terhubung->status = $request->status;
            $terhubung->save();
            
            return redirect()->route('admin.terhubung.index')->with('swal_success', 'Status pesan berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->route('admin.terhubung.index')->with('swal_error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $terhubung = TerhubungModel::findOrFail($id);
            $terhubung->delete();
            return redirect()->route('admin.terhubung.index')->with('swal_success', 'Pesan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.terhubung.index')->with('swal_error', 'Gagal menghapus pesan: ' . $e->getMessage());
        }
    }
}
