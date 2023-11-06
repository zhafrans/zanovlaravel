<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $user = auth()->user();
        $idUser = $user->id;
        // dd($idUser);
        
        // dd($id);
        
        $transaksi = Transaksi::all(); // Mengambil semua data dari tabel "Transaksi"
        return view('admin.finansial.transaksi.index', compact('transaksi', 'idUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.finansial.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // $user = auth()->user();
        // $idUser = $user->id;
        // dd($idUser);
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'nama_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            'id_user' => 'required|numeric',
            // Tambahkan validasi untuk semua field yang perlu diisi sesuai dengan kebutuhan Anda.
        ]);

        // Simpan data baru ke dalam tabel "Transaksi"
        
        Transaksi::create([
            'nama_transaksi' => $request->input('nama_transaksi'),
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'nominal' => $request->input('nominal'),
            'keterangan' => $request->input('keterangan'),
            'id_user' => $request->input('id_user'),
            
            // Masukkan semua field yang perlu disimpan sesuai dengan struktur tabel "Transaksi".
        ]);

    // Redirect pengguna ke halaman yang sesuai, misalnya, halaman indeks.
    return redirect('transaksi')->with('success', 'Data Transaksi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $idUser = $user->id;
       // Dapatkan data transaksi yang akan diedit berdasarkan ID
       $transaksi = Transaksi::find($id);

       return view('admin.finansial.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        $idUser = $user->id;
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'nama_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);

        // Dapatkan data transaksi yang akan diupdate berdasarkan ID
        $transaksi = Transaksi::find($id);

        // Perbarui data transaksi
        $transaksi->nama_transaksi = $request->input('nama_transaksi');
        $transaksi->jenis_transaksi = $request->input('jenis_transaksi');
        $transaksi->nominal = $request->input('nominal');
        $transaksi->keterangan = $request->input('keterangan');
        $transaksi->id_user = $idUser;
        $transaksi->save();

        // Redirect pengguna kembali ke halaman yang sesuai, misalnya, halaman indeks.
        return redirect()->route('transaksi')->with('success', 'Data Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
    
        if (!$transaksi) {
            return redirect()->route('transaksi')->with('error', 'Data Transaksi tidak ditemukan.');
        }

        $transaksi->delete();

        return redirect()->route('transaksi')->with('success', 'Data Transaksi berhasil dihapus.');
        }
}
