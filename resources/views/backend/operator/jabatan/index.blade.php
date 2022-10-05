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
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data jabatan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Baru
                        </button>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i>&nbsp;Tambah Data Kelas Baru
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                                </div>
                                <form action=" {{ route('operator.jabatan.post') }} " method="POST">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Jabatan</label>
                                                <input type="text" name="nm_jabatan" class="form-control @error('nm_jabatan') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('nm_jabatan'))
                                                    <small class="form-text text-danger">{{ $errors->first('nm_jabatan') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                            <button type="submit" class="btn btn-primary" id="btn-submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Status Jabatan</th>
                                <th>Ubah Status</th>
                                <th>Ubah Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($jabatans as $jabatan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $jabatan->nm_jabatan }}</td>
                                    </td>
                                    <td>
                                        @if ($jabatan->status_jabatan == "1")
                                            <label for="" class="label label-primary"><i class="fa fa-check-circle"></i>&nbsp;Aktif</label>
                                            @else
                                            <label for="" class="label label-danger"><i class="fa fa-thumbs-up"></i>&nbsp;Tidak Aktif</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($jabatan->status_jabatan == "1")
                                            <form action="{{ route('operator.jabatan.nonaktifkan_status', [$jabatan->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-danger btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-down"></i></button>
                                            </form>
                                            @else
                                            <form action="{{ route('operator.jabatan.aktifkan_status', [$jabatan->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-primary btn-sm btn-flat" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-up"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a onclick="ubahJabatan({{ $jabatan->id }})" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;</a>
                                    </td>
                                    <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i>&nbsp;Tambah Data Kelas Baru
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>
                                            </div>
                                            <form action=" {{ route('operator.jabatan.update') }} " method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id_edit">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Jabatan</label>
                                                            <input type="text" name="nm_jabatan" id="nm_jabatan" class="form-control @error('nm_jabatan') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('nm_jabatan'))
                                                                <small class="form-text text-danger">{{ $errors->first('nm_jabatan') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

        function ubahJabatan(id){
            $.ajax({
                url: "{{ url('operator/manajemen_jabatan') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id_edit').val(id);
                    $('#nm_jabatan').val(data.nm_jabatan);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        @if($errors->any())
            $('#modaltambah').modal('show');
        @endif
    </script>
@endpush
