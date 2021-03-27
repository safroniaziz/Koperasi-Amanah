<li class="header" style="font-weight:bold;">Dashboard Pengguna</li>
<li class="{{ set_active('anggota.dashboard') }}">
    <a href="{{ route('anggota.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('anggota.laporan.buku_kas') }}">
    <a href="{{ route('anggota.laporan.buku_kas') }}">
        <i class="fa fa-book"></i> <span>Buku Kas Koperasi</span>
    </a>
</li>
<li class="{{ set_active('anggota.laporan.tabelaris') }}">
    <a href="{{ route('anggota.laporan.tabelaris') }}">
        <i class="fa fa-book"></i> <span>Tabelaris</span>
    </a>
</li>

<li class="{{ set_active('anggota.laporan.pinjaman') }}">
    <a href="{{ route('anggota.laporan.pinjaman') }}">
        <i class="fa fa-id-card"></i> <span>Kartu Pinjaman</span>
    </a>
</li>

<li class="{{ set_active('anggota.laporan.cat_simp_wahub') }}">
    <a href="{{ route('anggota.laporan.cat_simp_wajib') }}">
        <i class="fa fa-book"></i> <span>Catatan Simpanan Wajib</span>
    </a>
</li>

<li class="{{ set_active('anggota.laporan.shu') }}">
    <a href="{{ route('anggota.laporan.shu') }}">
        <i class="fa fa-file-pdf-o"></i> <span>Laporan SHU</span>
    </a>
</li>

<li class="">
    <a href="">
        <i class="fa fa-power-off text-danger"></i> <span class="text-danger">Keluar</span>
    </a>
</li>
