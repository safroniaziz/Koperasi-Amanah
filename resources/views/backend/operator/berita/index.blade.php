@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;MANAJEMEN BERITA DAN PENGUMUMAN
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut merupakan data Berita & Pengumuman
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-newspaper-o"></i>&nbsp;Berita & Pengumuman</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Baru
                        </button>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa newspaper-o"></i>&nbsp;Tambah Data Berita & Pengumuman Baru
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                                </div>
                                <form action=" {{ route('operator.berita.add') }} " method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="">Judul Berita</label>
                                                <input type="text" name="judul" class="form-control" placeholder="Judul Berita" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Isi</label>
                                                <textarea name="isi" cols="30" rows="3" class="form-control" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Gambar</label>
                                                <input type="file" name="gambar" onchange="previewFoto()" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <img class="foto-baru" id="preview-foto" src="" height="100" width="100" alt="" style="font-size:12px;">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
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
                    <table class="table table-bordered table-hover" id="berita">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Waktu Posting</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($beritas as $berita)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $berita->judul }} </td>
                                    <td> {{ $berita->isi }} </td>
                                    <td>
                                        <img src="{{ asset($berita->gambar) }}" alt="" height="50px;">
                                    </td>
                                    <td>
                                        {{ $berita->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a onclick="ubahBerita({{ $berita->id }})" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;</a>
                                        <a onclick="hapusBerita({{ $berita->id }})" class=" btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>

                                        <div class="modal modal-danger fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header modal-header-danger">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>&nbsp;Konfirmasi hapus data
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                  Apakah anda yakin akan menghapus data?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close</button>
                                                    <form method="POST" action="{{ route('operator.berita.delete', [$berita->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <input type="hidden" name="id" id="id_hapus" >
                                                        <button type="submit" class="btn btn-outline"><i class="fa fa-check-circle"></i>&nbsp; Ya, Hapus Data !</button>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal Ubah -->
                    <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa newspaper-o"></i>&nbsp;Ubah Data Keunggulan Baru
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h5>
                            </div>
                            <form action=" {{ route('operator.berita.update') }} " method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label for="">Judul Berita</label>
                                            <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan Judul Berita" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Isi</label>
                                            <textarea name="isi" id="isi" cols="30" rows="10" class="form-control" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <input type="file" id="gambar" name="gambar" class="form-control" placeholder="Masukkan Gambar">
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
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#berita').DataTable();
        } );
        function previewFoto() {
            var preview = document.querySelector('#preview-foto');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
            preview.src = reader.result;
            }

            if (file) {
            reader.readAsDataURL(file);
            } else {
            preview.src = "";
            }
        }
        function ubahBerita(id){
            $.ajax({
                url: "{{ url('operator/manajemen_berita') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#isi').val(data.isi);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }
        function hapusBerita(id){
            $('#modalhapus').modal('show');
            $('#id_hapus').val(id);
        }
    </script>
@endpush