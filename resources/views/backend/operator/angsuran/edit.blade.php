@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;SIMPANAN WAJIN
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info text-center">
        <h4>Perhatian!</h4>
        <p>
            Silahkan tambahkan data transaksi pada form di bawah ini, harap untuk teliti agar tidak terjadi kesalahan dalam proses pengisian data !!
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-left">
                        <a href="{{ route('operator.transaksi_angsuran') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong> {{ $message }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('operator.transaksi_angsuran.update') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <div class="form-group col-md-4">
                                <input type="hidden" name="id" value="{{ $transaksi->id }}">
                                <label for="exampleInputEmail1">Pilih Anggota</label>
                                <select name="anggota_id" class="form-control" id="anggota_id">
                                    <option disabled selected>-- pilih anggota --</option>
                                    @foreach ($anggotas as $anggota)
                                        <option {{ $anggota->id == $transaksi->anggota_id ? 'selected' : '' }} value="{{ $anggota->id }}">{{ $anggota->nm_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Bulan Transaksi</label>
                                <select name="bulan_transaksi" class="form-control" id="bulan">
                                <option disabled selected>-- pilih bulan --</option>
                                @foreach ($bulans as $bulan)
                                    <option {{ $bulan['bulan_transaksi'] == $transaksi->bulan_transaksi ? 'selected' : '' }} value="{{ $bulan['bulan_transaksi'] }}">{{ $bulan['bulan_transaksi'] }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tahun Transaksi</label>
                                <select name="tahun_transaksi" id="tahun_transaksi" va class="form-control" required></select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Angsuran </label>
                                <input type="text" name="jumlah_transaksi" value="{{ $transaksi->jumlah_transaksi }}" class="form-control">
                            </div>

                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger"> <strong>Perhatian : </strong> Silahkan isi semua form lalu klik simpan </div>
                                @endif
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i>&nbsp; Ulangi</button>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Simpan</button>
                            </div>
                        </form>
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

        $('#tahun_transaksi').each(function() {
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


        $(document).ready(function(){
            $("#jumlah_transaksi").keyup(function(){
                var jumlah_transaksi = $("#jumlah_transaksi").val();
                if (jumlah_transaksi >15000000) {
                    $('#alert').show();
                }
                else{
                    $('#alert').hide();
                }
            });
        });

        $(document).on('change','#anggota_id',function(){
            var anggota_id = $(this).val();
            $.ajax({
            type :'get',
            url: "{{ url('operator/transaksi_angsuran/cari_angsuran') }}",
            data:{'anggota_id':anggota_id},
                success:function(data){
                    $('#jumlah_angsuran_pokok').val(data.jumlah_angsuran_pokok);
                    $('#jumlah_angsuran_bunga').val(data.jumlah_angsuran_bunga);
                },
                    error:function(){
                }
            });
        })
    </script>
@endpush
