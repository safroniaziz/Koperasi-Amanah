<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
          border-collapse: collapse;
          width: 100%;
        }
        
        th, td {
          text-align: left;
          padding: 8px;
        }
        
        .tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
</head>
<body>
    <div>
        <h2 style="text-align: center">Catatan Tabelaris Pada Bulan {{ $bulan1 }} Tahun {{ $tahun1 }}</h2>
    </div>
    <table class="table table-bordered table-hover" id="kelas">
        <thead class="bg-primary">
            <tr class="tr">
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Uraian</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no=2;
                $sub1 = 0;
            @endphp
            @if (isset($_POST['bulan']))
                <tr class="tr">
                    <td>1</td>
                    <td>1 {{ $bulan1 }} {{ $tahun1 }}</td>
                    <td>Modal Awal</td>
                    <td>Rp.{{ number_format($modal_awal,2) }}</td>
                    <td> - </td>
                    <td>Rp.{{ number_format($modal_awal,2) }}</td>
                </tr>
                    @foreach ($laporans as $laporan)
                        <tr class="tr">
                            <td>{{ $no++ }}</td>
                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal_transaksi)->format('j F Y') }}</td>
                            <td>{{ $laporan->nm_transaksi }} - {{ $laporan->nm_anggota }}</td>
                            <td>
                                @if ($laporan->jenis_transaksi == "masuk")
                                    Rp.{{ number_format($laporan->jumlah_transaksi,2) }}
                                    @else 
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($laporan->jenis_transaksi == "keluar")
                                    Rp.{{ number_format($laporan->jumlah_transaksi,2) }}
                                    @else
                                    -
                                @endif
                            </td>
                            <td>
                                
                                @if ($laporan->jenis_transaksi == "masuk")
                                    Rp.{{ number_format($laporan->jumlah_transaksi + $modal_awal,2) }}
                                    @php
                                        $modal_awal = $laporan->jumlah_transaksi + $modal_awal;
                                    @endphp
                                    @else
                                    <style>
                                        table {
                                          border-collapse: collapse;
                                          width: 100%;
                                        }
                                        
                                        th, td {
                                          text-align: left;
                                          padding: 8px;
                                        }
                                        
                                        tr:nth-child(even) {background-color: #f2f2f2;}
                                        </style>   Rp.{{ number_format($modal_awal - $laporan->jumlah_transaksi,2) }}
                                    @php
                                        $modal_awal = $modal_awal - $laporan->jumlah_transaksi;
                                    @endphp
                                @endif
                            </td>
                        </tr>
                    @endforeach
            @endif
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: 40%; text-align:center;">Mengetahui</td>
            <td></td>
            <td style="width:30%;text-align:center !important;">Bengkulu, {{ \Carbon\Carbon::parse($time)->format('j F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center">Ketua Koperasi Amanah Sejati</td>
            <td style="text-align: center"></td>
            <td style="text-align: center">Bendahara</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: center">
                @if (!empty($ketua))
                    {{ $ketua->nm_jabatan }}
                @endif
            </td>
            <td></td>
            <td style="text-align: center">
                @if (!empty($sekretaris))
                    {{ $sekretaris->nm_jabatan }}
                @endif
            </td>
        </tr>
    </table>

</body>
</html>