<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('username', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data User Ditemukan',
            'data' => $data
        ], 200);
        
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

        $dataUser = new User;

        $rules = [
            'username' => 'required',
            'password' => 'required',
            'jenis' => 'required',
            'bagian' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data User',
                'data' => $validator->errors()
            ]);
        }

        $dataUser->username = $request->username;
        $dataUser->jenis = $request->jenis;
        $dataUser->bagian = $request->bagian;
        $dataUser->password = Hash::make($request->password);
        

        $post = $dataUser->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data User'
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
        $data = User::find($id);

        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data User ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data User tidak ditemukan'
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

        $dataUser = User::find($id);

        if(empty($dataUser)){
            return response()->json([
                'status' => false,
                'message' => 'Data User tidak ditemukan'
            ], 404);
        }

        $rules = [
            'username' => 'required',
            'password' => 'required',
            'jenis' => 'required',
            'bagian' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan UPDATE data User',
                'data' => $validator->errors()
            ]);
        }

        $dataUser->username = $request->username;
        $dataUser->password = Hash::make($request->password);
        $dataUser->jenis = $request->jenis;
        $dataUser->bagian = $request->bagian;

        $post = $dataUser->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan UPDATE data User'
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
        $dataUser = User::find($id);

        if(empty($dataUser)){
            return response()->json([
                'status' => false,
                'message' => 'Data User tidak ditemukan'
            ], 404);
        }

        $post = $dataUser->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan DELETE data User'
        ]);
    }
}
