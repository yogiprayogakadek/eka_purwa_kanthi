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
        $showChart = json_decode($checkIfVoted->data_pemilu)->result;
        if($checkIfVoted->data_pemilu != null) {
            foreach(json_decode($checkIfVoted->data_pemilu)->data as $key => $value) {
                if(auth()->user()->id_user == $value->id_user) {
                    $hasVoted = true;
                }
            }
        }

        $pemilu = Pemilu::where('status', true)->pluck('id_pemilu')->toArray();
        if(count($pemilu) > 0){
            $kandidat = Kandidat::whereIn('id_pemilu', $pemilu)->get();
        }else{
            $kandidat = [];
        }
        return view('main.voting.index', compact('kandidat', 'hasVoted'));
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
        $pemilu = Pemilu::where('status', true)->first();
        $kandidat = Kandidat::where('id_pemilu', $pemilu->id_pemilu)->get();
        
        $data_pemilu = json_decode($pemilu->data_pemilu)->data;
        foreach($data_pemilu as $key => $value) {
            $kandidat_pemilu[] = $value->id_kandidat;
        }
        // dd($kandidat_pemilu);
        $data =[];
        foreach($kandidat as $key => $value){
            // dd($value);
            $data[$value->id_kandidat] = [
                'nama' => $value->user->nama,
                // 'suara' => $value->id_kandidat != $data_pemilu->id_kandidat ? 0 : $data[$value->id_kandidat]['suara'] + 1,
                // 'suara' => in_array($value->id_kandidat, $kandidat_pemilu) ? $data[$value->id_kandidat]['suara'] + 1 : 0,
                'suara' => in_array($value->id_kandidat, $kandidat_pemilu) ? $data[$value->id_kandidat]['suara'] + 1 : 0,
            ];
        }
        dd($data);
    }
}
