@extends('layouts.modal')

@section('modal-title') <h3><strong>Detail UMKM</strong></h3> @endsection

@section('modal-body')

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail UMKM <strong id="Nama_UMKM"></strong></h3>
                </div>
                <div class="card-body">
                    <p>Tahun Mulai : <strong id="Tahun_Mulai"></strong></p>
                    <p>No Telp : <strong id="No_Telp"></strong></p>
                    <p>Jumlah SDM : <strong id="Jumlah_SDM"></strong></p>
                    <p>Total Aset : <strong id="Total_Aset"></strong></p>
                    <p>Omzet : <strong id="Omzet"></strong></p>
                    <p>Wilayah Pemasaran : <strong id="Wilayah_Pemasaran"></strong></p>
                </div>
            </div>
        </div>
    </div>

@endsection 

@section('modal-footer')

    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><strong>TUTUP</strong></button>
    </div>

@endsection 

