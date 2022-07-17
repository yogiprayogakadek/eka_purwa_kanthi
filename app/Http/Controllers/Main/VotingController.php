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
        $pemilu = Pemilu::where('status', '=', true)->pluck('id_pemilu')->toArray();
        if(count($pemilu) > 0){
            $kandidat = Kandidat::whereIn('id_pemilu', $pemilu)->get();
        }else{
            $kandidat = [];
        }
        return view('main.voting.index', compact('kandidat'));
    }
}
