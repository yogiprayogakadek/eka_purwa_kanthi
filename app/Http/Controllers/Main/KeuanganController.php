<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeuanganRequest;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('main.keuangan.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.keuangan.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $data = keuangan::all();

        $view = [
            'data' => view('main.keuangan.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(KeuanganRequest $request)
    {
        try {
            $data = [
                'jenis_keuangan' => $request->jenis,
                'tanggal_keuangan' => $request->tanggal,
                'jumlah' => preg_replace('/[^0-9]/', '', $request->jumlah),
                'keterangan' => $request->keterangan,
            ];

            Keuangan::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
                'title' => 'Gagal',
            ]);
        }
    }

    public function edit($id)
    {
        $data = Keuangan::find($id);
        $view = [
            'data' => view('main.keuangan.edit', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function update(KeuanganRequest $request)
    {
        try {
            $keuangan = Keuangan::find($request->id_keuangan);
            $data = [
                'jenis_keuangan' => $request->jenis,
                'tanggal_keuangan' => $request->tanggal,
                'jumlah' => preg_replace('/[^0-9]/', '', $request->jumlah),
                'keterangan' => $request->keterangan,
            ];
            $keuangan->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Perubahan berhasil disimpan',
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Perubahan gagal disimpan',
                'title' => 'Gagal',
            ]);
        }
    }

    // public function changeStatus(Request $request)
    // {
    //     try {
    //         // dd($request->all());
    //         $status = $request->status;
    //         $id_pengumuman = $request->id_pengumuman;
    //         $pengumuman = Pengumuman::find($id_pengumuman);
    //         $pengumuman->update([
    //             'status' => $status
    //         ]);

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Status berhasil di ubah',
    //             'title' => 'Berhasil'
    //         ]);
    //     } catch(\Exception $e){
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Status gagal di ubah',
    //             'title' => 'Gagal'
    //         ]);
    //     }
    // }
}
