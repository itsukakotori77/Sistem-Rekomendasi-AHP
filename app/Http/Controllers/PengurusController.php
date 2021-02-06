<?php

namespace App\Http\Controllers;

use Datatables;
use App\User;
use App\Role;
use App\PengurusKoperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Query
        $data = PengurusKoperasi::select('pengurus_koperasi.*', 'users.email', 'users.username', 'users.status', 'roles.Role')
                ->leftJoin('users', 'users.id', 'pengurus_koperasi.User_ID')
                ->leftJoin('roles', 'roles.id', 'users.role_id')
                ->orderBy('pengurus_koperasi.created_at', 'DESC')
                ->get();

        // Ajax
        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Jabatan', function($data){
                    return $data->Role;
                    })
                    ->addColumn('Status', function($data){

                        if($data->status == 1)
                            $status = '<div class="text-center"><span class="badge badge-success"><strong>Aktif</strong></span></div>';
                        else 
                            $status = '<div class="text-center"><span class="badge badge-danger"><strong>Tidak Aktif</strong></span></div>';

                        return $status;

                    })
                    ->addColumn('Foto', function($data){

                        if($data->Foto != '')
                            $foto = '<img src="' . asset('assets-back/img/foto-user/' . $data->Foto) . '" alt="" style="width: 70px; border-radius: 50%; margin-top: 10px; margin-bottom: 10px;">';
                        else 
                            $foto = '<img src="' . asset('assets-back/img/foto-user/user.png') . '" alt="" style="width: 70px; border-radius: 50%; margin-top: 10px; margin-bottom: 10px;">';

                        return $foto;
                    })
                    ->addColumn('Nama', function($data){
                        return 
                            $data->Nama_Depan . ' ' . $data->Nama_Belakang;
                    })
                    ->addColumn('Username', function($data){
                        return 
                            $data->username;
                    })
                    ->addColumn('Aksi', function($data){
                        return 
                            '
                                <div class="text-center">
                                    <button type="button" onclick="showData('. $data->Kode_Pengurus .')" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                    <a href="' . url('/pengurus/' . $data->Kode_Pengurus . '/edit') .  '" class="btn btn-secondary btn-xs"><i class="fas fa-user-edit"></i></a>
                                </div>
                            ';
                    })
                    ->rawColumns(['Foto', 'Status', 'Aksi'])
                    ->make(true);
        }

        return view('Pengurus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'role' => Role::where('id', '=', 2)->get()
        );

        return view('Pengurus.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Query get
        $user_data = User::where('email', $request->Email)->first();

        if($user_data)
        {

            $message = 'email yang dimasukkan telah tersedia, silahkan gunakan email lain';
            return back()->with('message', $message);

        }else{
            // User
            $user = new User;
            $user->username = $request->Username;
            $user->email = $request->Email;
            $user->password = Hash::make('pengurus123');
            $user->remember_token = Str::random(60);
            $user->role_id = $request->Role;
            $user->status = 1;
    
            // Upload Gambar
            if($request->file('Foto_Avatar') == '') 
            {
                $avatar = NULL;
            } else {
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
            }
            $user->avatar = $avatar;
            $user->save();
    
            // Pengurus
            $request->request->add(['Foto' => $avatar]);
            $request->request->add(['User_ID' => $user->id]);
            $pengurus = PengurusKoperasi::create($request->all());

            $message = 'Pengurus berhasil didaftarkan';
            
            return redirect('/pengurus')->with('message', $message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $pengurus = PengurusKoperasi::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'pengurus' => $pengurus = PengurusKoperasi::find($id),
            'role' => Role::where('id', '!=', 1)->get(),
            'user' => User::where('id', $pengurus->User_ID)->first(),
        );

        return view('Pengurus.edit', compact('data'));
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
        //Pengurus
        $pengurus = PengurusKoperasi::find($id);
        $pengurus->Nama_Depan = $request->Nama_Depan;
        $pengurus->Nama_Belakang = $request->Nama_Belakang;
        $pengurus->Jenis_Kelamin = $request->Jenis_Kelamin;
        $pengurus->Alamat = $request->Alamat;

        // User
        // $user = User::find($pengurus->User_ID);
        $user_query = User::where('email', '=', $request->Email)->first();

        if($user_query)   
        {
            
            return back()->with('message', 'Email telah tersedia, silahkan gunakan email lain');

        }else{

            $user = User::find($pengurus->User_ID);

            // User
            $user->username = $request->Username;
            $user->email = $request->Email;
            $user->role_id = $request->Role;
    
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
                $pengurus->Foto = $avatar;
            }
            $pengurus->save();
            $user->save();

            return redirect('/pengurus')->with('message', 'Data berhasil diubah');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
