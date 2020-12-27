@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;SIMPANAN WAJIB
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data jenis transaksi simpaan wajib yang sudah tersedia, silahkan tambahkan jika ada jenis transaksi simpaan wajib baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Simpanan Wajib</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('operator.simpanan_wajib.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
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
                                <th>Tanggal Pembayaran</th>
                                <th>Bulan Pembayaran</th>
                                <th>Tahun Pembayaran</th>
                                <th>Jumlah Transaksi</th>
                                <th>Operator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($simpanan_wajibs as $simpanan)
                                @php
                                    $timestamp = strtotime($simpanan->tanggal_transaksi);
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $simpanan->nm_anggota }}</td>
                                    <td>{{ date("d", $timestamp) }}</td>
                                    <td>{{ $simpanan->bulan_transaksi }}</td>
                                    <td>{{ $simpanan->tahun_transaksi }}</td>
                                    <td>Rp. {{ number_format($simpanan->jumlah_transaksi,2) }}</td>
                                    <td>{{ $simpanan->nm_operator }}</td>
                                    <td>
                                        <a href="{{ route('operator.simpanan_wajib.edit',[$simpanan->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;</a>
                                    </td>
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
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );
    </script>
@endpush