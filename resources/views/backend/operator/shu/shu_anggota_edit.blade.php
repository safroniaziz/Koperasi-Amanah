@extends('layouts.backend')
@section('location','Buku Kas Pembantu')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Edit SHU Anggota
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i>&nbsp;Manajemen Edit Data Tugas</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Berhasil :</strong>{{ $message }}
                        </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Gagal :</strong>{{ $message }}
                            </div>
                    @endif
                </div>

                <div class="row">
                    <form action="{{ route('operator.laporan.shu_anggota.update',[$data->id]) }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group col-md-6">
                            <label for="">Pilih Anggota</label>
                            <select name="anggota_id" class="form-control" id="">
                                <option disabled selected>-- pilih anggota --</option>
                                @foreach ($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" @if ($anggota->id == $data->anggota_id)
                                        selected
                                    @endif>{{ $anggota->nm_anggota }}</option>
                                @endforeach
                            </select>
                            <div>
                                @if ($errors->has('anggota_id'))
                                    <small class="form-text text-danger">{{ $errors->first('anggota_id') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Pilih Tahun Untuk Ditampilkan</label>
                            <select name="tahun" id="tahun" class="form-control"></select>
                            <div>
                                @if ($errors->has('tahun'))
                                    <small class="form-text text-danger">{{ $errors->first('tahun') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Jumlah SHU Simpanan <a style="color:red">Angka tanpa koma dan titik</a></label>
                            <input type="number" name="shu_simpanan" value="{{ $data->shu_simpanan }}" class="form-control" id="">
                            <div>
                                @if ($errors->has('shu_simpanan'))
                                    <small class="form-text text-danger">{{ $errors->first('shu_simpanan') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Jumlah SHU Jasa <a style="color:red">Angka tanpa koma dan titik</a></label>
                            <input type="number" name="shu_jasa" value="{{ $data->shu_jasa }}" class="form-control" id="">
                            <div>
                                @if ($errors->has('shu_jasa'))
                                    <small class="form-text text-danger">{{ $errors->first('shu_jasa') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Jumlah SHU Ditetima <a style="color:red">Angka tanpa koma dan titik</a></label>
                            <input type="number" name="jumlah" value="{{ $data->jumlah }}" class="form-control" id="">
                            <div>
                                @if ($errors->has('jumlah'))
                                    <small class="form-text text-danger">{{ $errors->first('jumlah') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12" style="text-align: center">
                                <a href="{{ route('operator.laporan.shu_anggota') }}" class="btn btn-warning btn-sm" style="color: white"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                            <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Ulangi</button>
                            <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'assignmentMessage' );
    </script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $('#tahun').each(function() {
            var year = (new Date()).getFullYear();
            var current = year;
            year -= 10;
            for (var i = 0; i < 11; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });
    </script>
@endpush
