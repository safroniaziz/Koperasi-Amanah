@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Buku Kas Pembantu
@endsection
@section('user-login','Anggota')
@section('sidebar-menu')
    @include('backend/anggota/sidebar')
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Buku Kas Pembantu</h3>
                 
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
                            <strong>Gagal :</strong> {{ $message2 }}
                        </div>
                    @endif
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Bulan Transaksi</th>
                                <th>Tahun Transaksi</th>
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
                                   <td>{{ $laporan->bulan_transaksi }}</td>
                                   <td>{{ $laporan->tahun_transaksi }}</td>
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
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script>

$(document).ready(function() {
        var table = $('#kelas').DataTable( {
            buttons: [ 'copy','csv','print', 'excel', 'pdf', 'colvis' ],
            dom: 
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu:[
                [5,10,25,50,100,-1],
                [5,10,25,50,100,"All"]
            ]
        } );
    
        table.buttons().container()
            .appendTo( '#kelas_wrapper .col-md-5:eq(0)' );
    } );
    </script>
@endpush