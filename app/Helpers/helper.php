<?php

use Phpml\Math\Matrix;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helpers
 *
 */

function setActive($path, $active = 'active') 
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function setShow($path, $show = 'show') 
{
    return call_user_func_array('Request::is', (array)$path) ? $show : '';
}

function setSubmenu($path, $submenu = 'submenu') 
{
    return call_user_func_array('Request::is', (array)$path) ? $submenu : '';
}

function formatDate($array) 
{
    $string = date('Y-m-d', strtotime($array));
    return $string;
}

if (! function_exists('num_row')) {
	function num_row($page, $limit) {
		if (is_null($page)) {
			$page = 1;
		}

		$num = ($page * $limit) - ($limit - 1);
		return $num;
	}
}

function rupiah($angka)
{	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}

function getEigen($matrix)
{
    // Get sum array
    for($i=0; $i<count($matrix); $i++)
    {
        $count = 0;
        for($j=0; $j<count($matrix); $j++)
        {
            $count += $matrix[$i][$j];
        }
        $eigen[] = $count;
    }

    // Get Value divider
    $eigen[$i] = array_sum($eigen);

    // Get Eigen
    for($k=0; $k<count($eigen)-1; $k++)
    {
        $vector[] = $eigen[$k] / end($eigen);
    }

    return $vector;

}

function multiply($matrix_a, $matrix_b)
{
    
    for($i=0; $i<count($matrix_a); $i++)
    {
        $result = 0;
        for($j=0; $j<count($matrix_a[0]); $j++)
        {
            $result = ($matrix_a[$i][$j] * $matrix_b[$j]);
            $matrix_result[] = $result;
            // $result = 0;
        }
        // Fix matrix
        $matrix_fix[] = array_sum($matrix_result);
        
        // Unset Matrix
        unset($matrix_result);
    }

    return $matrix_fix;
}

function percent($str)
{
    return $percent = round((float)$str * 100 ) . '%';
}

function percentWithoutPercent($str)
{
    return $percent = round((float)$str * 100 );
}

