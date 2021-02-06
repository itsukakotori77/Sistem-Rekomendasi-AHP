<?php

namespace App\Http\Controllers;

use Datatables;
use PDF;
use App\UMKM;
use App\Persetujuan;
use App\HasilPerhitungan;
use Carbon\Carbon;
use Phpml\Math\Matrix;
use Illuminate\Http\Request;

class PersetujuanBantuanController extends Controller
{

    public function index(Request $request)
    {
        $data = HasilPerhitungan::select(
                            'umkm.Kode_Umkm',
                            'umkm.Nama_Usaha', 
                            'umkm.Sektor_Usaha', 
                            'umkm.Status', 
                            'hasil_perhitungan.Kriteria_Kecocokan'
                        )
                        ->leftJoin('umkm', 'umkm.Kode_UMKM', '=', 'hasil_perhitungan.UMKM_Kode')
                        ->orderBy('hasil_perhitungan.Kriteria_Kecocokan', 'DESC')
                        ->take(5)
                        ->get();
                        // ->leftJoin('aset', 'aset.UMKM_Kode', '=', 'hasil_perhitungan.UMKM_Kode')
                        // ->take(5);

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
                    ->editColumn('Status', function($data){

                        // Condition
                        if($data->Status === 1)
                            $status = '<div class="text-center"><span class="badge badge-default"><strong>Belum Mendapat Keputusan</strong></span></div>';
                        elseif($data->Status === 2) 
                            $status = '<div class="text-center"><span class="badge badge-primary"><strong>Menunggu Pembuatan Surat</strong></span></div>';
                        elseif($data->Status === 3) 
                            $status = '<div class="text-center"><span class="badge badge-success"><strong>Menerima Bantuan</strong></span></div>';
                        else 
                            $status = '<div class="text-center"><span class="badge badge-danger"><strong>Tidak Menerima Bantuan</strong></span></div>';

                        return $status;
                    })
                    ->addColumn('Skor_Bantuan', function($data){
                        // $percent = $data->Kriteria_Kecocokan * 100;
                        // return 
                        //     '   
                        //         <div class="text-center">
                        //             ' . percent($percent) . '
                        //             <div class="progress">
                        //                 <div class="progress-bar" role="progressbar" style="width: ' . percent($percent) . '" aria-valuenow="" aria-valuemax="100"></div> 
                        //             </div>
                        //         </div>
                        //     ';
                        return '<div class="text-center">' . $data->Kriteria_Kecocokan . '</div>'; 
                    }) 
                    ->addColumn('Aksi', function($data){
                        
                        if($data->Status === 1)
                        {
                            $button = 
                                '
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-xs dropdown-toggle" type="button" id="statusUpdate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="statusUpdate">
                                                <a class="dropdown-item" onclick="disetujui(' . $data->Kode_Umkm . ')" href="#">Terima Bantuan</a>
                                                <a class="dropdown-item" onclick="ditolak(' . $data->Kode_Umkm . ')" href="#">Tolak Pemberian Bantuan</a>
                                            </div>
                                        </div>
                                    </div>
                                '; 
                            }
                        elseif($data->Status === 2)
                        {
                            $button = 
                                '
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-xs dropdown-toggle" type="button" id="statusUpdate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="statusUpdate">
                                                <a class="dropdown-item" onclick="buatSurat(' . $data->Kode_Umkm . ')" href="#">Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                '; 
                        }
                        else{
                            $button = 'Tidak ada aksi';
                        }

                        return $button;
                    })
                    ->rawColumns(['Aksi', 'Status', 'Skor_Bantuan'])
                    ->make(True);
        }

        return view('Persetujuan.index');
        // return $data->Kode_Umkm;
        // var_dump($data);

    }

    public function status($id, $method)
    {
        $umkm = UMKM::find($id);

        switch($method)
        {
            case 'disetujui':
                $umkm->Status = 2;

                // Persetujuan
                Persetujuan::create([
                    'UMKM_Kode' => $umkm->Kode_Umkm,
                    'Tanggal_Persetujuan' => Carbon::now()->format('Y-m-d')
                ]);
            break;
            
            case 'ditolak':
                $umkm->Status = 4;

                // Persetujuan
                Persetujuan::create([
                    'UMKM_Kode' => $umkm->Kode_Umkm,
                    'Tanggal_Persetujuan' => Carbon::now()->format('Y-m-d')
                ]);
            break;
        }

        $umkm->save();

        return True;
    }

    public function ajukan($id)
    {
        $data = UMKM::find($id);
        // Ubah Status
        $data->Status = 3;
        $data->save();

        // Download PDF
        $pdf = PDF::loadView('Persetujuan.surat', compact('data'))
                    ->setPaper('A4');
        return $pdf->download('surat-penerimaan-bantuan-' . date('Y-m-d_H-i-s'). '.pdf');
    }

    public function hitungData()
    {
        $data = UMKM::select('umkm.*', 'aset.*')->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')->get();

        $i = 0;
        $matrix = hitung($data);
        foreach($data as $data)
        {
            HasilPerhitungan::create([
                'Kriteria_Kecocokan' => $matrix[$i],
                'UMKM_Kode' => $data->Kode_Umkm
            ]);

            // Iteration
            $i++;
        }

        return True;
    }
}
