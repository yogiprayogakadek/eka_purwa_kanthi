<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('main.kegiatan.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.kegiatan.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $data = Kegiatan::all();

        $view = [
            'data' => view('main.kegiatan.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(KegiatanRequest $request)
    {
        try {
            $data = [
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'tempat_kegiatan' => $request->tempat_kegiatan,
            ];

            if($request->has('keterangan')) {
                $contentPath = public_path('assets/uploads/keterangan/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($request->keterangan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
                libxml_clear_errors();
                $images = $dom->getElementsByTagName('img');
                foreach($images as $img) {
                    $src = $img->getAttribute('src');
                    if(preg_match('/data:image/', $src)) {
                        //get the mimetype
                        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                        $mimetype = $groups['mime'];
        
                        //Generating a random filename
                        $filename = uniqid();
                        $filepath = "/assets/uploads/keterangan/$filename.$mimetype";
        
                        // @see http://image.intervention.io/api/
                        $image = Image::make($src)
                            // resize if required
                            ->resize(600, 600)
                            ->encode($mimetype, 100)  // encode file to the specified mimetype
                            ->save(public_path($filepath));
                        $new_src = asset($filepath);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                        $img->setAttribute('class', 'img-responsive');
                    }
                }
                $data['keterangan'] = $dom->saveHTML();
            }

            Kegiatan::create($data);

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
        $data = Kegiatan::find($id);
        $view = [
            'data' => view('main.kegiatan.edit', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function update(KegiatanRequest $request)
    {
        try {
            $kegiatan = Kegiatan::find($request->id_kegiatan);
            $data = [
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'tempat_kegiatan' => $request->tempat_kegiatan,
            ];

            if($request->has('keterangan')) {
                $contentPath = public_path('assets/uploads/keterangan/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($request->keterangan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
                libxml_clear_errors();
                $images = $dom->getElementsByTagName('img');
                foreach($images as $img) {
                    $src = $img->getAttribute('src');
                    if(preg_match('/data:image/', $src)) {
                        //get the mimetype
                        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                        $mimetype = $groups['mime'];
        
                        //Generating a random filename
                        $filename = uniqid();
                        $filepath = "/assets/uploads/keterangan/$filename.$mimetype";
        
                        // @see http://image.intervention.io/api/
                        $image = Image::make($src)
                            // resize if required
                            ->resize(600, 600)
                            ->encode($mimetype, 100)  // encode file to the specified mimetype
                            ->save(public_path($filepath));
                        $new_src = asset($filepath);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                        $img->setAttribute('class', 'img-responsive');
                    }
                }
                $data['keterangan'] = $dom->saveHTML();
            }

            $kegiatan->update($data);

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
            // dd($request->all());
            $status = $request->status;
            $id_kegiatan = $request->id_kegiatan;
            $kegiatan = Kegiatan::find($id_kegiatan);
            $kegiatan->update([
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
}