function hitung($query)
{
    // $query = UMKM::select('umkm.*', 'aset.*')->leftJoin('aset', 'aset.UMKM_Kode', '=', 'umkm.Kode_UMKM')->get();
    foreach($query as $record)
    {
        $data[] = array(
            'KTP' => $record->KTP,
            'Usia' => $record->Tahun_Mulai,
            'Jumlah_Karyawan' => $record->Jumlah_Karyawan,
            'Aset' => $record->Total_Aset,
            'Omzet' => $record->Omzet,
            'SIUM' => $record->Sertifikat,
        );

    }

    /*
        ========= KRITERIA ========
        KTP = 9
        Omzet = 7
        SIUM = 5
        Jumlah Karyawan = 4
        Aset = 3
        Usia = 2
        ===== END OF KRITERIA =====
    */

    // Create Matrix
    for($i=0; $i<count($data); $i++)
    {
        for($j=0; $j<count($data); $j++)
        {
            if($i === $j)
            {
                $matrix_ktp[$i][$j] = 1;
                $matrix_sium[$i][$j] = 1;
                $matrix_usia[$i][$j] = 1;
                $matrix_omzet[$i][$j] = 1;
                $matrix_jk[$i][$j] = 1;
                $matrix_aset[$i][$j] = 1;
            }else{

                // KTP paling penting nomor 1
                if($data[$i]['KTP'] != '')
                {
                    $matrix_ktp[$i][$j] = 9/1;
                    $matrix_ktp[$j][$i] = 1/9;
                }
                else{
                    $matrix_ktp[$i][$j] = 1/9;
                    $matrix_ktp[$j][$i] = 9/1;
                }

                // SIUM paling penting nomor 3
                if($data[$i]['SIUM'] != '')
                {
                    $matrix_sium[$i][$j] = 5/1;
                    $matrix_sium[$j][$i] = 1/5;
                }else{
                    $matrix_sium[$i][$j] = 1/5;
                    $matrix_sium[$j][$i] = 5/1;
                }

                // Usia paling penting nomor 6
                if($data[$i]['Usia'] == '2013' || $data[$i]['Usia'] == '2014')
                {
                    $matrix_usia[$i][$j] = 2/1;
                    $matrix_usia[$j][$i] = 1/2;
                }
                elseif($data[$i]['Usia'] == '2015' || $data[$i]['Usia'] == '2016' || $data[$i]['Usia'] == '2017')
                {
                    $matrix_usia[$i][$j] = 3/1;
                    $matrix_usia[$j][$i] = 1/3;
                }else{
                    $matrix_usia[$i][$j] = 4/1;
                    $matrix_usia[$j][$i] = 1/4;
                }

                // Omzet paling penting nomor 2
                if($data[$i]['Omzet'] >= 50000000 && $data[$i]['Omzet'] <= 100000000)
                {
                    $matrix_omzet[$i][$j] = 7/1;
                    $matrix_omzet[$j][$i] = 1/7;
                }
                elseif($data[$i]['Omzet'] > 100000000 && $data[$i]['Omzet'] <= 150000000)
                {
                    $matrix_omzet[$i][$j] = 6/1;
                    $matrix_omzet[$j][$i] = 6/1;
                }else{
                    $matrix_omzet[$i][$j] = 5/1;
                    $matrix_omzet[$j][$i] = 1/5;
                }
                
                // Jumlah Karyawan paling penting nomor 4
                if($data[$i]['Jumlah_Karyawan'] >= 1 && $data[$i]['Jumlah_Karyawan'] <= 3)
                {
                    $matrix_jk[$i][$j] = 2/1;
                    $matrix_jk[$j][$i] = 1/2;
                }
                elseif($data[$i]['Jumlah_Karyawan'] > 3 && $data[$i]['Jumlah_Karyawan'] <= 6)
                {
                    $matrix_jk[$i][$j] = 3/1;
                    $matrix_jk[$j][$i] = 1/3;
                }else{
                    $matrix_jk[$i][$j] = 4/1;
                    $matrix_jk[$j][$i] = 1/4;
                }

                // Aset paling penting nomor 5
                if($data[$i]['Aset'] >= 10000000 && $data[$i]['Aset'] <= 20000000)
                {
                    $matrix_aset[$i][$j] = 4/1;
                    $matrix_aset[$j][$i] = 1/4;
                }elseif($data[$i]['Aset'] > 20000000 && $data[$i]['Aset'] <= 40000000)
                {
                    $matrix_aset[$i][$j] = 3/1;
                    $matrix_aset[$j][$i] = 1/3;
                }else{
                    $matrix_aset[$i][$j] = 2/1;
                    $matrix_aset[$j][$i] = 1/2;
                }

            }
        }

    }
    
    // =========== Matrix Transpose ============= //

    // Matrix KTP
    $ktp = new Matrix($matrix_ktp);
    $transpose_ktp = $ktp->transpose()->toArray();
    
    // Matrix SIUM
    $sium = new Matrix($matrix_sium);
    $transpose_sium = $sium->transpose()->toArray();

    // Matrix Usia
    $usia = new Matrix($matrix_usia);
    $transpose_usia = $usia->transpose()->toArray();

    // matrix Omzet
    $omzet = new Matrix($matrix_omzet);
    $transpose_omzet = $omzet->transpose()->toArray();

    // Matrix Jumlah Karyawan
    $jk = new Matrix($matrix_jk);
    $transpose_jk = $jk->transpose()->toArray();

    // Matrix Aset
    $aset = new Matrix($matrix_aset);
    $transpose_aset = $aset->transpose()->toArray();

    // ======== End of Matrix Transpose ======== //


    // ============= Matrix Eigen ============= //
    // Eigen CR
    $eigen = new Matrix(eigen());

    // Get Eigen KTP
    $e_ktp = getEigen($transpose_ktp);
    $eigen_ktp = new Matrix($e_ktp);

    // Get Eigen SIUM
    $e_sium = getEigen($transpose_sium);
    $eigen_sium = new Matrix($e_sium);

    // Get Eigen Usia
    $e_usia = getEigen($transpose_usia);
    $eigen_usia = new Matrix($e_usia);

    // Get Eigen Omzet
    $e_omzet = getEigen($transpose_omzet);
    $eigen_omzet = new Matrix($e_omzet);

    // Get Eigen Jumlah Karyawan
    $e_jk = getEigen($transpose_jk);
    $eigen_jk = new Matrix($e_jk);

    // Get Eigen Aset
    $e_aset = getEigen($transpose_aset);
    $eigen_aset = new Matrix($e_aset);

    // ============= Matrix Eigen ============= //
    
    for($i=0; $i<count($e_ktp); $i++)
    {
        // KTP
        $matrix_fix[$i][0] = $e_ktp[$i];
        // Sium
        $matrix_fix[$i][1] = $e_sium[$i];
        // Usia
        $matrix_fix[$i][2] = $e_usia[$i];
        // omzet
        $matrix_fix[$i][3] = $e_omzet[$i];
        // Jumlah Karyawan
        $matrix_fix[$i][4] = $e_jk[$i];
        // Aset
        $matrix_fix[$i][5] = $e_aset[$i];
    }

    $eigen_matrix = eigen();
    $result = multiply($matrix_fix, $eigen_matrix);


    // Return
    return $result;
    
}

function eigen()
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
    
    for($i=0; $i<count($result); $i++)
    {
        $count_col = 0;
        for($j=0; $j<count($result); $j++)
        {
            $count_col += $result[$i][$j];
        }
        $eigen[] = $count_col;
    }

    // Get Value divider
    $eigen[$i] = array_sum($eigen);

    // Get Eigen
    for($k=0; $k<count($eigen)-1; $k++)
    {
        $vector[] = $eigen[$k] / end($eigen);
        // $vector[] = $eigen[$k] / count($result);
    }


    return $vector;
}

