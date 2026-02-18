<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdentitasModel;
use App\Models\KontakModel;
use App\Models\SeoModel;
use App\Models\SosmedModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request, $tab = 'identitas')
    {
        $tab = $request->query('tab', $tab);
        $identitas = IdentitasModel::first();
        $kontak = KontakModel::with('jamPelayanan')->first();
        $medsos = SosmedModel::first();
        $seo = SeoModel::first();
        return view('admin.pages.settings.index', compact('identitas', 'kontak','medsos', 'seo', 'tab'));
    }
}
