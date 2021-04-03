@extends('layouts.backend')
@section('location','Catatan Simpanan Wajib')
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
                    <table class="table table-bordered table-hover kelas" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Jumlah Bulan</th>
                                <th>Jumlah Transaksi</th>
                                <th>Detail</th>
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
                                   <td>
                                       <a onclick="detail({{ $laporan->anggota_id }})" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i>&nbsp; Detail Informasi</a>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                   <!-- Modal Ubah -->
                   <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-book"></i>&nbsp;Informasi Detail Catatan Simpanan Wajib
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-block" id="berhasil">
                                            
                                            <strong><i class="fa fa-info-circle"></i>&nbsp;Data Simpanan Wajib Terurut Dari Awal Sampai Akhir</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" id="kelas2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Bulan Transaksi</td>
                                                    <td>Tahun Transaksi</td>
                                                    <td>Jumlah Transaksi</td>
                                                    <td>Jenis Transaksi</td>
                                                </tr>
                                            </thead>
                                            <tbody id="detail">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="font-size:13px;"><i class="fa fa-close"></i>&nbsp;Keluar</button>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );

        function detail(anggota_id){
            $.ajax({
                url: "{{ url('operator/laporan/catatan_simpanan_wajib') }}"+'/'+ anggota_id + "/detail",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modaldetail').modal('show');
                    var no=1;
                    var res='';
                    $.each (data, function (key, value) {
                        res +=
                        '<tr>'+
                            '<td>'+no+++'</td>'+
                            '<td>'+value.bulan_transaksi+'</td>'+
                            '<td>'+value.tahun_transaksi+'</td>'+
                            '<td>'+value.jumlah_transaksi+'</td>'+
                            '<td>'+value.jenis_transaksi+'</td>'+
                        '</tr>';
                    });
                    $('#detail').html(res);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }
    </script>
@endpush