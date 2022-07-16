<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnggotaRequest;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('main.anggota.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.anggota.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $jabatan = Jabatan::where('nama_jabatan', 'Anggota')->first();
        $data = User::where('id_jabatan', $jabatan->id_jabatan)->get();

        $view = [
            'data' => view('main.anggota.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(AnggotaRequest $request)
    {
        try {
            // dd($request->all());
            $jabatan = Jabatan::where('nama_jabatan', 'Anggota')->first();
            DB::transaction(function () use ($request, $jabatan) {
                $user = [
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'password' => bcrypt('12345678'),
                    'id_jabatan' => $jabatan->id_jabatan,
                    'is_active' => 1,
                ];

                if($request->hasFile('foto')) {
                    $filenamewithextension = $request->file('foto')->getClientOriginalName();
                    $extension = $request->file('foto')->getClientOriginalExtension();

                    $filenametostore = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $extension;
                    $save_path = 'assets/uploads/users/';

                    if (!file_exists($save_path)) {
                        mkdir($save_path, 666, true);
                    }

                    $user['foto'] = $save_path . $filenametostore;
                }

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(300, 300);
                $img->save($save_path . $filenametostore);

                // save user
                User::create($user);
            });
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

    public function changeStatus(Request $request)
    {
        try {
            // dd($request->all());
            $status = $request->status;
            $id_user = $request->id_user;
            $user = User::find($id_user);
            $user->update([
                'is_active' => $status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil di ubah',
                'title' => 'Berhasil'
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Status gagal di ubah',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $view = [
            'data' => view('main.anggota.edit', compact('user'))->render()
        ];

        return response()->json($view);
    }
}
