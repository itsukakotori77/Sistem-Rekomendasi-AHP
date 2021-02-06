<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <style>
        .text-center{
            text-align: center;
        }

        .pull-left{
            text-align: left;
        }
        .pull-right{
            text-align: right;
        }

        .table{
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            margin-top: 40px;
        }

        .table2{
            width: 100%;
        }

        .tr{
            border-collapse: collapse;
            border: 1px solid black;
        }

        .th{
            border-collapse: collapse;
            border: 1px solid black;
        }

        .td{
            border-collapse: collapse;
            border: 1px solid black;
        }
        .p{
            margin-top: 50px;
            text-align: justify;
        }

    </style>
</head>
<body>
    <!-- Kop Surat -->
    <header>
        <img src="{{ public_path('assets-back/img/kop-surat.png') }}" style="width: 100%;">
    </header>  
    


    <center><h2>{{ $data['title'] . ' : ' . 'Bulan' . ' ' . date('F', strtotime($data['tanggal'])) }}</h2></center>
    
    <!-- Table -->
    <table class="table">
        <thead>
            <tr class="tr">
                <th class="td">Nomor</th>
                <th class="td">Nama Usaha</th>
                <th class="td">Nama Pemilik Usaha</th>
                <th class="td">KTP</th>
                <th class="td">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['umkm'] as $umkm)    
                <tr class="tr">
                    <td class="td"><p class="text-center">{{ $loop->iteration }}</p></td>
                    <td class="td"><p class="text-center">{{ $umkm->Nama_Usaha }}</p></td>
                    <td class="td"><p class="text-center">{{ $umkm->Nama_Pemilik_Usaha }}</p></td>
                    <td class="td"><p class="text-center">{{ $umkm->KTP }}</p></td>
                    @if($umkm->Status === 3)
                        <td class="td"><p class="text-center">Telah menerima bantuan</p></td>
                    @else 
                        <td class="td"><p class="text-center">Pengajuan bantuan ditolak</p></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
       

    </table>

</body>
</html>