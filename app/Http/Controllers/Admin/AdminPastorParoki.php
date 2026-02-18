<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PastorModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPastorParoki extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        $query = PastorModel::query();

        if ($request->filled('search')) {
            $query->where('nama_pastor', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->get();
        $activePastorParoki = PastorModel::where('status', 1)
                              ->where('jabatan', 'LIKE', '%pastor paroki%')
                              ->first();
        
        return view('admin.pages.paroki.index', compact('data', 'tab', 'activePastorParoki'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pastor' => 'required|string|max:255',
            'jabatan' => 'required_if:status,1|nullable|string|max:255',
            'status' => 'required|boolean',
            'tahun_selesai' => 'required_if:status,0|nullable|numeric',
        ]);

        try{
            $existingName = PastorModel::where('nama_pastor', $request->nama_pastor)->exists();
            if ($existingName) {
                return redirect()->back()->withErrors(['nama_pastor' => 'Nama pastor ini sudah ada di database.'])->withInput();
            }
            $jabatanLower = strtolower(trim($request->jabatan));
            $isPP = str_contains($jabatanLower, 'pastor paroki');

            if ($request->status == 1 && $isPP) {
                $existing = PastorModel::where('status', 1)
                            ->where('jabatan', 'LIKE', '%pastor paroki%')
                            ->exists();
                if ($existing) {
                    return redirect()->back()->withErrors(['jabatan' => 'Sudah ada data Pastor Paroki yang aktif.'])->withInput();
                }
            }

            if ($request->status == 0 && $request->filled('tahun_selesai') && $request->tahun_selesai < $request->tahun_mulai) {
                return redirect()->back()->withErrors(['tahun_selesai' => 'Tahun selesai tidak boleh kurang dari tahun mulai.'])->withInput();
            }

            if ($request->hasFile('foto_pastor')) {
                $file = $request->file('foto_pastor');
                $namaFile = 'foto-pastor-' . $request->nama_pastor . '.png';

                $file->storeAs('public/FotoPastor', $namaFile);
            }
            PastorModel::create([
                'nama_pastor' => $request->nama_pastor,
                'jabatan' => $request->status == 1 ? $request->jabatan : null,
                'status' => $request->status,
                'foto_pastor' => $namaFile ?? null,
                'tahun_mulai' => $request->tahun_mulai,
                'tahun_selesai' => $request->status == 1 ? null : $request->tahun_selesai,
            ]);
            Alert::success('Berhasil', 'Pastor berhasil disimpan.');
            return redirect()->route('admin.paroki.index')->with('swal_success', 'Pastor berhasil disimpan');
        }catch(\Exception $e){
            return redirect()->route('admin.paroki.index')->with('swal_error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pastor' => 'sometimes|required|string|max:255',
            'jabatan' => 'sometimes|required_if:status,1|nullable|string|max:255',
            'status' => 'sometimes|required|boolean',
            'foto_pastor' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'tahun_mulai' => 'sometimes|required|numeric',
            'tahun_selesai' => 'sometimes|required_if:status,0|nullable|numeric',
        ]);

        try{
            if ($request->has('nama_pastor')) {
                $existingName = PastorModel::where('nama_pastor', $request->nama_pastor)
                                ->where('id', '!=', $id)
                                ->exists();
                if ($existingName) {
                    return redirect()->back()->withErrors(['nama_pastor' => 'Nama pastor ini sudah ada di database.'])->withInput();
                }
            }
            $pastor = PastorModel::findOrFail($id);

            if ($request->hasFile('foto_pastor')) {
                $file = $request->file('foto_pastor');
                $namaFile = 'foto-pastor-' . $request->nama_pastor . '.png';

                $file->storeAs('public/FotoPastor', $namaFile);

                $pastor->foto_pastor = $namaFile;
            } elseif ($request->remove_foto == "1") {
                if ($pastor->foto_pastor && \Storage::exists('public/FotoPastor/' . $pastor->foto_pastor)) {
                    \Storage::delete('public/FotoPastor/' . $pastor->foto_pastor);
                }
                $pastor->foto_pastor = null;
            }

            $pastor->nama_pastor = $request->nama_pastor ?? $pastor->nama_pastor;
            $pastor->status = $request->has('status') ? $request->status : $pastor->status;
            $pastor->jabatan = $pastor->status == 1 ? ($request->jabatan ?? $pastor->jabatan) : null;
            $pastor->tahun_mulai = $request->tahun_mulai ?? $pastor->tahun_mulai;
            $pastor->tahun_selesai = $pastor->status == 1 ? null : ($request->tahun_selesai ?? $pastor->tahun_selesai);

            $jabatanLower = strtolower(trim($pastor->jabatan));
            $isPP = str_contains($jabatanLower, 'pastor paroki');

            if ($pastor->status == 1 && $isPP) {
                $existing = PastorModel::where('status', 1)
                            ->where('jabatan', 'LIKE', '%pastor paroki%')
                            ->where('id', '!=', $id)
                            ->exists();
                if ($existing) {
                    return redirect()->back()->withErrors(['jabatan' => 'Sudah ada data Pastor Paroki yang aktif.'])->withInput();
                }
            }

            $updatedStatus = $request->has('status') ? $request->status : $pastor->status;
            $updatedMulai = $request->tahun_mulai ?? $pastor->tahun_mulai;
            $updatedSelesai = $request->tahun_selesai ?? $pastor->tahun_selesai;

            if ($updatedStatus == 0 && !empty($updatedSelesai) && $updatedSelesai < $updatedMulai) {
                return redirect()->back()->withErrors(['tahun_selesai' => 'Tahun selesai tidak boleh kurang dari tahun mulai.'])->withInput();
            }

            $pastor->save();

            return redirect()->route('admin.paroki.index')->with('swal_success', 'Pastor berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->route('admin.paroki.index')->with('swal_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $pastor = PastorModel::findOrFail($id);
            $pastor->delete();

            return redirect()->route('admin.paroki.index')->with('swal_success', 'Data pastor paroki berhasil dihapus');
        }catch(\Exception $e){
            return redirect()->route('admin.paroki.index')->with('swal_error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }   
}
