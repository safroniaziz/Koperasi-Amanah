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
                        <a href="{{ route('operator.pinjaman') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <i class="fa fa-close"></i><strong>Gagal :</strong> {{ $message }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('operator.pinjaman.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Pilih Anggota</label>
                                <select name="anggota_id" class="form-control" id="anggota_id">
                                    <option disabled selected>-- pilih anggota --</option>
                                    @foreach ($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}">{{ $anggota->nm_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Transaksi <a style="display: none;" id="alert" class="text-danger">Maksimal Rp.15.000.000</a></label>
                                <input type="number" id="jumlah_transaksi" name="jumlah_transaksi" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Bulan Transaksi</label>
                                <select name="bulan_transaksi" class="form-control" id="bulan">
                                <option disabled selected>-- pilih bulan --</option>
                                @foreach ($bulans as $bulan)
                                    <option value="{{ $bulan['bulan_transaksi'] }}">{{ $bulan['bulan_transaksi'] }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tahun Transaksi</label>
                                <input type="text" name="tahun_transaksi" value="{{ $tahun }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Bulan Angsuran</label>
                                <select name="jumlah_bulan" id="jumlah_bulan" class="form-control" id="">
                                    <option disabled selected>-- pilih jumlah bulan --</option>
                                    <option value="12">12 Bulan</option>
                                    <option value="24">24 Bulan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Persenan Bunga (%)</label>
                                <input type="text" name="bunga" id="bunga" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Angsuran Pokok / Bulan</label>
                                <input type="text" name="jumlah_angsuran_pokok" id="jumlah_angsuran_pokok" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Angsuran Bunga / Bulan</label>
                                <input type="text" name="jumlah_angsuran_bunga" id="jumlah_angsuran_bunga" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Bulan Mulai Angsuran</label>
                                <select name="bulan_mulai_angsuran" class="form-control" id="bulan_mulai_angsuran">
                                    <option disabled selected>-- pilih bulan --</option>
                                    @foreach ($bulans as $bulan)
                                        <option value="{{ $bulan['bulan_transaksi'] }}">{{ $bulan['bulan_transaksi'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tahun Mulai Angsuran</label>
                                <select name="tahun_mulai_angsuran" id="tahun_mulai_angsuran" class="form-control" required></select>
                            </div>
                          
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger"> <strong>Perhatian : </strong> Silahkan isi semua form lalu klik simpan </div>
                                @endif
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i>&nbsp; Ulangi</button>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Simpan</button>
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

        $('#tahun_mulai_angsuran').each(function() {
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

        $(document).ready(function(){
            $("#jumlah_transaksi").keyup(function(){
                var jumlah_transaksi = $("#jumlah_transaksi").val();
                $('#jumlah_angsuran_pokok').val("");
                $('#jumlah_angsuran_bunga').val("");
                $('#jumlah_bulan').val("");
                $(document).on('change','#jumlah_bulan',function(){
                    // alert('berhasil');
                    var jumlah_bulan = $('#jumlah_bulan').val();
                    var jumlah = jumlah_transaksi / jumlah_bulan;
                    if (jumlah_bulan == "12") {
                        var bunga = ((jumlah_transaksi *7) /100) / jumlah_bulan;
                        $('#bunga').val("7");
                    }
                    else{
                        var bunga = ((jumlah_transaksi *14) /100) / jumlah_bulan;
                        $('#bunga').val("14");
                    }
                    $('#jumlah_angsuran_pokok').val(jumlah);
                    $('#jumlah_angsuran_bunga').val(bunga);
                })
            });
        });
     
    </script>
@endpush