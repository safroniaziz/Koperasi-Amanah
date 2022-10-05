@extends('layouts.backend')
@section('location','Tabelaris')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Buku Kas Pembantu
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Buku Kas Pembantu</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('operator.transaksi_koperasi.add') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
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
                            <strong>Gagal :</strong> {{ $message2 }}
                        </div>
                    @endif
                    <form action="{{ route('operator.laporan.cari_tabelaris') }}" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->isEmpty())
                                    @else
                                    <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Gagal :</strong> Harap memilih bulan dan tahun terlebih dahulu
                                    </div>
                                @endif
                            </div>
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
                                <button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i>&nbsp; Cari Laporan</button>
                            </div>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
