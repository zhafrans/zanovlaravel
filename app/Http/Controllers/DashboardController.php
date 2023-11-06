<?php

namespace App\Http\Controllers;

use App\Models\DashboardMain;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 
    public function index()
    {   
        // $data = Transaksi::all();
        // dd($data);
        // $user = Auth::user();
        // dd($user);
        // $user = session('user');
        $user = auth()->user();
        return view('dashboard.welcome', [
            'datas' => Transaksi::all(),
            'total_uang' => Transaksi::selectRaw('SUM(CASE WHEN jenis_transaksi = "pemasukan" THEN nominal ELSE 0 END) - SUM(CASE WHEN jenis_transaksi = "pengeluaran" THEN nominal ELSE 0 END) AS total_uang')->first(),
            'user' => $user,
        ]);
        
        
    }

    


}
