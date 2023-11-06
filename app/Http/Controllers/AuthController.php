<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8001/api/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        // $token = $response->json()['token'];
        // session(['jwt_token' => $token]);
        if (isset($response['token'])) {
            $token = $response['token'];
            session(['jwt_token' => $token]);
        } else {
            // Token tidak ditemukan, kirim pesan error
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
       

        return redirect()->route('dashboard')->with('user', auth()->user());
        
    }

    public function logout()
    {
        // Lakukan log out sesuai kebutuhan, seperti menghapus token dari sesi.
        // session()->forget('token');
        // session()->forget('user');
        session()->flush();
        
        return redirect()->route('login');
    }

}
