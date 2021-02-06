<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penerima Bantuan</title>
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

    <div class="pull-right">
        <p>{{ date('d F Y') }}</p>
    </div>

    <p class="p">
        Kami dari <strong>Dinas Koperasi Usaha Kecil dan Menengah Kabupaten Bandung Barat</strong> bermaksud untuk memberikan surat pernyataan penerima bantuan modal usaha kepada :
    </p> 
        
    <!-- Yth -->
    <table style="width: 80%">
        <tr>
            <!-- Nama UMKM -->
            <td>Nama UMKM</td>

            <!-- Kosong -->
            <td>:</td>

            <!-- Nama UMKM (value) -->
            <td>{{ $data->Nama_Usaha }}</td>
        </tr>
        <tr>
            <!-- KTP -->
            <td>Nomor KTP</td>

            <!-- Kosong -->
            <td>:</td>

            <!-- Nama UMKM (value) -->
            <td>{{ $data->KTP }}</td>
        </tr>
        <tr>
            <!-- Nama Pemilik UMKM -->
            <td>Nama Pemilik UMKM</td>

            <!-- Kosong -->
            <td>:</td>

            <!-- Nama Pemilik UMKM (value) -->
            <td>{{ $data->Nama_Pemilik_Usaha }}</td>
        </tr>
        <tr>
            <!-- Alamat UMKM -->
            <td>Alamat</td>

            <!-- Kosong -->
            <td>:</td>

            <!-- Alamat UMKM (value) -->
            <td>{{ $data->Alamat_Jalan . ' ' . $data->Kecamatan  . ' ' . $data->Desa }}</td>
        </tr>
        <tr>
            <!-- Status -->
            <td>Status</td>

            <!-- Kosong -->
            <td>:</td>

            <!-- Status (value) -->
            <td>Menerima Bantuan Modal Usaha</td>
        </tr>

    </table>

    <!--  -->


    <p class="p">
        Demikian surat penerima bantuan modal usaha ini dibuat. Atas perhatian dan kerjasamanya kami sampaikan terimakasih.
    </p>

    <table width="100%" style="margin-top: 250px;">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- TTD -->
            <tr>
                <td colspan="10">
                    <p class="pull-left">&nbsp;</p> 
                </td>

                <td colspan="3">
                    <p class="pull-right" style="margin-right: 35px;">Hormat Kami</p>
                </td>
            </tr>

            <tr>
                <td colspan="10">
                    <p class="pull-left">&nbsp;</p> 
                </td>
                
                <td colspan="3" rowspan="4">
                    <p class="pull-right" style="margin-right: 10px;">Kepala Dinas</p>
                </td>
            </tr>
            
            
        </tbody>
    </table>


</body>
</html>