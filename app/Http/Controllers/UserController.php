<?php

namespace App\Http\Controllers;

use Datatables;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Query
        $data = User::latest()->get();

        // Ajax
        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('avatar', function($data){

                        if($data->avatar != '')
                            $avatar = '<img src="' . asset('assets-back/img/foto-user/' . $data->avatar) . '" alt="" style="width: 70px; border-radius: 50%; margin-top: 10px; margin-bottom: 10px;">';
                        else 
                            $avatar = '<img src="' . asset('assets-back/img/foto-user/user.png') . '" alt="" style="width: 70px; border-radius: 50%; margin-top: 10px; margin-bottom: 10px;">';

                        return $avatar;
                    })
                    ->editColumn('status', function($data){

                        // Condition
                        if($data->status == 1)
                            $status = '<div class="text-center"><span class="badge badge-success"><strong>Aktif</strong></span></div>';
                        else 
                            $status = '<div class="text-center"><span class="badge badge-danger"><strong>Tidak Aktif</strong></span></div>';

                        return $status;
                    })
                    ->addColumn('aksi', function($data){
                        if($data->status == 1)
                            $button = 
                                '
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-xs dropdown-toggle" type="button" id="statusUpdate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="statusUpdate">
                                                <a class="dropdown-item" onclick="statusAktif(' . $data->id . ')" href="#">Tidak Aktif</a>
                                            </div>
                                        </div>
                                    </div>
                                '; 
                        else 
                            $button = 
                                '
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-xs dropdown-toggle" type="button" id="statusUpdate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="statusUpdate">
                                                <a class="dropdown-item" onclick="statusAktif(' . $data->id . ')" href="#">Aktif</a>
                                            </div>
                                        </div>
                                    </div>
                                '; 

                        return $button;
                    })
                    ->rawColumns(['avatar', 'status', 'aksi'])
                    ->make(true);
        }

        return view('User.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('Auth.profile', compact('data'));
        
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
        $user = User::find($id);
        $user->username = $request->Username;
        $user->password = Hash::make($request->Password);
        // Upload Gambar
        if($request->file('Foto_Avatar') != '') 
        {
            //Change Path of Picture
            $file = $request->file('Foto_Avatar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak; 
    
            // Croping Picture
            $image_resize = Image::make($file->getRealPath());              
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('assets-back/img/foto-user/' . $fileName));
            $avatar = $fileName;
            $user->avatar = $avatar;
        }
        $user->save();

        return back()->with('message', 'Profile Berhasil Diubah');
    }

    
    public function ubahStatus($id)
    {
        $user = User::find($id);
        
        if($user->status == 1)
        {
            $user->status = 0;
        }else{
            $user->status = 1;
        }

        $user->save();

        return True;
    }
}
