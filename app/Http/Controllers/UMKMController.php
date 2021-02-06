<?php

namespace App\Http\Controllers;

use Auth;
use Datatables;
use PDF;
use Carbon\Carbon;
use App\Aset;
use App\UMKM;
use App\Dataset;
use App\User;
use App\SektorUsaha;
use Phpml\Math\Matrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UMKMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // // $data = UMKM::latest()->get();
        $data = UMKM::select('umkm.*', 'aset.*')->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')
                ->orderBy('umkm.created_at', 'DESC')->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Sektor_Usaha', function($data){
                        if($data->Sektor_Usaha === 1)
                            $sektor = 'Kuliner';
                        elseif($data->Sektor_Usaha === 2)
                            $sektor = 'Fashion';
                        elseif($data->Sektor_Usaha === 3)
                            $sektor = 'Perdagangan';
                        else 
                            $sektor = 'Pertanian';

                        return $sektor;
                    })
                    ->addColumn('Skor_Bantuan', function($data){
                        // return round((float)$data['Kriteria_Kecocokan'] * 100 ) . '%';
                        return $data['Kriteria_Kecocokan'];
                    })
                    ->addColumn('Aksi', function($data){

                        if(isset($data->Jumlah_SDM))
                        {
                            $aksi = 
                                '
                                    <div class="text-center">
                                        <button type="button" onclick="show(' . $data->Kode_Umkm . ')" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                        <a href="' . url('/umkm/' . $data->Kode_Umkm . '/edit' ) . '" class="btn btn-warning btn-xs"><strong><i class="fas fa-edit"></i></strong></a>
                                    </div>
                                ';
                        }else {
                            $aksi = 
                            '
                                <div class="text-center">
                                    <button type="button" onclick="show(' . $data->Kode_Umkm . ')" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                </div>
                            ';
                        }

                        return $aksi;
                    })
                    ->rawColumns(['Aksi'])
                    ->make(true);
        }

        return view('UMKM.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $data = UMKM::select();
        $data = array(
            'umkm' => UMKM::select('umkm.*', 'aset.*')->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')
                        ->whereNull('aset.UMKM_Kode')->get()
        );

        return view('UMKM.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['UMKM_Kode' => $request->UMKM]);
        $aset = Aset::create($request->all());
        return redirect('/umkm')->with('message', 'Data aset telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $data = UMKM::select('umkm.*', 'aset.*')
            ->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')
            ->where('umkm.Kode_Umkm', '=', $id)->first();
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
            'umkm' => UMKM::find($id),
            'umkm_data' => UMKM::select('umkm.*', 'aset.*')->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')
                    ->get()
        );

        return view('UMKM.edit', compact('data'));
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
        // Request
        $request->request->add(['UMKM_Kode' => $request->UMKM]);

        // Query
        $aset = Aset::find($id);
        $aset->Jumlah_SDM = $request->Jumlah_SDM;
        $aset->Total_Aset = $request->Total_Aset;
        $aset->Omzet = $request->Omzet;
        $aset->Sertifikat_Perizinan = $request->Sertifikat_Perizinan;
        $aset->Wilayah_Pemasaran = $request->Wilayah_Pemasaran;
        $aset->Keterangan = $request->Keterangan;
        $aset->UMKM_Kode = $request->UMKM_Kode;
        $aset->save();

        // Redirect
        return redirect('/umkm')->with('message', 'Data aset telah diubah');
    }

    public function import(Request $request)
    {
        switch($request->method())
        {
            case 'GET':

                return view('UMKM.import');

            break;

            case 'POST':

                $file = $request->file("CSV");
                $csvData = file_get_contents($file);
        
                $rows = array_map("str_getcsv", explode("\n", $csvData));
                $header = array_shift($rows);

                // Get Iteration
                if(count(User::where('role_id', '=', 3)->get()) === 0)
                {
                    $i = 0;
                }else{
                    $i = count(User::where('role_id', '=', 3)->get()) + 1;
                }

                // Get Header
                if(count($rows) > 200)
                {
                    return back()->with('message', 'Jumlah record data melebihi kapasitas maksimal');

                }else{

                    foreach($rows as $row)
                    {
                        if(isset($row[0]))
                        {
                            
                            $row = array_combine($header, $row);
    
                            // User
                            $user = User::create([
                                'username' => 'umkm' . $i,
                                'email' => strtolower($row['Email']),
                                'password' => Hash::make('umkm123'),
                                'remember_token' => Str::random(60),
                                'role_id' => 3,
                                'status' => 1,
                                'avatar' => '',
                            ]);
    
                            // UMKM
                            $umkm = UMKM::create([
                                'Nama_Usaha' => $row['Nama Usaha'],
                                'Nama_Pemilik_Usaha' => $row['Nama Pemilik'],
                                'Sektor_Usaha' => $row['Sektor Usaha'],
                                'Komoditi' => $row['Komoditi'],
                                'NPWP' => $row['NPWP'],
                                'KTP' => $row['KTP'],
                                'Alamat_Jalan' => $row['Alamat'],
                                'Kecamatan' => $row['Kecamatan'],
                                'Desa' => $row['Desa'],
                                'Email' => $row['Email'],
                                'Tahun_Mulai' => $row['Tahun Mulai'],
                                'No_Telp' => $row['No Telp'],
                                'Status' => 1,
                                'User_ID' => $user->id
                            ]);

                            // Aset UMKM
                            $aset_umkm = Aset::create([
                                'Jumlah_SDM' => $row['Jumlah Karyawan'],
                                'Total_Aset' => $row['Aset'],
                                'Omzet' => (int)$row['Omzet'],
                                'Sertifikat_Perizinan' => $row['Sertifikat'],
                                'Wilayah_Pemasaran' => $row['Wilayah'],
                                'Keterangan' => '',
                                'UMKM_Kode' => $umkm->Kode_Umkm
                            ]);
    
                        }
                        
                        $i++;
                    }

                    return back()->with('message', 'Data berhasil diimport');
                }

            break;
        }
    }

    public function persyaratan(Request $request, $id)
    {

        switch($request->method())
        {
            case 'GET':

                // get API
                $url_kelurahan = 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=3217110';
                $json_data_kelurahan = file_get_contents($url_kelurahan);
                $kelurahan = json_decode($json_data_kelurahan, true);

                // Query
                $data = array(
                    'umkm' => UMKM::select('umkm.*', 'sektor_usaha.Sektor_Usaha')
                                ->leftJoin('sektor_usaha', 'sektor_usaha.Kode_Sektor', '=', 'umkm.Sektor_Usaha')
                                ->leftJoin('users', 'users.id', '=', 'umkm.User_ID')
                                ->where('users.id', '=', $id)->first(),
                    'data_kelurahan' => $kelurahan,
                    'data_usaha' => $data_usaha = SektorUsaha::all()
                );
                
                return view('UMKM.persyaratan', compact('data'));
                // return $data;

            break;

            case 'PUT':

                // UMKM
                $umkm = UMKM::find($id);
                $umkm->Alamat_Jalan = $request->Alamat_Jalan;
                $umkm->KTP = $request->KTP;
                $umkm->Kecamatan = 'Parongpong';
                $umkm->Sektor_Usaha = $request->Sektor_Usaha;
                $umkm->Desa = $request->Kelurahan;
                $umkm->No_Telp = $request->No_Telp;

                // Upload Foto
                if($request->file('Foto_Form') == '') 
                {
                    $foto = NULL;
                }else{
                    //Change Path of Picture
                    $file1 = $request->file('Foto_Form');
                    $dt1 = Carbon::now();
                    $acak1  = $file1->getClientOriginalExtension();
                    $fileName1 = rand(11111,99999) . '-' . $dt1->format('Y-m-d-H-i-s') . '.' . $acak1; 
            
                    // Croping Picture
                    $image_resize1 = Image::make($file1->getRealPath());              
                    $image_resize1->resize(200, 200);
                    $image_resize1->save(public_path('data/umkm/foto/' . $fileName1));
                    $foto = $fileName1;
                    // $umkm->Foto = $foto;
                }

                // Upload Foto
                if($request->file('Dokumen_Form') == '') 
                {
                    $dokumen = NULL;
                }else{
                    //Change Path of Picture
                    $file2 = $request->file('Dokumen_Form');
                    $dt2 = Carbon::now();
                    $acak2  = $file2->getClientOriginalExtension();
                    $fileName2 = rand(11111,99999) . '-' . $dt2->format('Y-m-d-H-i-s') . '.' . $acak2; 

                    $path = $file2->getPathname();
                    $filename3 = $file2->getClientOriginalName();
            
                    // Moving File
                    $file2->move(public_path('data/umkm/dokumen/'), $file2->getClientOriginalName());
                    $dokumen = $filename3;
                    // $pengurus->Foto = $dokumen;
                }

                
                // $request->request->add(['Foto' => $foto]);
                // $request->request->add(['Dokumen' => $dokumen]);

                // Foto
                $umkm->Foto = $foto;
                $umkm->Dokumen = $dokumen;
                $umkm->save();

                // return $request;
                return redirect('/dashboard')->with('message', 'Data Persyaratan Berhasil Diinput');

            break;
        }

    }

    public function umkmShow($id)
    {
        $data = array(
            'umkm' => UMKM::select('umkm.*', 'sektor_usaha.Sektor_Usaha')
                        ->leftJoin('sektor_usaha', 'sektor_usaha.Kode_Sektor', '=', 'umkm.Sektor_Usaha')
                        ->leftJoin('users', 'users.id', '=', 'umkm.User_ID')
                        ->where('users.id', '=', $id)->first(),
        );

        return view('UMKM.personal', compact('data'));
    }

    public function downloadSurat($id)
    {
        $data = UMKM::find($id);
         // Download PDF
        $pdf = PDF::loadView('Persetujuan.surat', compact('data'))
                    ->setPaper('A4');
                    
        return $pdf->download('surat-penerimaan-bantuan-' . date('Y-m-d_H-i-s'). '.pdf');
    }
}
