@extends('layouts.backend')
@section('location','Buku Kas Koperasi')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan SHU Anggota
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah daftar shu yang didapatkan setiap anggota
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Daftar SHU Anggota</h3>
                    <div class="pull-right">
                        <a href="{{ route('operator.laporan.generate_shu') }}" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i>&nbsp; Generate SHU Anggota Tahun 2021</a>
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
                    <form action="{{ route('operator.laporan.lihat_shu') }}" method="GET">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Pilih Tahun Untuk Ditampilkan</label>
                                    <select name="tahun" id="tahun" class="form-control" required></select>
                                </div>  
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Lihat Laporan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (isset($shus))
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box" style="background-color: #d2d6de;">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-save"></i></span>
                
                            <div class="info-box-content">
                              <span class="info-box-text">Jumlah Shu Simpanan</span>
                              <span class="info-box-number">
                                    @if (!empty($jumlah_simpanan))
                                    Rp.{{ number_format($jumlah_simpanan->jumlah) }},-
                                    @endif  
                                <small></small></span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box" style="background-color: #d2d6de;">
                            <span class="info-box-icon bg-red"><i class="fa fa-check-circle"></i></span>
                
                            <div class="info-box-content">
                              <span class="info-box-text">umlah Shu Jasa</span>
                              <span class="info-box-number">
                                @if (!empty($jumlah_jasa))
                                Rp.{{ number_format($jumlah_jasa->jumlah) }},-
                                @endif  
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>
                
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box" style="background-color: #d2d6de;">
                            <span class="info-box-icon bg-green"><i class="fa fa-plus"></i></span>
                
                            <div class="info-box-content">
                              <span class="info-box-text">Total Keseluruhan</span>
                              <span class="info-box-number">
                                @if (!empty($jumlah_simpanan) && !empty($jumlah_jasa))
                                Rp.{{ number_format($jumlah_simpanan->jumlah + $jumlah_jasa->jumlah) }},-
                                @endif  

                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                     
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                
                    @endif
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Jabatan</th>
                                <th>SHU Simpanan</th>
                                <th>SHU Jasa</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($shus))
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($shus as $shu)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $shu->nm_anggota }}</td>
                                        <td>{{ $shu->jabatan }}</td>
                                        <td>Rp.{{ number_format($shu->shu_simpanan,2) }}</td>
                                        <td>Rp.{{ number_format($shu->shu_jasa,2) }}</td>
                                        <td>Rp.{{ number_format($shu->shu_jasa + $shu->shu_simpanan,2) }}</td>
                                    </tr>
                                @endforeach
                                @else
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
            year -= 5;
            for (var i = 0; i < 10; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });

    </script>
@endpush