@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;MANAJEMEN JABATAN
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data jabatan yang sudah tersedia, silahkan tambahkan jika ada jabatan baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Berhasil :</strong> {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('operator.modal_awal.post') }}" method="post">
                        {{ csrf_field() }} {{ method_field("POST") }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Masukan Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control" required></select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Masukan Bulan Berupa Angka <a style="color:red">01,02........12</a></label>
                                    <input type="text" name="bulan" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Masukan Nominal Modal Awal <a style="color:red">Angka Tanpa Titik</a></label>
                                    <input type="text" name="modal_awal" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-12" style="text-align:center">
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>&nbsp; Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Simpan Modal Awal</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Modal Awal</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($modal_awals as $modal)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $modal->tahun }}</td>
                                    <td>{{ $modal->bulan }}</td>
                                    <td>{{ number_format($modal->modal_awal,2) }}</td>
                                    </td>
                                    <td>
                                        <form action="{{ route('operator.modal_awal.delete',[$modal->id]) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
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
