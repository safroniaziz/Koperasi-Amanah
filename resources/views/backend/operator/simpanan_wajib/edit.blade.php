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
                        <a href="{{ route('operator.simpanan_wajib') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.simpanan_wajib.update') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <input type="hidden" name="id" value="{{ $transaksi->id }}">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jenis Transaksi</label>
                                <select name="jenis_transaksi_id" class="form-control" id="">
                                    <option disabled selected>-- pilih jenis transaksi --</option>
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Pilih Anggota</label>
                                <select name="anggota_id" class="form-control" id="anggota_id">
                                    @foreach ($anggotas as $anggota)
                                        <option {{ $anggota->id == $transaksi->anggota_id ? 'selected' : '' }} value="{{ $anggota->id }}">{{ $anggota->nm_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Jumlah Transaksi</label>
                                <input type="number" name="jumlah_transaksi" value="25000" readonly class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Bulan Transaksi</label>
                                <select name="bulan_transaksi" class="form-control" id="bulan">
                                <option disabled selected>-- pilih bulan --</option>
                                  
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Tahun Transaksi</label>
                                <input type="text" name="tahun_transaksi" value="{{ $transaksi->tahun_transaksi }}" class="form-control">
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

        $(document).on('change','#anggota_id',function(){
            var anggota_id = $(this).val();
            var div = $(this).parent().parent();
            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('operator/simpanan_wajib/cari_bulan') }}",
            data:{'anggota_id':anggota_id},
                success:function(data){
                    op+='<option value="0" selected disabled>-- pilih bulan --</option>';
                    for(var i=0; i<data.length;i++){
                        // alert(data[i].id);
                        // alert(data['jenis_publikasi'][i].anggota_id);
                        op+='<option value="'+data[i].bulan_transaksi+'">'+data[i].bulan_transaksi+'</option>';
                    }
                    div.find('#bulan').html(" ");
                    div.find('#bulan').append(op);
                },
                    error:function(){
                }
            });
        })
    </script>
@endpush