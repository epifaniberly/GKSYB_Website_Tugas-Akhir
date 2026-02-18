<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqModel;
use App\Models\KategoriFaqModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function index(Request $request, $tab = 'semua')
    {
        $tab = $request->query('tab', $tab);
        $query = FaqModel::with('kategoriFaq');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('pertanyaan', 'like', '%' . $request->search . '%')
                  ->orWhere('jawaban', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->kategori) {
            $query->where('kategori_faq_id', $request->kategori);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $faq = $query->latest()->get();

        if ($request->ajax()) {
            return view('admin.pages.faq.components.list', compact('faq'))->render();
        }

        $kategori = KategoriFaqModel::all();
        return view('admin.pages.faq.index', compact('faq', 'kategori', 'tab'));
    }

    public function storeKategori(Request $request)
    {
        try{
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            KategoriFaqModel::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()->route('admin.faq.index')->with('swal_success', 'Kategori FAQ berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal menyimpan kategori: ' . $e->getMessage());
        }
    }

    public function updateKategori(Request $request, $id)
    {
        try{
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $kategori = KategoriFaqModel::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()->route('admin.faq.index')->with('swal_success', 'Kategori FAQ berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function destroyKategori($id)
    {
        try{
            $kategori = KategoriFaqModel::findOrFail($id);
            
            if($kategori->faqs()->count() > 0){
                return redirect()->route('admin.faq.index')->with('swal_error', 'Kategori tidak bisa dihapus karena masih digunakan oleh ' . $kategori->faqs()->count() . ' pertanyaan (FAQ)');
            }

            $kategori->delete();

            return redirect()->route('admin.faq.index')->with('swal_success', 'Kategori FAQ berhasil dihapus');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    public function storeFaq(Request $request)
    {
        try{
            $request->validate([
                'kategori_faq_id' => 'required|exists:kategori_faq,id',
                'pertanyaan' => 'required|string',
                'jawaban' => 'required|string',
                'is_active' => 'required|boolean',
            ]);

            FaqModel::create([
                'kategori_faq_id' => $request->kategori_faq_id,
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('admin.faq.index')->with('swal_success', 'FAQ berhasil ditambahkan');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal menyimpan FAQ: ' . $e->getMessage());
        }
    }

    public function updateFaq(Request $request, $id)
    {
        try{
            $request->validate([
                'kategori_faq_id' => 'nullable|exists:kategori_faq,id',
                'pertanyaan' => 'nullable|string',
                'jawaban' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ]);

            $faq = FaqModel::findOrFail($id);
            $faq->update([
                'kategori_faq_id' => $request->kategori_faq_id ?? $faq->kategori_faq_id,
                'pertanyaan'      => $request->pertanyaan ?? $faq->pertanyaan,
                'jawaban'         => $request->jawaban ?? $faq->jawaban,
                'is_active'       => $request->is_active ?? $faq->is_active,
            ]);

            return redirect()->route('admin.faq.index')->with('swal_success', 'FAQ berhasil diperbarui');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal memperbarui FAQ: ' . $e->getMessage());
        }
    }

    public function destroyFaq($id)
    {
        try{
            $faq = FaqModel::findOrFail($id);
            $faq->delete();

            return redirect()->route('admin.faq.index')->with('swal_success', 'FAQ berhasil dihapus');
        }catch(\Exception $e){
            return redirect()->route('admin.faq.index')->with('swal_error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }
}
