@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;MANAJEMEN PROFIL
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut merupakan data Tentang
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i>&nbsp;Tentang</h3>
                    <div class="box-tools pull-right">

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i>&nbsp;Tambah Data Tentang Baru
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                                </div>
                                <form action=" {{ route('operator.profil.add') }} " method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Alamat Lengkap</label>
                                                <input type="text" class="form-control" name="alamat_lengkap">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Visi</label>
                                                <input type="text" class="form-control" name="visi">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Misi</label>
                                                <textarea name="misi" id="misi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                       
                                            <div class="form-group">
                                                <label for="">Telephone</label>
                                                <input type="number"class="form-control" name="telephone">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email </label>
                                                <input type="email"class="form-control" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Facebook</label>
                                                <input type="text" class="form-control" name="facebook">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Insragram</label>
                                                <input type="text" class="form-control" name="instagram">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jumlah Anggota</label>
                                                <input type="text" class="form-control" name="jumlah_anggota">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jumlah Pengurus</label>
                                                <input type="text" class="form-control" name="jumlah_pengurus">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tahun Berdiri</label>
                                                <input type="text" class="form-control" name="tahun_berdiri">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kerja Sama</label>
                                                <input type="text" class="form-control" name="kerja_sama">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="">Foto</label>
                                                <input type="file"class="form-control" onchange="previewFoto()" name="foto">
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

                    @php
                        $count = Count($profils);
                    @endphp
                    @if ($count > 0)
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Perhatian :</strong>  jika ada kesalahan data, anda dapat mengubah dengan menekan tombol ubah tentang !!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <table class="table table-hover">
                                        @foreach ($profils as $profil)
                                            <tr>
                                                <th style="width:150px;">Foto Lembaga</th>
                                                <td style="width:10px;">:</td>
                                                <td>
                                                    <img src="{{ asset($profil->foto) }}" alt="" style="height:100px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:150px;">Nama Lembaga</th>
                                                <td style="width:10px;">:</td>
                                                <td> Koperasi Amanah Sejati </td>
                                            </tr>
                                            <tr>
                                                <th style="width:150px;">Tahun Berdiri</th>
                                                <td style="width:10px;">:</td>
                                                <td> {{ $profil->tahun_berdiri }} </td>
                                            </tr>
                                            <tr>
                                                <th style="width:150px;">Jumlah Kerja Sama</th>
                                                <td style="width:10px;">:</td>
                                                <td> {{ $profil->kerja_sama }} </td>
                                            </tr>
                                            <tr>
                                                <th style="width:150px;">Alamat Lengkap</th>
                                                <td style="width:10px;">:</td>
                                                <td> {{ $profil->alamat_lengkap }} </td>
                                            </tr>
                                           
                                            
                                            
                                            <tr>
                                                <th>
                                                    <a onclick="ubahTentang({{ $profil->id }})" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp; Ubah Tentang</a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th style="width:150px;">Jumlah Anggota</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->jumlah_anggota }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Jumlah Pengurus</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->jumlah_pengurus }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Telephone</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->telephone }} </td>
                                        <tr>
                                            <th style="width:150px;">Email</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->email }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Facebook</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->facebook }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Instagram</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->instagram }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Visi</th>
                                            <td style="width:10px;">:</td>
                                            <td> {{ $profil->visi }} </td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Misi</th>
                                            <td style="width:10px;">:</td>
                                            <td> {!! $profil->misi !!} </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Perhatian :</strong> data belum tersedia, silahkan klik tombol tambah baru terlebih dahulu !!
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Baru
                        </button>
                    @endif

                    <!-- Modal Ubah -->
                    <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i>&nbsp;Ubah Data Tentang Baru
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h5>
                            </div>
                            <form action=" {{ route('operator.profil.update') }} " method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="">Alamat Lengkap</label>
                                            <input type="text" id="alamat_lengkap" class="form-control" name="alamat_lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Visi</label>
                                            <input type="text" id="visi" class="form-control" name="visi">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Misi</label>
                                            <textarea name="misi_edit" id="misi" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Telephone</label>
                                            <input type="number"class="form-control" name="telephone" id="telephone">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email </label>
                                            <input type="email"class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" id="facebook" class="form-control" name="facebook">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Insragram</label>
                                            <input type="text" id="instagram" class="form-control" name="instagram">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah Anggota</label>
                                            <input type="text" id="jumlah_anggota" class="form-control" name="jumlah_anggota">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah Pengurus</label>
                                            <input type="text" id="jumlah_pengurus" class="form-control" name="jumlah_pengurus">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tahun Berdiri</label>
                                            <input type="text" id="tahun_berdiri" class="form-control" name="tahun_berdiri">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kerja Sama</label>
                                            <input type="text" id="kerja_sama" class="form-control" name="kerja_sama">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" id="foto" class="form-control" name="foto">
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
            $('#tabel').DataTable();
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

        function ubahTentang(id){
            $.ajax({
                url: "{{ url('operator/manajemen_profil') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id').val(data.id);
                    $('#alamat_lengkap').val(data.alamat_lengkap);
                    $('#visi').val(data.visi);
                    $('#misi').val(data.misi);
                    $('#telephone').val(data.telephone);
                    $('#email').val(data.email);
                    $('#facebook').val(data.facebook);
                    $('#instagram').val(data.instagram);
                    $('#jumlah_anggota').val(data.jumlah_anggota);
                    $('#jumlah_pengurus').val(data.jumlah_pengurus);
                    $('#tahun_berdiri').val(data.tahun_berdiri);
                    $('#kerja_sama').val(data.kerja_sama);
                    $('#foto').val(data.foto);

                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }
    </script>
@endpush