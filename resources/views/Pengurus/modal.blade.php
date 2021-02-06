@extends('layouts.modal')

@section('modal-title') <h3><strong>Data detail pengurus</strong></h3> @endsection

@section('modal-body')
    
    <form action="">
        <div class="row">
            <!-- Coloum 4 -->
            <div class="col-sm-8">
                <!-- Nama -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Nama Depan</label>
                            <input type="text" readonly class="form-control" id="Nama_Depan" name="Nama_Depan">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Nama Belakang</label>
                            <input type="text" readonly class="form-control" id="Nama_Belakang" name="Nama_Belakang">
                        </div>
                    </div>
                </div>
                <!-- Alamat -->
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="Alamat" readonly id="Alamat" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>

            <!-- IMG -->
            <div class="col-sm-4">
                <div class="text-center">
                    <label for=""><strong>Foto Pengurus</strong></label>
                    <img src="" id="Foto-User" style="width:100%">
                </div>
            </div>

        </div>
    </form>

@endsection 

@section('modal-footer')

    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><strong>TUTUP</strong></button>
    </div>

@endsection 

