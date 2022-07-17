<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KandidatRequest;
use App\Models\Jabatan;
use App\Models\Kandidat;
use App\Models\Pemilu;
use App\Models\User;
use Illuminate\Http\Request;

class KandidatController extends Controller
{
    public function index()
    {
        return view('main.kandidat.index');
    }

    public function render()
    {
        $pemilu = Pemilu::where('status', true)->pluck('id_pemilu')->toArray();
        if(count($pemilu) > 0) {
            // $data = Kandidat::whereIn('id_pemilu', $pemilu)->get();
            $kandidat = Kandidat::where('id_pemilu', $pemilu)->get();
        } else {
            $kandidat = [];
        }
        $view = [
            'data' => view('main.kandidat.render', compact('kandidat'))->render(),
        ];

        return response()->json($view);
    }

    public function detailKandidat($id_user)
    {
        $user = User::find($id_user);
        return response()->json($user);
    }

    public function create()
    {
        $jabatan = Jabatan::where('nama_jabatan', '!=', 'Admin')->pluck('id_jabatan');
        $kandidat = User::where('is_active', '1')->whereIn('id_jabatan', $jabatan)->pluck('nama', 'id_user')->prepend('Pilih Kandidat', '');
        $pemilu = Pemilu::where('status', true)->get();
        $view = [
            'data' => view('main.kandidat.create', compact('kandidat', 'pemilu'))->render(),
        ];

        return response()->json($view);
    }
    
    public function store(KandidatRequest $request)
    {
        try {
            $kandidat = Kandidat::where('id_pemilu', $request->tanggal_pemilu)->pluck('id_user')->toArray();
            $data = [
                'id_pemilu' => $request->tanggal_pemilu,
                'id_user' => $request->nama,
            ];

            $visiMisi = [];

            $visiMisi['visi'] = $request->visi;
            for($i = 0; $i < count($request->misi); $i++) {
                $visiMisi['misi'][$i] = [
                    'id_misi' => $i+1,
                    'misi' => $request->misi[$i],
                ];
            }
            // dd($visiMisi);

            $data['visi_misi'] = json_encode($visiMisi);

            if(!in_array($request->nama, $kandidat)) {
                Kandidat::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Kandidat berhasil ditambahkan',
                    'title' => 'Berhasil'
                ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Kandidat pada Pemilu ini sudah terdata',
                    'title' => 'Info'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kandidat gagal ditambahkan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete($id_kandidat)
    {
        try {
            $kandidat = Kandidat::find($id_kandidat);
            $kandidat->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal dihapus',
                'title' => 'Gagal'
            ]);
        }
    }
}
