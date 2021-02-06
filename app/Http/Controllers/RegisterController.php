<?php

namespace App\Http\Controllers;

use App\User;
use App\SektorUsaha;
use App\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;


class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        // if($request->method() == '')
        switch($request->method())
        {
            // Case
            case 'GET': 
                // get API
                $url_kelurahan = 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=3217110';
                $json_data_kelurahan = file_get_contents($url_kelurahan);
                $kelurahan = json_decode($json_data_kelurahan, true);

                // Data select
                $data = array(
                    'data_kelurahan' => $kelurahan,
                    'data_usaha' => $data_usaha = SektorUsaha::all()
                );

                return view('Otentikasi.register', compact('data'));

            case 'POST':

                // Case 2
                $data_user = User::where('email', '=', $request->Email)->first();
                if($data_user)
                {
                    // Return back
                    $message = 'Email yang diinputkan telah tersedia, silahkan gunakan email lain';
                    return back()->with('message', $message);
                }else{
                    // Creating Objek User
                    $user = User::create([
                        'username' => $request->Username,
                        'email' => $request->Email,
                        'password' => Hash::make($request->Password),
                        'remember_token' => Str::random(40),
                        'role_id' => 3,
                        'status' => 1,
                    ]);


                    // Query
                    $request->request->add(['User_ID' => $user->id]);
                    $request->request->add(['Status' => 1]);
                    $umkm = UMKM::create($request->all());

                    $message = 'Registrasi telah selesai dilakukan';
                    return redirect('/')->with('message', $message);
                }


            default: 

                return 'Invalid Request';

            break;
        }
    }
}
