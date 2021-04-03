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
        
        tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
</head>
<body>
    <div class="text-center">
        <h4 style="font-family: sans-serif !important">KARTU PINJAMAN</h4>
    </div>
    <div>
        <table>
            <tr>
                <th>Nama Anggota</th>
                <th> : </th>
                <td>{{ $anggota->nm_anggota }}</td>
            </tr>
            <tr>
                <th>Jumlah Pinjaman</th>
                <th> : </th>
                @if (!empty($saldo))
                    <td>Rp. {{ number_format($saldo->jumlah_pinjaman,2) }}</td>
                @endif
            </tr>
            <hr>
        </table>
    </div>
    <table class="table table-bordered table-hover" id="kelas">
        <thead>
            <tr>
                <th rowspan="2">Tanggal Transaksi</th>
                <th rowspan="2">Uraian</th>
                <th rowspan="2">Ke</th>
                <th colspan="3">Angsuran</th>
                <th colspan="3">Saldo</th>
                <th rowspan="2">Paraf Petugas</th>
            </tr>
            <tr>
                <th>Pokok</th>
                <th>Jasa</th>
                <th>Denda</th>
                <th>Pokok</th>
                <th>Jasa</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no=1;
                if (!empty($saldo)) {
                    $modal_awal = $saldo->jumlah_pinjaman;
                }
                if (!empty($saldo)) {
                    $bunga_awal = $saldo->jumlah_angsuran_bunga * $saldo->jumlah_bulan;
                }
            @endphp
          
            @if (isset($_POST['anggota']))
                    @foreach ($angsuran as $angsuran)
                        <tr>
                        <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_transaksi)->format('j F Y') }}</td>
                            <td>Pengembalian Pinjaman</td>
                            <td>{{ $no++ }}</td>
                            <td>Rp.{{ number_format($saldo->jumlah_angsuran_pokok,2) }}</td>
                            <td>Rp.{{ number_format($saldo->jumlah_angsuran_bunga,2) }}</td>
                            <td>-</td>
                            <td>{{ $modal_awal - $saldo->jumlah_angsuran_pokok }}</td>
                            @php
                                $modal_awal = $modal_awal - $saldo->jumlah_angsuran_pokok;
                            @endphp
                            <td>{{ $bunga_awal - $saldo->jumlah_angsuran_bunga}}</td>
                            @php
                                $bunga_awal = $bunga_awal - $saldo->jumlah_angsuran_bunga;
                            @endphp
                            <td>-</td>
                            <td></td>
                        </tr>
                    @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>