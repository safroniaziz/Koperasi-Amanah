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
                    <form action="{{ route('operator.laporan.cari_buku_kas') }}" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Bulan Transaksi</label>
                                <select name="bulan" class="form-control" id="bulan">
                                <option disabled selected>-- pilih bulan --</option>
                                @foreach ($bulans as $bulan)
                                    <option value="{{ $bulan['bulan_transaksi'] }}">{{ $bulan['bulan_transaksi'] }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Tahun Transaksi</label>
                                <select name="tahun" id="tahun" class="form-control" required></select>
                            </div>

                            <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Cari Laporan</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Uraian</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=2;
                                $sub1 = 0;
                            @endphp
                            @if (isset($_POST['bulan']))
                                <tr>
                                    <td>1</td>
                                    <td>1 {{ $bulan1 }} {{ $tahun1 }}</td>
                                    <td>Modal Awal</td>
                                    <td>Rp.{{ number_format($modal_awal,2) }}</td>
                                    <td> - </td>
                                    <td>Rp.{{ number_format($modal_awal,2) }}</td>
                                </tr>
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal_transaksi)->format('j F Y') }}</td>
                                            <td>{{ $laporan->nm_transaksi }} - {{ $laporan->nm_anggota }}</td>
                                            <td>
                                                @if ($laporan->jenis_transaksi == "masuk")
                                                    Rp.{{ number_format($laporan->jumlah_transaksi,2) }}
                                                    @else 
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($laporan->jenis_transaksi == "keluar")
                                                    Rp.{{ number_format($laporan->jumlah_transaksi,2) }}
                                                    @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                
                                                @if ($laporan->jenis_transaksi == "masuk")
                                                    Rp.{{ number_format($laporan->jumlah_transaksi + $modal_awal,2) }}
                                                    @php
                                                        $modal_awal = $laporan->jumlah_transaksi + $modal_awal;
                                                    @endphp
                                                    @else
                                                        Rp.{{ number_format($modal_awal - $laporan->jumlah_transaksi,2) }}
                                                    @php
                                                        $modal_awal = $modal_awal - $laporan->jumlah_transaksi;
                                                    @endphp
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                            @endif
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

        $('#tahun').each(function() {
            var year = (new Date()).getFullYear();
            var current = year;
            year -= 3;
            for (var i = 0; i < 6; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });

    </script>
@endpush