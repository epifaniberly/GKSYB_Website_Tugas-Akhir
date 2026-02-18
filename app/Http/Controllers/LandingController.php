<?php

namespace App\Http\Controllers;

use App\Models\DoaModel;
use App\Models\FaqModel;
use App\Models\IdentitasModel;
use App\Models\JadwalDoa;
use App\Models\KategoriFaqModel;
use App\Models\SakramenModel;
use App\Models\TerhubungModel;
use App\Models\TulisanBintaranModel;
use App\Models\DokumenModel;
use App\Models\KategoriDokumenModel;
use Carbon\Carbon;
use App\Models\KategoriBintaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class LandingController extends Controller
{
    public function index()
    {
        $data = IdentitasModel::first();
        $jadwal = JadwalDoa::with('kategoriJadwal')->get(); 
        $bintaran = TulisanBintaranModel::with('kategoriBintaran')->where('is_published', true)->latest()->take(4)->get();
        $agendas = TulisanBintaranModel::with('kategoriBintaran')
            ->where('is_published', true)
            ->whereHas('kategoriBintaran', function($q) {
                $q->where('nama_kategori', 'like', '%Agenda%');
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $romoKepala = \App\Models\PastorModel::where('status', 1)
            ->where(function($q) {
                $q->where('jabatan', 'LIKE', '%Pastor Paroki%')
                  ->orWhere('jabatan', 'LIKE', '%Romo Paroki%');
            })
            ->first();

        $profil = \App\Models\TilikSejarahModel::first();
        
        $kategori_jadwal = \App\Models\KategoriJadwal::all();

        return view('landing.index', compact('data', 'jadwal', 'bintaran', 'agendas', 'romoKepala', 'profil', 'kategori_jadwal'));
    }

    public function sejarah()
    {
        $profil = \App\Models\TilikSejarahModel::first();
        return view('landing.sejarah', compact('profil'));
    }

    public function gembala()
    {
        $aktif = \App\Models\PastorModel::where('status', 1)->get();
        $past = \App\Models\PastorModel::where('status', 0)->orderBy('tahun_mulai', 'desc')->get();
        return view('landing.gembala', compact('aktif', 'past'));
    }

    public function doa()
    {
        $jadwal = JadwalDoa::with('kategoriJadwal')->get();
        $kategori_jadwal = \App\Models\KategoriJadwal::all();
        return view('landing.doa', compact('jadwal', 'kategori_jadwal'));
    }

    public function sakramen()
    {
        $data = SakramenModel::limit(7)->get();
        return view('landing.sakramen', compact('data'));
    }

    public function detailSakramen($id)
    {
        $sakramen = SakramenModel::findOrFail($id);

        return view('landing.detail.sakramen', compact('sakramen'));
    }

    public function tulisan(Request $request)
    {
        $search = $request->query('search');
        $categorySlug = $request->query('category');

        $latestArticles = TulisanBintaranModel::with('kategoriBintaran')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $agendas = TulisanBintaranModel::with('kategoriBintaran')
            ->where('is_published', true)
            ->whereHas('kategoriBintaran', function($q) {
                $q->where('nama_kategori', 'like', '%Agenda%');
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $categories = KategoriBintaranModel::all();
        $selectedCategory = $categorySlug ? KategoriBintaranModel::where('slug', $categorySlug)->first() : null;

        $query = TulisanBintaranModel::with('kategoriBintaran')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('judul_tulisan', 'like', '%' . $search . '%');
        }

        if ($selectedCategory) {
            $query->where('kategori_bintaran_id', $selectedCategory->id);
        }

        $allArticles = $query->paginate(6)->withQueryString();

        if ($request->ajax()) {
            return view('partials.tulisan.article-grid', compact('allArticles'));
        }

        return view('landing.tulisan', compact('latestArticles', 'agendas', 'categories', 'selectedCategory', 'allArticles', 'search'));
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function storeContact(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap'       => 'required|string|max:255',
                'email'      => 'required|email',
                'nomor_telepon'      => 'required|string|max:20',
                'asal_paroki'     => 'nullable|string|max:255',
                'asal_lingkungan' => 'nullable|string|max:255',
                'isi_pesan'    => 'required|string|max:1000',
            ]);

            $contact = TerhubungModel::create([
                'user_id'          => 3,
                'nama_lengkap'     => $request->nama_lengkap,
                'email'            => $request->email,
                'nomor_telepon'    => $request->nomor_telepon,
                'asal_paroki'      => $request->asal_paroki,
                'asal_lingkungan'  => $request->asal_lingkungan,
                'isi_pesan'        => $request->isi_pesan,
                'tanggal_kirim'    => now(),
                'status'           => 'baru',
            ]);

            Mail::send('emails.notification', [
                'title' => 'Pesan Baru dari Paroki Bintaran',
                'contact' => $contact
            ], function ($mail) use ($contact) {
                $mail->to('parokistyusupbintaran@gmail.com')
                    ->replyTo($contact->email, $contact->nama_lengkap)
                    ->subject('Pesan Baru dari Paroki Bintaran');
            });

            return back()->with('swal_success', 'Pesan Anda berhasil dikirim');

        } catch (\Exception $e) {
            return back()->withInput()->with('swal_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function ssd(Request $request)
    {
        $search = $request->query('search');
        $kategori = KategoriFaqModel::all();

        $query = FaqModel::with('kategoriFaq')->where('is_active', 1);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                  ->orWhere('jawaban', 'like', "%{$search}%");
            });
        }

        $faq = $query->get()
                ->groupBy(function ($item) {
                    return $item->kategoriFaq ? strtolower($item->kategoriFaq->nama_kategori) : 'umum';
                });

        return view('landing.ssd', compact('kategori', 'faq', 'search'));
    }

    public function donasi()
    {
        $bank = \App\Models\TransferBankModel::all();
        $qrcode = \App\Models\QrCodeModel::first();
        $profil = \App\Models\TilikSejarahModel::first();
        return view('landing.donasi', compact('bank', 'qrcode', 'profil'));
    }

    public function dokumen()
    {
        $kategori = KategoriDokumenModel::with('dokumen')->get();
        return view('landing.dokumen', compact('kategori'));
    }

    public function downloadDokumen($id)
    {
        $dok = DokumenModel::findOrFail($id);
        $path = storage_path('app/public/DokParoki/' . $dok->file);
        
        if (file_exists($path)) {
            $namaDownload = $dok->original_filename ?? ($dok->judul_dokumen . '.pdf');
            return response()->download($path, $namaDownload);
        }

        return back()->with('swal_error', 'File tidak ditemukan');
    }

    public function ujud()
    {
        return view('landing.ujud');
    }

    public function storeUjud(Request $request)
    {
        try {

            $request->validate([
                'nama'            => 'required|string|max:100',
                'nomor_telepon'   => 'required|string|max:20',
                'asal_paroki'     => 'required|string|max:100',
                'asal_lingkungan' => 'nullable|string|max:100',
                'jenis_permohonan'=> 'required|string|max:100',
                'jadwal_misa'     => 'required|string|max:100',
                'tanggal_intensi' => 'required|date',
                'isi_doa'         => 'required|string',
            ]);

        $doa = DoaModel::create([
            'nama'            => $request->nama,
            'nomor_telepon'   => $request->nomor_telepon,
            'asal_paroki'     => $request->asal_paroki,
            'asal_lingkungan' => $request->asal_lingkungan,
            'jenis_permohonan'=> $request->jenis_permohonan,
            'jadwal_misa'     => $request->jadwal_misa,
            'tanggal_intensi' => $request->tanggal_intensi,
            'isi_doa'         => $request->isi_doa,
            'tanggal_doa' => now(),
            'status'      => 'baru',
        ]);

            Mail::send('emails.ujud_notification', [
                'title' => 'Permohonan Intensi Doa Baru',
                'doa' => $doa
            ], function ($mail) use ($doa) {
                $mail->to('parokistyusupbintaran@gmail.com')
                    ->subject('Permohonan Intensi Doa Baru: ' . $doa->nama);
            });

            return back()->with('swal_success', 'Permohonan doa berhasil dikirim, terimakasih');

        } catch (\Exception $e) {
            return back()->withInput()->with('swal_error', $e->getMessage());

        }
    }

    public function detailTulisan($id)
    {
        $tulisan = TulisanBintaranModel::with(['kategoriBintaran', 'user', 'images'])->findOrFail($id);
        
        $related = TulisanBintaranModel::where('id', '!=', $id)
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('landing.detail.tulisan', compact('tulisan', 'related'));
    }

    public function panduanPerayaan()
    {
        $panduan = \App\Models\PanduanModel::where('is_publish', true)->orderBy('created_at', 'desc')->get();
        return view('landing.panduan', compact('panduan'));
    }

    public function detailPanduanPerayaan($id)
    {
        $panduan = \App\Models\PanduanModel::findOrFail($id);
        return view('landing.detail.panduan', compact('panduan'));
    }
}
