@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Kartu Pinjaman
@endsection
@section('user-login','Anggota')
@section('sidebar-menu')
    @include('backend/anggota/sidebar')
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
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Kartu Pinjaman</h3>
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
                    <form action="{{ route('anggota.laporan.cari_kartu') }}" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->isEmpty())
                                    @else
                                    <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Gagal :</strong> Harap memilih anggota terlebih dahulu
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Nama Anggota</label>
                                <select name="anggota" class="form-control" id="anggota" required>
                                <option disabled selected>-- pilih anggota --</option>
                                @foreach ($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}">{{ $anggota->nm_anggota }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Pilih Pinjaman</label>
                                <select name="pinjaman" id="pinjaman" class="form-control" id="">
                                    <option disabled selected>-- pilih pinjaman --</option>
                                </select>
                                @if ($errors->has('pinjaman'))
                                    <small class="form-text text-danger">{{ $errors->first('pinjaman') }}</small>
                                @endif
                            </div>

                            <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Cari</button>
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
        $(document).on('change','#anggota',function(){
            var anggota = $(this).val();
            // alert(anggota);
            var div = $(this).parent().parent();
            
            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('anggota/laporan/kartu_pinjaman/cari_pinjaman') }}",
            data:{'anggota':anggota},
                success:function(data){
                    // alert(data[i].id);
                    // alert(data['prodi'][0]['dosen'][0]['pegawai'].pegIsAktif);
                    op+='<option value="0" selected disabled>-- pilih pinjaman --</option>';
                    for(var i=0; i<data.length;i++){
                        var ke = 1+i;
                        op+='<option value="'+data[i].id+'">'+'Pinjaman Ke '+ke+'= '+data[i].jumlah_pinjaman+'</option>';
                    }
                    div.find('#pinjaman').html(" ");
                    div.find('#pinjaman').append(op);
                },
                    error:function(){
                }
            });
        })
    </script>
@endpush