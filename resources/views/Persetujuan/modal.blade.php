@extends('layouts.modal')

@section('modal-title') <h3><strong>Matriks Priority Determination</strong></h3> @endsection

@section('modal-body')

    <!-- 
        -------- Matriks ------------
        =============================
        Matriks Kepentingan
        [
            [1.0, 3.0, 5.0, 7.0, 2.0],
            [0.33, 1.0, 3.0, 5.0, 0.33],
            [0.2, 0.33, 1.0, 3.0, 0.2],
            [0.14, 0.2, 0.33, 1.0, 0.14],
            [0.5, 3.0, 5.0, 7.0, 1.0],
        ] 
        =============================
    -->

    <table style="width: 100%; height: 200px;">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center">KTP</th>
                <th class="text-center">USIA</th>
                <th class="text-center">Jumlah Karyawan</th>
                <th class="text-center">Aset</th>
                <th class="text-center">Omzet</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>KTP</th>
                <td class="text-center"><strong>1.0</strong></td>
                <td class="text-center">3.0</td>
                <td class="text-center">5.0</td>
                <td class="text-center">7.0</td>
                <td class="text-center">2.0</td>
            </tr>
            <tr>
                <th>Usia</th>
                <td class="text-center">0.33</td>
                <td class="text-center"><strong>1.0</strong></td>
                <td class="text-center">3.0</td>
                <td class="text-center">5.0</td>
                <td class="text-center">0.33</td>
            </tr>
            <tr>
                <th>Jumlah Karyawan</th>
                <td class="text-center">0.2</td>
                <td class="text-center">0.33</td>
                <td class="text-center"><strong>1.0</strong></td>
                <td class="text-center">3.0</td>
                <td class="text-center">0.2</td>
            </tr>
            <tr>
                <th>Aset</th>
                <td class="text-center">0.14</td>
                <td class="text-center">0.2</td>
                <td class="text-center">0.33</td>
                <td class="text-center"><strong>1.0</strong></td>
                <td class="text-center">0.14</td>
            </tr>
            <tr>
                <th>Omzet</th>
                <td class="text-center">0.5</td>
                <td class="text-center">3.0</td>
                <td class="text-center">5.0</td>
                <td class="text-center">7.0</td>
                <td class="text-center"><strong>1.0</strong></td>
            </tr>
        </tbody>
    </table>
   

@endsection 

@section('modal-footer')

    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><strong>TUTUP</strong></button>
    </div>

@endsection 

