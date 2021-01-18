@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;MANAJEMEN DATA ANGGOTA
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data anggota yang sudah tersedia, silahkan tambahkan jika ada anggota baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Anggota</h3>
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
                                <form action=" {{ route('operator.manajemen_anggota.post') }} " method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Anggota</label>
                                                <input type="text" name="nm_anggota" class="form-control @error('nm_anggota') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('nm_anggota'))
                                                    <small class="form-text text-danger">{{ $errors->first('nm_anggota') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jabatan</label>
                                                <select name="jabatan" class="form-control" @error('jabatan') is-invalid @enderror>
                                                    <option disabled selected>-- pilih jabatan --</option>
                                                    @foreach ($jabatans as $jabatan)
                                                        <option value="{{ $jabatan->id }}">{{ $jabatan->nm_jabatan }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('jabatan'))
                                                    <small class="form-text text-danger">{{ $errors->first('jabatan') }}</small>
                                                @endif
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK</label>
                                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('nik'))
                                                    <small class="form-text text-danger">{{ $errors->first('nik') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <textarea name="alamat" class="form-control" id="" cols="30" rows="5"></textarea>
                                                @if ($errors->has('alamat'))
                                                    <small class="form-text text-danger">{{ $errors->first('alamat') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tahun Keanggotaan</label>
                                                <input type="date" name="tahun_keanggotaan" class="form-control @error('tahun_keanggotaan') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('tahun_keanggotaan'))
                                                    <small class="form-text text-danger">{{ $errors->first('tahun_keanggotaan') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('email'))
                                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password Login</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('password'))
                                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">Foto</label>
                                                <input type="file"class="form-control" onchange="previewFoto2()" name="foto">
                                            </div>

                                            <div class="form-group">
                                                <img class="foto-baru2" id="preview-foto2" src="" height="100" width="100" alt="" style="font-size:12px;">
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
                                <th>Nama Anggota</th>
                                <th>Foto</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Tahun Keanggotaan</th>
                                <th>email</th>
                                <th>Status Anggota</th>
                                <th>Ubah Status</th>
                                <th>Ubah Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($anggotas as $anggota)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $anggota->nm_anggota }}</td>
                                    <td>
                                        <img src="{{ asset($anggota->gambar) }}" alt="" height="50px;">
                                    </td>
                                    <td>{{ $anggota->nik }}</td>
                                    <td>{{ $anggota->alamat }}</td>
                                    <td>{{ $anggota->tahun_keanggotaan }}</td>
                                    <td>{{ $anggota->email }}</td>
                                    </td>
                                    <td>
                                        @if ($anggota->status_anggota == "1")
                                            <label for="" class="label label-primary"><i class="fa fa-check-circle"></i>&nbsp;Aktif</label>
                                            @else
                                            <label for="" class="label label-danger"><i class="fa fa-thumbs-up"></i>&nbsp;Tidak Aktif</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($anggota->status_anggota == "1")
                                            <form action="{{ route('operator.manajemen_anggota.nonaktifkan_status', [$anggota->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-danger btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-down"></i></button>
                                            </form>
                                            @else
                                            <form action="{{ route('operator.manajemen_anggota.aktifkan_status', [$anggota->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-primary btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-up"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" onclick="ubahPassword({{ $anggota->id }})"><i class="fa fa-key"></i></a>
                                    </td>
                                    <td>
                                        <a onclick="ubahOperator({{ $anggota->id }})" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;</a>
                                        <a onclick="hapusOperator({{ $anggota->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
                                            <form action=" {{ route('operator.manajemen_anggota.update') }} " method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id_edit">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Anggota</label>
                                                            <input type="text" name="nm_anggota" id="nm_anggota" class="form-control @error('nm_anggota') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('nm_anggota'))
                                                                <small class="form-text text-danger">{{ $errors->first('nm_anggota') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jabatan</label>
                                                            <select name="jabatan" class="form-control" id="jabatan" @error('jabatan') is-invalid @enderror>
                                                                <option disabled selected>-- pilih jabatan --</option>
                                                                @foreach ($jabatans as $jabatan)
                                                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nm_jabatan }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('jabatan'))
                                                                <small class="form-text text-danger">{{ $errors->first('jabatan') }}</small>
                                                            @endif
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">NIK</label>
                                                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('nik'))
                                                                <small class="form-text text-danger">{{ $errors->first('nik') }}</small>
                                                            @endif
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Alamat</label>
                                                            <textarea name="alamat" id="alamat" class="form-control" id="" cols="30" rows="5"></textarea>
                                                            @if ($errors->has('alamat'))
                                                                <small class="form-text text-danger">{{ $errors->first('alamat') }}</small>
                                                            @endif
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tahun Keanggotaan</label>
                                                            <input type="date" name="tahun_keanggotaan" id="tahun_keanggotaan" class="form-control @error('tahun_keanggotaan') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('tahun_keanggotaan'))
                                                                <small class="form-text text-danger">{{ $errors->first('tahun_keanggotaan') }}</small>
                                                            @endif
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('email'))
                                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Foto</label>
                                                            <input type="file"class="form-control" id="file2" onchange="previewFoto()" name="foto">
                                                        </div>
            
                                                        <div class="form-group">
                                                            <img class="foto-baru" id="preview-foto" src="" height="100" width="100" alt="" style="font-size:12px;">
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
                    </table>safroni.aziz@gmail.com	
                    <div class="modal fade" id="modalhapus">
                        <div class="modal-dialog modal-danger">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;Perhatian</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Apakah anda yakin ingin menghapus data?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('operator.manajemen_anggota.delete') }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="id" id="id_delete">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Kembali</button>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="modal fade" id="ubahpassword">
                <form method="POST" action="{{ route('operator.manajemen_anggota.update_password') }}">
                    {{ csrf_field() }} {{ method_field('PATCH') }}
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-circle"></i>&nbsp;Ubah Password Operator<b id="nm_investor"></b></h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="text" name="id" id="id_password">
                                <input type="text" class="form-control password1" name="password1" id="password1" placeholder="Masukan Password Baru" required>
                            </div>
                            <div class="form-group">
                                <label for="examplenputPassword1">Ulangi Password Baru </label>
                                <input type="text" class="form-control password_baru" id="password2" name="password_baru" placeholder="Ulangi Masukan Password Baru" required>
                                <div class="alert alert-success" id="password_benar" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <i class="fa fa-check-circle"></i>&nbsp;<strong style="font-style:italic;">Password Sama !</strong>
                                </div>
                                <div class="alert alert-danger" id="password_salah" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <i class="fa fa-close"></i>&nbsp;<strong style="font-style:italic;">Password Tidak Sama !</strong>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                            <button type="submit" id="btn_submit" class="btn btn-primary btn_save" disabled><i class="fa fa-check-circle"></i>&nbsp;Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );

        function hapusOperator(id) {
            $('#modalhapus').modal('show');
            $('#id_delete').val(id);
        }

        function previewFoto() {
            var preview = document.querySelector('#preview-foto');
            var file    = document.querySelector('#file2').files[0];
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

        function previewFoto2() {
            var preview = document.querySelector('#preview-foto2');
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

        $(document).ready(function(){
            $("#password1, #password2").keyup(function(){
                var password = $("#password1").val();
                var ulangi = $("#password2").val();
                if($("#password1").val() == $("#password2").val()){
                    $('#password_benar').show();
                    $('#password_salah').hide();
                    $('#btn_submit').attr("disabled",false);
                }
                else{
                    $('#password_benar').hide();
                    $('#password_salah').show();
                    $('#btn_submit').attr("disabled",true);
                }
            });
        });

        function ubahOperator(id){
            $.ajax({
                url: "{{ url('operator/manajemen_anggota') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id_edit').val(id);
                    $('#nm_anggota').val(data.nm_anggota);
                    $('#nik').val(data.nik);
                    $('#alamat').val(data.alamat);
                    $('#tahun_keanggotaan').val(data.tahun_keanggotaan);
                    $('#email').val(data.email);
                    $('#jabatan').val(data.jabatan_id);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        function ubahPassword(id) {
            $('#ubahpassword').modal('show');
            $('#id_password').val(id);
        }

        @if($errors->any())
            $('#modaltambah').modal('show');
        @endif
    </script>
@endpush