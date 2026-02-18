<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDoa;
use App\Models\KategoriJadwal;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        
        $kategori = KategoriJadwal::all();
        $query = JadwalDoa::with('kategoriJadwal');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_jadwal', 'LIKE', "%{$search}%");
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_jadwal_id', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $jadwal = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.pages.jadwal.components.list', compact('jadwal'))->render();
        }

        return view('admin.pages.jadwal.index', compact('kategori', 'jadwal', 'tab'));
    }
}
