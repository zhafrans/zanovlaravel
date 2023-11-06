<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
         // Capture the current URL before validation
         try {
            $token = session('jwt_token');
            // dd($token);
            $user = JWTAuth::setToken($token)->toUser();
            // dd($user);
        } catch (\Exception $e) {
            // Token is invalid or expired
            // return response()->json(['error' => 'Unauthorized'], 401);
            return redirect()->route('login');

        }

        return $next($request);
        // $originalUrl = $request->fullUrl();

        // // Proceed with the request
        // $response = $next($request);
        // dd($request);

        // if ($response->headers->has('Authorization')) {
        //     $token = $response->headers->get('Authorization');

        //     // Add your token validation logic here
        //     if ($this->tokenIsValid($token)) {
        //         // Token is valid, redirect to the original URL
        //         // dd($originalUrl);
        //         return redirect($originalUrl);
        //     }
        // }

        // // Token not found in the header or token is invalid, handle the case accordingly
        // return redirect()->route('login');
        // // Periksa apakah token JWT ada dalam sesi
        // $token = Session::get('token');
        // // dd($token);

        // if (!$token) {
        //     return redirect()->route('login'); // Redirect ke halaman login jika token tidak ada
        // }

        // // Jika token ada, verifikasi token
        // $user = JWTAuth::toUser($token); // Mengambil informasi pengguna dari token
        
        // // Simpan informasi pengguna dalam sesi
        // Session::put('user', $user);

        // // Lakukan verifikasi token JWT di sini, jika perlu

        // return $next($request); // Lanjutkan ke rute jika token valid
    }

    private function tokenIsValid($token) {
        try {
            $user = JWTAuth::toUser($token);
            
            // You can add additional validation logic here, if needed
    
            return true; // Token is valid
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return false; // Token is invalid
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return false; // Token has expired
        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
            return false; // Token is blacklisted (if you are using token blacklisting)
        } catch (\Exception $e) {
            return false; // Other error occurred
        }
    }
    
}
