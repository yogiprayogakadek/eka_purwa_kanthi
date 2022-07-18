<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemiluRequest;
use App\Models\Pemilu;
use Illuminate\Http\Request;

class PemiluController extends Controller
{
    public function index()
    {
        return view('main.pemilu.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.pemilu.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $data = Pemilu::all();

        $view = [
            'data' => view('main.pemilu.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(PemiluRequest $request)
    {
        try {
            $pemilu = Pemilu::where('status', true)->count();
            $data = [
                'tanggal_pemilu' => $request->tanggal_pemilu,
            ];
            if($pemilu <= 0) {
                Pemilu::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'title' => 'Berhasil',
                ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Tidak dapat menambahkan data pemilu, karena masih ada status Pemilihan Umum yang aktif',
                    'title' => 'Info',
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

    public function edit($id)
    {
        $data = Pemilu::find($id);
        $view = [
            'data' => view('main.pemilu.edit', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function update(PemiluRequest $request)
    {
        try {
            $pemilu = Pemilu::find($request->id_pemilu);
            $data = [
                'tanggal_pemilu' => $request->tanggal_pemilu,
            ];

            $pemilu->update($data);

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

    public function changeStatus(Request $request)
    {
        try {
            $data = Pemilu::where('status', true)->count();
            $status = $request->status;
            $id_pemilu = $request->id_pemilu;
            $pemilu = Pemilu::find($id_pemilu);
            if($status == true) {
                if($data <= 0) {
                    $pemilu->update([
                        'status' => true,
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Status berhasil diubah',
                        'title' => 'Berhasil',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Tidak dapat mengubah status pemilu, karena masih ada status Pemilihan Umum yang aktif',
                        'title' => 'Info',
                    ]);
                }
            } else {
                $pemilu->update([
                    'status' => false,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Status berhasil diubah',
                    'title' => 'Berhasil',
                ]);
            }

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

    public function changeChartStatus(Request $request)
    {
        try {
            $status = $request->status == "true" ? true : false;
            $id_pemilu = $request->id_pemilu;
            $pemilu = Pemilu::find($id_pemilu);
            if($pemilu->status == true) {
                // if($total <= 0) {
                    $data_pemilu = json_decode($pemilu->data_pemilu, true);
                    $data_pemilu['result'] = $status;
                    $pemilu->data_pemilu = json_encode($data_pemilu);
                    $pemilu->save();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Status berhasil diubah',
                        'title' => 'Berhasil',
                    ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Status tidak dapat diubah, karena pemilu belum aktif',
                    'title' => 'Info',
                ]);
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Status gagal di ubah',
                'title' => 'Gagal'
            ]);
        }
    }
}
