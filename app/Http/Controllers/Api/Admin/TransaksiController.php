<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Transaksi Ditemukan',
            'data' => $data
        ], 200);
        
        $response = Http::get('https://http://127.0.0.1:8000/api/admin/transaksi');

        if ($response->successful()) {
            $data = $response->json(); // Ambil data dari response JSON
        } else {
            $data = []; // Jika request gagal, atur data kosong atau sesuaikan dengan kebutuhan Anda
        }

        // dd($response);
    
        return view('admin.cabang.index', compact('data'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataTransaksi = new Transaksi;

        $rules = [
            'id_user' => 'required',
            'nama_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'nominal' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data Transaksi',
                'data' => $validator->errors()
            ]);
        }

        $dataTransaksi->id_user = $request->id_user;
        $dataTransaksi->nama_transaksi = $request->nama_transaksi;
        $dataTransaksi->jenis_transaksi = $request->jenis_transaksi;
        $dataTransaksi->nominal = $request->nominal;
        

        $post = $dataTransaksi->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data Transaksi'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::find($id);

        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Transaksi ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data Transaksi tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dataTransaksi = Transaksi::find($id);

        if(empty($dataTransaksi)){
            return response()->json([
                'status' => false,
                'message' => 'Data Transaksi tidak ditemukan'
            ], 404);
        }

        $rules = [
            'id_user' => 'required',
            'nama_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'nominal' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan UPDATE data Transaksi',
                'data' => $validator->errors()
            ]);
        }

        $dataTransaksi->id_user = $request->id_user;
        $dataTransaksi->nama_transaksi = $request->nama_transaksi;
        $dataTransaksi->jenis_transaksi = $request->jenis_transaksi;
        $dataTransaksi->nominal = $request->nominal;

        $post = $dataTransaksi->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan UPDATE data Transaksi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataTransaksi = Transaksi::find($id);

        if(empty($dataTransaksi)){
            return response()->json([
                'status' => false,
                'message' => 'Data Transaksi tidak ditemukan'
            ], 404);
        }

        $post = $dataTransaksi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan DELETE data Transaksi'
        ]);
    }
}
