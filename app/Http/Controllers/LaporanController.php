<?php

namespace App\Http\Controllers;

use PDF;
use App\Aset;
use App\Persetujuan;
use App\UMKM;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //

    public function index(Request $request)
    {
        switch($request->method())
        {

            // Berdasarkan hari ini
            case 'GET':
                
                for($i=1; $i<=30; $i++)
                {
                    $tanggal = date('Y-m-'. $i);
                            
                    // UMKM Disetujui
                    $query1 = UMKM::leftJoin('persetujuan', 'persetujuan.UMKM_Kode', '=', 'umkm.Kode_Umkm')
                    ->where([
                        ['persetujuan.Tanggal_Persetujuan', $tanggal],
                        ['Status', 3],
                    ])->get();
        
                    $umkm_disetujui[] = count($query1);
                    
                    // UMKM Ditolak
                    $query2 = UMKM::leftJoin('persetujuan', 'persetujuan.UMKM_Kode', '=', 'umkm.Kode_Umkm')
                    ->where([
                        ['persetujuan.Tanggal_Persetujuan', $tanggal],
                        ['Status', 4],
                    ])->get();
        
                    $umkm_ditolak[] = count($query2);
        
                }
                
                $data = array(
                    'title' => 'Laporan Umkm Masuk',
                    'umkm_disetujui' => $umkm_disetujui,
                    'umkm_ditolak' => $umkm_ditolak
                );
        
                return view('Laporan.index', compact('data'));

            break;

            // Berdasarkan Request
            case 'POST':

                for($i=1; $i<=30; $i++)
                {
                    $tanggal_sekarang = date('Y-m-d', strtotime($request->Tanggal));
                    $tanggal = date('Y-m-'. $i, strtotime($tanggal_sekarang));
                            
                    // UMKM Disetujui
                    $query1 = UMKM::leftJoin('persetujuan', 'persetujuan.UMKM_Kode', '=', 'umkm.Kode_Umkm')
                    ->where([
                        ['persetujuan.Tanggal_Persetujuan', $tanggal],
                        ['Status', 3],
                    ])->get();
        
                    $umkm_disetujui[] = count($query1);
                    
                    // UMKM Ditolak
                    $query2 = UMKM::leftJoin('persetujuan', 'persetujuan.UMKM_Kode', '=', 'umkm.Kode_Umkm')
                    ->where([
                        ['persetujuan.Tanggal_Persetujuan', $tanggal],
                        ['Status', 4],
                    ])->get();
        
                    $umkm_ditolak[] = count($query2);
        
                }
                
                $data = array(
                    'title' => 'Laporan Umkm Masuk',
                    'umkm_disetujui' => $umkm_disetujui,
                    'umkm_ditolak' => $umkm_ditolak
                );
        
                return view('Laporan.index', compact('data'));

            break;
        }


        // return $data;
    }

    public function laporanPDF(Request $request)
    {
        $tanggal = date('Y-m-d', strtotime($request->Tahun . '-' . $request->Tanggal));
        $data = array(
            'title' => 'Laporan Bantuan UMKM',
            'umkm' => UMKM::select('umkm.*', 'persetujuan.Tanggal_Persetujuan')
                        ->leftJoin('persetujuan', 'persetujuan.UMKM_Kode', '=', 'umkm.Kode_Umkm')
                        ->whereBetween('persetujuan.Tanggal_Persetujuan', [
                            date('Y-m-01', strtotime($tanggal)), 
                            date('Y-m-t', strtotime($tanggal))
                        ])->get(),

            'tanggal' => date('d F Y', strtotime($tanggal))             
        );

        $pdf = PDF::loadView('Laporan.print', compact('data'))
                    ->setPaper('A4');
        return $pdf->download('laporan-bantuan-umkm-' . date('Y-m-d_H-i-s'). '.pdf');
    }
}
