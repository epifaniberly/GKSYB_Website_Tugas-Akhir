<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoaModel;
use App\Models\JadwalDoa;
use App\Models\TerhubungModel;
use App\Models\TulisanBintaranModel;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $statsBintaran = $this->calculateStats(TulisanBintaranModel::class, ['is_published' => 1]);
        $totalBintaran = $statsBintaran['total'];
        $percentBintaran = $statsBintaran['percent'];

        $statsKegiatan = $this->calculateStats(JadwalDoa::class, ['is_active' => 1]);
        $totalKegiatan = $statsKegiatan['total'];
        $percentKegiatan = $statsKegiatan['percent'];
        $statsTerhubung = $this->calculateStats(TerhubungModel::class, []);
        $totalTerhubung = $statsTerhubung['total'];
        $percentTerhubung = $statsTerhubung['percent'];

        $statsDoa = $this->calculateStats(DoaModel::class, []);
        $totalDoa = $statsDoa['total'];
        $percentDoa = $statsDoa['percent'];

        $totalDraftBintaran = TulisanBintaranModel::where('is_published', 0)->count();

        $terhubungTerbaru = TerhubungModel::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $bintaranTerbaru = TulisanBintaranModel::with('kategoriBintaran')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.pages.dashboard.index', compact(
            'totalBintaran', 'percentBintaran',
            'totalKegiatan', 'percentKegiatan',
            'totalTerhubung', 'percentTerhubung',
            'totalDoa', 'percentDoa',
            'totalDraftBintaran',
            'terhubungTerbaru',
            'bintaranTerbaru'
        ));
    }

    private function calculateStats($model, $conditions = [])
    {
        $now = \Carbon\Carbon::now();
        
        $total = $model::where($conditions)->count();

        $currentMonthCount = $model::where($conditions)
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonthDate = $now->copy()->subMonth();
        $lastMonthCount = $model::where($conditions)
            ->whereMonth('created_at', $lastMonthDate->month)
            ->whereYear('created_at', $lastMonthDate->year)
            ->count();

        if ($lastMonthCount == 0) {
            $percent = $currentMonthCount > 0 ? 100 : 0;
        } else {
            $percent = (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100;
        }

        return [
            'total' => $total,
            'percent' => round($percent, 1)
        ];
    }
}
