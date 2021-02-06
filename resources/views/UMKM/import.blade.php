@extends('layouts.app')

@section('content')

    <div class="content">
        <!-- Header -->
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">UMKM</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url('/dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Import UMKM</a>
                    </li>
                </ul>
            </div>

            <!-- Tables -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <div class="card-title">Data UMKM</div>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/umkm') }}" class="btn btn-info btn-sm"><strong>KEMBALI</strong></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ol>
                                <li>Pastikan format dari file adalah CSV dengan dengan dukungan karakter UTF-8</li>
                                <li>Maksimal data yang dapat diimport <strong>200 record data</strong></li>
                                <li>Download contoh data <strong>XLSX</strong><a href="{{ asset('data/contoh-data/Dataset-1.xlsx') }}" download> download</a></li>
                                <li>Download contoh data <strong>CSV</strong><a href="{{ asset('data/contoh-data/Dataset-1.csv') }}" download> download</a></li>
                                <li>Disarankan untuk melakukan convert data ke format CSV di link ini <a href="https://convertio.co/id/xlsx-csv/">https://convertio.co/id/xlsx-csv/</a></li>
                                <li>Data yang diimport, akan langsung tersambung dengan data aset</li>
                            </ol>

                            <div class="row">
                                    
                                <div class="col-sm-6">
                                    <form action="{{ url('/umkm/import') }}" method="POST" enctype="multipart/form-data" id="formUpload">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group">
                                            <label for="">Import Data UMKM <span style="color: #FF0000;">*</span></label>
                                            <input type="file" class="form-control" required name="CSV" id="CSV">
                                        </div>

                                        <div class="pull-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm"><strong>SUBMIT</strong></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection 

@section('js')
    
    <script>

        // Jquery Validator
        $("#formUpload").validate({
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('form-text text-muted');
                element.closest('.form-group').append(error);
            }
        });
                                    
        @if(session('message'))
            var content = {};
            content.title = 'Notifikasi';
            content.message = '{{ session("message") }}';
            content.icon = 'fa fa-bell';
            content.target = '_blank';

            $.notify(content,{
                type: 'success',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 3000,
                delay: 0,
            });
        @endif
    </script>

@stop 