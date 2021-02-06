<?php

namespace App\Http\Controllers;

use App\UMKM;
use Phpml\Math\Matrix;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //

    public function dashboard()
    {
        $data = array(
            'diterima' => count(UMKM::where('Status', '=', 2)->get()),
            'ditolak' => count(UMKM::where('Status', '=', 3)->get()),
            'total_umkm' => count(UMKM::all())
        );

        return $data;
    }

    public function vectorEigen()
    {
         /*
            -------- Kepentingan --------
            =============================
            Kepentingan 
            1. KTP = 7
            2. Usia UMKM = 5
            3. Surat Izin Usaha = 3
            4. Jumlah Karyawan = 3
            5. Aset = 1
            6. Omzet = 1
            =============================
            
            -------- Matriks ------------
            =============================
            Matriks Kepentingan
            [
                [1.0, 3.0, 9.0, 5.0, 7.0, 2.0],
                [0.33, 1.0, 7.0, 3.0, 5.0, 0.33],
                [0.11, 0.14, 1.0, 0.2, 0.33, 0.11],
                [0.2, 0.33, 5.0, 1.0, 3.0, 0.2],
                [0.14, 0.2, 3.0, 0.33, 1.0, 0.14],
                [0.5, 3.0, 9.0, 5.0, 7.0, 1.0],
            ] 
            =============================

        */

        $matrix1 = new Matrix([
            [1.0, 3.0, 9.0, 5.0, 7.0, 2.0],
            [0.33, 1.0, 7.0, 3.0, 5.0, 0.33],
            [0.11, 0.14, 1.0, 0.2, 0.33, 0.11],
            [0.2, 0.33, 5.0, 1.0, 3.0, 0.2],
            [0.14, 0.2, 3.0, 0.33, 1.0, 0.14],
            [0.5, 3.0, 9.0, 5.0, 7.0, 1.0],
        ]);
        
        $matrix2 = new Matrix([
            [1.0, 3.0, 9.0, 5.0, 7.0, 2.0],
            [0.33, 1.0, 7.0, 3.0, 5.0, 0.33],
            [0.11, 0.14, 1.0, 0.2, 0.33, 0.11],
            [0.2, 0.33, 5.0, 1.0, 3.0, 0.2],
            [0.14, 0.2, 3.0, 0.33, 1.0, 0.14],
            [0.5, 3.0, 9.0, 5.0, 7.0, 1.0],
        ]);
        
        $result1 = $matrix1->multiply($matrix2);
        $result = $result1->toArray();
        $count = 0;
        
        // Sum
        for($i=0; $i<count($result); $i++)
        {
            for($j=0; $j<count($result); $j++)
            {
                $count += $result[$i][$j];
            }
            $eigen[] = $count;
            $count = 0;
        }

        // Get Value eigen
        $eigen[$i] = array_sum($eigen);

        for($k=0; $k<count($eigen); $k++)
        {
            $vector[] = $eigen[$k] / end($eigen);
        }

        return $vector;

    }
}
