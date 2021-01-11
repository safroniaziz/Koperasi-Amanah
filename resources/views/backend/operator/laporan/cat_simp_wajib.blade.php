@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Buku Kas Koperasi
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data jenis transaksi Koperasi yang sudah tersedia, silahkan tambahkan jika ada jenis transaksi Koperasi baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Buku Kas Koperasi</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('operator.transaksi_koperasi.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Berhasil :</strong> {{ $message }}
                        </div>
                    @endif
                    @if($message2 = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-close"></i><strong>Gagal :</strong> {{ $message2 }}
                        </div>
                    @endif
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Jumlah Bulan</th>
                                <th>Jumlah Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                         @php
                             $no=1;
                         @endphp
                           @foreach ($laporans as $laporan)
                               <tr>
                                   <td>{{ $no++ }}</td>
                                   <td>{{ $laporan->nm_anggota }}</td>
                                   <td>{{ $laporan->jumlah_bulan }}</td>
                                   <td>{{ $laporan->jumlah_transaksi }}</td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                   
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        $('#kelas').DataTable({
            "oLanguage": {
              "sSearch": "Cari Data :",
              "sZeroRecords": "Tidak Ada Data Ditampilkan",
              "sProcessing": "<i class='fa fa-spinner fa-1x fa-fw' style='color:black !important;'></i>&nbsp; Memuat. Harap Tunggu.. !!",
              "sEmptyTable": 'Tidak Ada Data Yang Dimuat',
              "sLengthMenu": 'Menampikan: <select>'+
                '<option value="10">10</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '<option value="-1">Semua</option>'+
                '</select> Data',
                "sInfoFiltered": " - Filter Dari _MAX_ Data",
                "sInfo": "Mendapatkan _START_ - _END_ Data Untuk Ditampilkan Dari Total _TOTAL_ Data",
                "sInfoEmpty": "Mendapatkan 0 Sampai 0 Dari 0Data ",
                "oPaginate": {
                    "sPrevious": "Sebelumnya", 
                    "sNext": "Selanjutnya", 
                }
            },
            dom: 'lBfrtip',
            buttons: [
                { extend:'excel', text:'<i class="fa fa-file-excel-o"></i>&nbsp;Export Excel', className:'btn-export-excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ],
                    },
                },
            ],
        });
    </script>
@endpush