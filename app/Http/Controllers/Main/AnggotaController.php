<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnggotaRequest;
use App\Models\Jabatan;
use App\Models\Rapat;
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
        $jabatan = Jabatan::where('nama_jabatan', '!=', 'Admin')->get();
        $view = [
            'data' => view('main.anggota.create', compact('jabatan'))->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $jabatan = Jabatan::where('nama_jabatan', '!=', 'Admin')->pluck('id_jabatan');
        $data = User::whereIn('id_jabatan', $jabatan)->get();
        // $data = User::whereIn('id_jabatan', $jabatan->id_jabatan)->get();

        $view = [
            'data' => view('main.anggota.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(AnggotaRequest $request)
    {
        try {
            // can create user
            $jabatan = Jabatan::find($request->jabatan);
            $canCreate = false;
            // count users with same jabatan
            if($jabatan->nama_jabatan == 'Anggota') {
                $canCreate = true;
            } else {
                $count = User::where('id_jabatan', $request->jabatan)->where('is_active', '1')->count();
                // dd($count);
                if($count > 0) {
                    $canCreate = false;
                } else {
                    $canCreate = true;
                }
            }

            
            // save user if can create true
            if($canCreate == true) {
                DB::transaction(function () use ($request, $canCreate) {
                    $data = [
                        'nama' => $request->nama,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'email' => $request->email,
                        'password' => bcrypt('12345678'),
                        'id_jabatan' => $request->jabatan,
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
    
                        $data['foto'] = $save_path . $filenametostore;
                    }
    
                    $img = Image::make($request->file('foto')->getRealPath());
                    $img->resize(300, 300);
                    $img->save($save_path . $filenametostore);
    
                    // save user
                    $user = User::create($data);
    
                    // save peserta rapat
                    $peserta = [
                        'id_user' => $user->id_user,
                        'kehadiran' => 0,
                    ];
    
                    $rapat = Rapat::where('peserta_rapat', '!=', null)->get();
                    foreach($rapat as $key => $value) {
                        $peserta_rapat = json_decode($value->peserta_rapat);
                        $peserta_rapat[] = $peserta;
                        Rapat::where('id_rapat', $value->id_rapat)->update([
                            'peserta_rapat' => json_encode($peserta_rapat),
                        ]);
                    }
    
    
                });
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'title' => 'Berhasil',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Sudah Ada',
                    'title' => 'Gagal',
                ]);
            }
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
        $jabatan = Jabatan::where('nama_jabatan', '!=', 'Admin')->get();
        $view = [
            'data' => view('main.anggota.edit', compact('user', 'jabatan'))->render()
        ];

        return response()->json($view);
    }

    public function update(AnggotaRequest $request)
    {
        try {
            $canCreate = false;
            $jabatan = Jabatan::find($request->jabatan);
            $user = User::find($request->id_user);
            $originalIdJabatan = $user->getOriginal('id_jabatan');
            
            if($originalIdJabatan == $request->jabatan) {
                $canCreate = true;
            } else {
                $count = User::where('id_jabatan', $request->jabatan)->where('is_active', '1')->count();
                // dd($count);
                if($count > 0) {
                    if($jabatan->nama_jabatan == 'Anggota') {
                        $canCreate = true;
                    } else {
                        $canCreate = false;
                    }
                } else {
                    $canCreate = true;
                }
            }







            // can create user

            // save user if can create true
            if($canCreate == true) {
                DB::transaction(function () use ($request, $canCreate, $user) {
                    $data = [
                        'nama' => $request->nama,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'email' => $request->email,
                        'password' => bcrypt('12345678'),
                        'id_jabatan' => $request->jabatan,
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
    
                        $data['foto'] = $save_path . $filenametostore;
                        $img = Image::make($request->file('foto')->getRealPath());
                        $img->resize(300, 300);
                        $img->save($save_path . $filenametostore);
                    }
    
                    // save user
                    $user->update($data);
                });
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'title' => 'Berhasil',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Sudah Ada',
                    'title' => 'Gagal',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
                'title' => 'Gagal',
            ]);
        }
    }
}
