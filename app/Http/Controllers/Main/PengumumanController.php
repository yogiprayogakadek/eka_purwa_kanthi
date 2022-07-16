<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengumumanRequest;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('main.pengumuman.index');
    }

    public function create()
    {
        $view = [
            'data' => view('main.pengumuman.create')->render(),
        ];
        return response()->json($view);
    }

    public function render()
    {
        $data = Pengumuman::all();

        $view = [
            'data' => view('main.pengumuman.render', compact('data'))->render(),
        ];

        return response()->json($view);
    }

    public function store(PengumumanRequest $request)
    {
        try {
            $data = [
                'judul' => $request->judul,
            ];

            if($request->has('isi')) {
                $contentPath = public_path('assets/uploads/isi/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($request->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                        $filepath = "/assets/uploads/isi/$filename.$mimetype";
        
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
                $data['isi'] = $dom->saveHTML();
            }

            Pengumuman::create($data);

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
        $data = Pengumuman::find($id);
        $view = [
            'data' => view('main.pengumuman.edit', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function update(PengumumanRequest $request)
    {
        try {
            $pengumuman = Pengumuman::find($request->id_pengumuman);
            $data = [
                'judul' => $request->judul,
            ];

            if($request->has('isi')) {
                $contentPath = public_path('assets/uploads/isi/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($request->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                        $filepath = "/assets/uploads/isi/$filename.$mimetype";
        
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
                $data['isi'] = $dom->saveHTML();
            }

            $pengumuman->update($data);

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
            $id_pengumuman = $request->id_pengumuman;
            $pengumuman = Pengumuman::find($id_pengumuman);
            $pengumuman->update([
                'status' => $status
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

