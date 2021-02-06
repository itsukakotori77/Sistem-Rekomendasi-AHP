<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        switch($request->method())
        {
            // View
            case 'GET':
                return view('Otentikasi.login');

            // Proses
            case 'POST':

                 // Validasi
                $messages = [
                    // "nomor_induk.required" => "Tolong masukkan Username",
                    // "nomor_induk.name" => "Username tidak valid",
                    // "nomor_induk.exists" => "Username tidak tersedia",
                    "password.required" => "Tolong Masukkan Password",
                    "password.exists" => "Password yang dimasukan salah"
                ];

                // Validasi
                $validator = Validator::make($request->all(), [
                    // 'name' => 'required|string|name|exists:users,name',
                    'password' => 'required|string|max:199'
                ], $messages);


                // Cek Kontrol
                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }

                // If Super Admin
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 1], $request->remember))
                {
                    return redirect('/dashboard');
                    // return 'admin';
                }

                // If Pengurus
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 2], $request->remember))
                {
                    return redirect('/dashboard');
                    // return 'Pengurus';
                }

                // If UMKM
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 3], $request->remember))
                {
                    return redirect('/dashboard');
                    // return 'UMKM';
                }

                // If UMKM
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 4], $request->remember))
                {
                    return redirect('/dashboard');
                    // return 'UMKM';
                }

                // Redirect Bak
                return back()->with('Status', 'Password salah');

            default: 

                return 'failed';
            break;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
