<?php

namespace App\Http\Controllers;

use App\User;
use App\PengurusKoperasi;
use App\UMKM;
use Phpml\Math\Matrix;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home()
    {
        $data = array(
            'umkm' => $countUMKM = count(UMKM::all()),
            'diterima' => count(UMKM::where('Status', '=', 3)->get()),
        );

        return view('Landing.home', compact('data'));
        // return $data;

    }

    public function about()
    {
        return view('Landing.tentang');
    }

    public function dashboard()
    {
        $data = array(

            // Data charts
            'jumlah_staff' => count(PengurusKoperasi::leftJoin('users', 'users.id', '=', 'pengurus_koperasi.User_ID')
                                ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                                ->where('roles.id', '=', 2)->get()
                            ),
            'jumlah_pengurus' => count(PengurusKoperasi::leftJoin('users', 'users.id', '=', 'pengurus_koperasi.User_ID')
                                ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                                ->where('roles.id', '!=', 1)->get()
                            ),
            'jumlah_staff_laki' => count(PengurusKoperasi::where('Jenis_Kelamin', '=', 1)->get()),
            'jumlah_staff_perempuan' => count(PengurusKoperasi::where('Jenis_Kelamin', '=', 2)->get()),
            'jumlah_umkm' => count(UMKM::all()),

            // Data Tabel
            'pengurus' => $pengurus = PengurusKoperasi::select('pengurus_koperasi.*', 'users.status', 'roles.Role')
                                        ->leftJoin('users', 'users.id', '=', 'pengurus_koperasi.User_ID')
                                        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                                        ->take(5)->get(),
            'user' => $user = User::all(),
            'diterima' => count(UMKM::where('Status', '=', 3)->get()),
            'ditolak' => count(UMKM::where('Status', '=', 4)->get()),
            'kuliner' => count(UMKM::where([
                ['Status', '=', 2],
                ['Sektor_Usaha', '=', 1]
            ])->get()),
            'fashion' => count(UMKM::where([
                ['Status', '=', 2],
                ['Sektor_Usaha', '=', 2]
            ])->get()),
            'perdagangan' => count(UMKM::where([
                ['Status', '=', 2],
                ['Sektor_Usaha', '=', 3]
            ])->get()),
            'pertanian' => count(UMKM::where([
                ['Status', '=', 2],
                ['Sektor_Usaha', '=', 4]
            ])->get()),
            'total_umkm' => count(UMKM::all())
        );

        return view('Home.dashboard', compact('data'));
        // return $data;
 
    }

    public function testImport()
    {
        $file = $request->file("csv_file");
        $csvData = file_get_contents($file);

        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        foreach($rows as $row)
        {
            
        }
    }
}
