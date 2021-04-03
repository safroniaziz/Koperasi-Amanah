@extends('layouts.backend')
@section('location','Buku Kas Koperasi')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Simpanan/Jasa
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah daftar simpanan dan jasa yang didapatkan oleh setiap anggota
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Daftar Simpanan/Jasa</h3>
                    <div class="pull-right">
                        <a href="{{ route('operator.laporan.simp_jasa_generate') }}" class="btn btn-primary btn-sm"><i class="fa fa-refresh fa-spin"></i>&nbsp;Generate Simpanan Jasa Tahun {{ $year }}</a>
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
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Jumlah Simpanan</th>
                                <th>Jumlah Jasa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($simpanans as $simpanan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $simpanan->nm_anggota }}</td>
                                    <td>Rp.{{ number_format($simpanan->jumlah_simpanan,2) }}</td>
                                    <td>Rp.{{ number_format($simpanan->jumlah_jasa,2) }}</td>
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