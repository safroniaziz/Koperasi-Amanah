@extends('layouts.backend')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;MANAJEMEN DATA OPERATOR
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data operator yang sudah tersedia, silahkan tambahkan jika ada operator baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Operator</h3>
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
                                <form action=" {{ route('operator.manajemen_operator.post') }} " method="POST">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Operator</label>
                                                <input type="text" name="nm_operator" class="form-control @error('nm_operator') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                @if ($errors->has('nm_operator'))
                                                    <small class="form-text text-danger">{{ $errors->first('nm_operator') }}</small>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jabatan</label>
                                                <select name="jabatan_id" class="form-control" id="">
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
                                <th>Nama Operator</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Status Operator</th>
                                <th>Ubah Status</th>
                                <th>Ubah Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($operators as $operator)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $operator->nm_operator }}</td>
                                    <td>{{ $operator->nm_jabatan }}</td>
                                    <td>{{ $operator->email }}</td>
                                    </td>
                                    <td>
                                        @if ($operator->status_operator == "1")
                                            <label for="" class="label label-primary"><i class="fa fa-check-circle"></i>&nbsp;Aktif</label>
                                            @else
                                            <label for="" class="label label-danger"><i class="fa fa-thumbs-up"></i>&nbsp;Tidak Aktif</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($operator->status_operator == "1")
                                            <form action="{{ route('operator.manajemen_operator.nonaktifkan_status', [$operator->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-danger btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-down"></i></button>
                                            </form>
                                            @else
                                            <form action="{{ route('operator.manajemen_operator.aktifkan_status', [$operator->id]) }}" method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-primary btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-thumbs-up"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" onclick="ubahPassword({{ $operator->id }})"><i class="fa fa-key"></i></a>
                                    </td>
                                    <td>
                                        <a onclick="ubahOperator({{ $operator->id }})" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;</a>
                                        <a onclick="hapusOperator({{ $operator->id }})" class="btn btn-danger btn-sm">
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
                                            <form action=" {{ route('operator.manajemen_operator.update') }} " method="POST">
                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id_edit">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Operator</label>
                                                            <input type="text" name="nm_operator" id="nm_operator" class="form-control @error('nm_operator') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('nm_operator'))
                                                                <small class="form-text text-danger">{{ $errors->first('nm_operator') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Jabatan</label>
                                                            <select name="jabatan_id" id="jabatan_id" class="form-control" id="">
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
                                                            <label for="exampleInputEmail1">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="masukan jenis transaksi">
                                                            @if ($errors->has('email'))
                                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
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
                                    <form method="POST" action="{{ route('operator.manajemen_operator.delete') }}">
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
                <form method="POST" action="{{ route('operator.manajemen_operator.update_password') }}">
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
                url: "{{ url('operator/manajemen_operator') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id_edit').val(id);
                    $('#nm_operator').val(data.nm_operator);
                    $('#jabatan_id').val(data.jabatan_id);
                    $('#email').val(data.email);
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