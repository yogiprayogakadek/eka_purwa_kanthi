<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\RapatRequest;
use App\Models\Rapat;
use App\Models\User;
use Illuminate\Http\Request;

class RapatController extends Controller
{
    public function index()
    {
        return view('main.rapat.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.rapat.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $data = Rapat::all();

        $view = [
            'data' => view('main.rapat.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(RapatRequest $request)
    {
        try {
            $data = [
                'perihal_rapat' => $request->perihal_rapat,
                'tanggal_rapat' => $request->tanggal_rapat,
                'tempat_rapat' => $request->tempat_rapat,
                'pimpinan_rapat' => $request->pimpinan_rapat,
            ];

            Rapat::create($data);

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
        $data = Rapat::find($id);
        $view = [
            'data' => view('main.rapat.edit', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function update(RapatRequest $request)
    {
        try {
            $rapat = Rapat::find($request->id_rapat);
            $data = [
                'perihal_rapat' => $request->perihal_rapat,
                'tanggal_rapat' => $request->tanggal_rapat,
                'tempat_rapat' => $request->tempat_rapat,
                'pimpinan_rapat' => $request->pimpinan_rapat,
            ];


            $rapat->update($data);

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

    public function notulen(Request $request)
    {
        try {
            $rapat = Rapat::find($request->id_rapat);

            $rapat->update([
                'notulen' => $request->notulen,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Notulen berhasil disimpan',
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Notulen gagal disimpan',
                'title' => 'Gagal',
            ]);
        }
    }

    public function absensi($id_rapat)
    {
        $rapat = Rapat::find($id_rapat);
        $anggota = User::where('is_active', 1)->get();

        $peserta = [];
        if($rapat->peserta != null) {
            foreach(json_decode($rapat->peserta_rapat) as $key => $value) {
                $peserta[] = [
                    'id_user' => $value->id_user,
                    'kehadiran' => $value->kehadiran,
                ];
            }
        }
        $view = [
            'data' => view('main.rapat.absen.index', compact('rapat', 'anggota', 'peserta'))->render(),
        ];

        return response()->json($view);
    }
}
