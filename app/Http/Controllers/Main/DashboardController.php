<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('status', '1')->get();
        $data = [];
        foreach($pengumuman as $pengumuman) {
            $data[] = [
                'judul' => $pengumuman->judul,
                'isi' => $pengumuman->isi,
                'bulan' => $pengumuman->created_at->format('F'),
                'tahun' => $pengumuman->created_at->format('Y'),
            ];
        }
        return view('main.dashboard.index', compact('data'));
    }
}
