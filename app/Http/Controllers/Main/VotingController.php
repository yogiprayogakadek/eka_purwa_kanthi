<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kandidat;
use App\Models\Pemilu;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index()
    {
        $hasVoted = false;
        $checkIfVoted = Pemilu::where('status', true)->first();
        $ifNotNull = Pemilu::where('status', true)->first();
        if($ifNotNull) {
            $showChart = json_decode($checkIfVoted->data_pemilu)->result ?? false;
            if($checkIfVoted->data_pemilu != null) {
                foreach(json_decode($checkIfVoted->data_pemilu)->data as $key => $value) {
                    if(auth()->user()->id_user == $value->id_user) {
                        $hasVoted = true;
                    }
                }
            }
        } else {
            $hasVoted = false;
            $showChart = false;
        }
    
        // data kandidat untuk chart
        $chart = $this->chart();
        // dd($chart);

        $pemilu = Pemilu::where('status', true)->pluck('id_pemilu')->toArray();
        if(count($pemilu) > 0){
            $kandidat = Kandidat::whereIn('id_pemilu', $pemilu)->get();
        }else{
            $kandidat = [];
        }
        return view('main.voting.index', compact('kandidat', 'hasVoted', 'chart', 'showChart'));
    }

    public function vote(Request $request)
    {
        $pemilu = Pemilu::where('status', true)->first();
        $data = [
            'result' => false,
            'data' => [
                [
                    'id_user' => auth()->user()->id_user,
                    'id_kandidat' => $request->id_kandidat
                ],
            ]
        ];
        if(json_decode($pemilu->data_pemilu) == null) {
            $pemilu->update([
                'data_pemilu' => json_encode($data)
            ]);
        } else {
            $newData = json_decode($pemilu->data_pemilu, true);
            $newData['data'][] = [
                'id_user' => auth()->user()->id_user,
                'id_kandidat' => $request->id_kandidat
            ];
            $pemilu->data_pemilu = json_encode($newData);
            $pemilu->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil memilih',
            'title' => 'Success'
        ]);
    }

    public function chart()
    {
        $ifNotNull = Pemilu::where('status', true)->first();
        if($ifNotNull) {
            $pemilu = Pemilu::where('status', true)->first();
        } else {
            $pemilu = Pemilu::latest()->first();
        }
        $kandidat = Kandidat::where('id_pemilu', $pemilu->id_pemilu)->get();
        
        if($pemilu->data_pemilu != null) {
            $data_pemilu = json_decode($pemilu->data_pemilu)->data;
            foreach($data_pemilu as $key => $value) {
                $kandidat_pemilu[] = $value->id_kandidat;
            }

            $data =[];
            $total = 0;
            foreach($kandidat as $key => $value){
                if(in_array($value->id_kandidat, $kandidat_pemilu)) {
                    $total++;
                }
                $data[] = [
                    'nama' => $value->user->nama,
                    // 'suara' => $value->id_kandidat != $data_pemilu->id_kandidat ? 0 : $data[$value->id_kandidat]['suara'] + 1,
                    // 'suara' => in_array($value->id_kandidat, $kandidat_pemilu) ? $data[$value->id_kandidat]['suara'] + 1 : 0,
                    'suara' => in_array($value->id_kandidat, $kandidat_pemilu) ? $total : 0,
                ];
            }
            // $data = json_decode($pemilu->data_pemilu)->data;
        } else {
            $data = [];
        }

        return $data;
    }
}
