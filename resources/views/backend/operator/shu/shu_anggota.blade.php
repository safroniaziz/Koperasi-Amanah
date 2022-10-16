@extends('layouts.backend')
@section('location','Buku Kas Pembantu')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data SHU Anggota
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('backend/operator/sidebar')
@endsection
@push('styles')
    <style>
        #chartdiv, #chartdiv2 {
            width: 100%;
            height: 350px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Data SHU Anggota</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                    <form action="{{ route('operator.laporan.simpan') }}" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Pilih Anggota</label>
                                        <select name="anggota_id" class="form-control" id="">
                                            <option disabled selected>-- pilih anggota --</option>
                                            @foreach ($anggotas as $anggota)
                                                <option value="{{ $anggota->id }}">{{ $anggota->nm_anggota }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @if ($errors->has('anggota_id'))
                                                <small class="form-text text-danger">{{ $errors->first('anggota_id') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="">Pilih Tahun Untuk Ditampilkan</label>
                                        <select name="tahun" id="tahun" class="form-control"></select>
                                        <div>
                                            @if ($errors->has('tahun'))
                                                <small class="form-text text-danger">{{ $errors->first('tahun') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Jumlah SHU Pinjaman <a style="color:red">Angka tanpa koma dan titik</a></label>
                                        <input type="number" name="shu_simpanan" class="form-control" id="shu_simpanan">
                                        <div>
                                            @if ($errors->has('shu_simpanan'))
                                                <small class="form-text text-danger">{{ $errors->first('shu_simpanan') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Jumlah SHU Jasa <a style="color:red">Angka tanpa koma dan titik</a></label>
                                        <input type="number" name="shu_jasa" class="form-control" id="shu_jasa">
                                        <div>
                                            @if ($errors->has('shu_jasa'))
                                                <small class="form-text text-danger">{{ $errors->first('shu_jasa') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Jumlah SHU Diterima <a style="color:red">Angka tanpa koma dan titik</a></label>
                                        <input type="number" name="jumlah" class="form-control" id="jumlah" readonly>
                                        <div>
                                            @if ($errors->has('jumlah'))
                                                <small class="form-text text-danger">{{ $errors->first('jumlah') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12" style="text-align: center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i>&nbsp; Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @section('charts')
                                    var data = [
                                        @foreach ($jumlah as $data)
                                            {
                                                "country": "{{ $data['nm_anggota'] }}",
                                                "value": {{ $data['jumlah'] }}
                                            },
                                        @endforeach
                                    ];
                                @endsection
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </form>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Shu Pinjaman Seluruh</span>
                              <span class="info-box-number">Rp.{{ number_format($total_simpanan->total) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Shu Jasa Seluruh</span>
                              <span class="info-box-number">Rp.{{ number_format($total_jasa->total) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Shu Diterima Seluruh</span>
                              <span class="info-box-number">Rp.{{ number_format($total_diterima->total) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Jabatan</th>
                                    <th>SHU Pinjaman</th>
                                    <th>SHU Jasa</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
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
                                            <td>Rp.{{ number_format($shu->shu_simpanan) }}</td>
                                            <td>Rp.{{ number_format($shu->shu_jasa) }}</td>
                                            <td>Rp.{{ number_format($shu->shu_jasa + $shu->shu_simpanan) }}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                          <a href="{{ route('operator.laporan.shu_anggota.edit',[$shu->id]) }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                                                        </td>
                                                        <td>
                                                          <form action="{{ route('operator.laporan.shu_anggota.delete',[$shu->id]) }}" method="POST">
                                                                {{ csrf_field() }} {{ method_field("DELETE") }}
                                                        <a href="" onClick="return confirm('Apakah anda yakin menghapus data ini?')"/><button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i>&nbsp; Hapus</button></a>

                                                          </form>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
            });
        } );

        $(document).ready(function(){
            $("#shu_simpanan, #shu_jasa").keyup(function(){
                var shu_simpanan = $("#shu_simpanan").val();
                var shu_jasa = $("#shu_jasa").val();
                var shu_diterima = parseInt(shu_simpanan)+parseInt(shu_jasa);
                $('#jumlah').val(shu_diterima);

            });
        });
    </script>
    <script>
        $('#tahun').each(function() {
            var year = (new Date()).getFullYear();
            var current = year;
            year -= 10;
            for (var i = 0; i < 11; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });

    </script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
        am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX:true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation: 0.3,
        categoryField: "country",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.3,
        renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        sequencedInterpolation: true,
        categoryXField: "country",
        tooltip: am5.Tooltip.new(root, {
            labelText:"{valueY}"
        })
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
        series.columns.template.adapters.add("fill", function(fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        @yield('charts')
        xAxis.data.setAll(data);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endpush
