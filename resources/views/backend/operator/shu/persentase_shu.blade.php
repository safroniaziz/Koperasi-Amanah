@extends('layouts.backend')
@section('location','Buku Kas Koperasi')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Persentase Pemgagian SHU
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah daftar Persentase Pemgagian SHU dan jasa yang didapatkan oleh setiap anggota
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Persentase Pemgagian SHU</h3>
                    <div class="pull-right">
                        <a href="{{ route('operator.laporan.persentase_generate') }}" class="btn btn-primary btn-sm"><i class="fa fa-refresh fa-spin"></i>&nbsp;Generate Persentase SHU Tahun {{ $year }}</a>
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
                                <th>Tahun</th>
                                <th>Persentase Simpanan</th>
                                <th>Persentase Jasa</th>
                                <th>SHU Tahun Berjalan</th>
                                <th>Pembagian SHU Simpanan</th>
                                <th>Pembagian SHU Jasa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($persentases as $persentase)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $persentase->tahun }}</td>
                                    <td>{{ $persentase->persentase_simpanan }}</td>
                                    <td>{{ $persentase->persentase_jasa }}</td>
                                    <td>Rp.{{ number_format($persentase->shu_tahun_berjalan,2) }}</td>
                                    <td>Rp.{{ number_format($persentase->shu_simpanan,2) }}</td>
                                    <td>Rp.{{ number_format($persentase->shu_jasa_pinjaman,2) }}</td>
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