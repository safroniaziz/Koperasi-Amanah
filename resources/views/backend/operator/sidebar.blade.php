<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>

    <li class="{{ set_active('operator.jenis_transaksi') }}">
        <a href="{{ route('operator.jenis_transaksi') }}">
            <i class="fa fa-save"></i> <span>Jenis Transaksi</span>
        </a>
    </li>
    <li class="treeview {{ set_active(['operator.simpanan_wajib','operator.simpanan_wajib.add','operator.simpanan_wajib.edit','operator.pinjaman','operator.pinjaman.add','operator.pinjaman.edit','operator.transaksi_angsuran','operator.transaksi_angsuran.add','operator.transaksi_angsuran.edit','operator.transaksi_koperasi','operator.transaksi_koperasi.add','operator.transaksi_koperasi.edit']) }}">
        <a href="#">
            <i class="fa fa-university"></i> <span>Data Transaksi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu ">
            <li class="{{ set_active(['operator.simpanan_wajib','operator.simpanan_wajib.add','operator.simpanan_wajib.add']) }}"><a href="{{ route('operator.simpanan_wajib') }}"><i class="fa fa-save"></i>Simpanan Wajib</a></li>
            <li class="{{ set_active(['operator.pinjaman','operator.pinjaman.add','operator.pinjaman.edit']) }}"><a href="{{ route('operator.pinjaman') }}"><i class="fa fa-save"></i>Pinjaman</a></li>
            <li class="{{ set_active(['operator.transaksi_angsuran','operator.transaksi_angsuran.add','operator.transaksi_angsuran.edit']) }}"><a href="{{ route('operator.transaksi_angsuran') }}"><i class="fa fa-save"></i>Transaksi Angsuran</a></li>
            <li class="{{ set_active(['operator.transaksi_koperasi','operator.transaksi_koperasi.add','operator.transaksi_koperasi.edit']) }}"><a href="{{ route('operator.transaksi_koperasi') }}"><i class="fa fa-save"></i>Transaksi Koperasi</a></li>
        </ul>
    </li>
</li>

<li class="header" style="font-weight:bold;">LAPORAN</li>
<li class="{{ set_active('operator.laporan.buku_kas') }}">
    <a href="{{ route('operator.laporan.buku_kas') }}">
        <i class="fa fa-book"></i> <span>Buku Kas Koperasi</span>
    </a>
</li>
<li class="{{ set_active('operator.laporan.tabelaris') }}">
    <a href="{{ route('operator.laporan.tabelaris') }}">
        <i class="fa fa-book"></i> <span>Tabelaris</span>
    </a>
</li>

<li class="{{ set_active('operator.laporan.pinjaman') }}">
    <a href="{{ route('operator.laporan.pinjaman') }}">
        <i class="fa fa-id-card"></i> <span>Kartu Pinjaman</span>
    </a>
</li>

<li class="{{ set_active('operator.laporan.buku_kas') }}">
    <a href="{{ route('operator.laporan.cat_simp_wajib') }}">
        <i class="fa fa-book"></i> <span>Catatan Simpanan Wajib</span>
    </a>
</li>

<li class="treeview {{ set_active(['operator.laporan.simp_jasa','operator.laporan.shu_tahun_berjalan','operator.laporan.persentase_shu','operator.laporan.shu_anggota','operator.laporan.lihat_shu']) }}">
    <a href="#">
        <i class="fa fa-university"></i> <span>Sisa Hasil Usaha (SHU)</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu ">
        <li class="{{ set_active(['operator.laporan.simp_jasa']) }}"><a href="{{ route('operator.laporan.simp_jasa') }}"><i class="fa fa-save"></i>Daftar Simpanan Jasa</a></li>
        <li class="{{ set_active(['operator.laporan.shu_tahun_berjalan']) }}"><a href="{{ route('operator.laporan.shu_tahun_berjalan') }}"><i class="fa fa-save"></i>SHU Tahun Berjalan</a></li>
        <li class="{{ set_active(['operator.laporan.persentase_shu']) }}"><a href="{{ route('operator.laporan.persentase_shu') }}"><i class="fa fa-save"></i>Persentase Pembagian SHU</a></li>
        <li class="{{ set_active(['operator.laporan.shu_anggota','operator.laporan.lihat_shu']) }}"><a href="{{ route('operator.laporan.shu_anggota') }}"><i class="fa fa-save"></i>SHU Anggota</a></li>
    </ul>
</li>

<li class="header" style="font-weight:bold;">PENGATURAN</li>
<li class="treeview {{ set_active(['operator.manajemen_operator','operator.manajemen_operator.add','operator.manajemen_operator.edit','operator.manajemen_anggota','operator.manajemen_anggota.add','operator.manajemen_anggota.edit']) }}">
    <a href="#">
        <i class="fa fa-cog"></i> <span>Pengaturan Pengguna</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu ">
        <li class="{{ set_active(['operator.manajemen_operator','operator.manajemen_operator.add','operator.manajemen_operator.add']) }}"><a href="{{ route('operator.manajemen_operator') }}"><i class="fa fa-user"></i>Pengaturan Operator</a></li>
        <li class="{{ set_active(['operator.manajemen_anggota','operator.manajemen_anggota.add','operator.manajemen_anggota.edit']) }}"><a href="{{ route('operator.manajemen_anggota') }}"><i class="fa fa-users"></i>Pengaturan Anggota</a></li>
    </ul>
</li>

<li class="{{ set_active('operator.jabatan') }}">
    <a href="{{ route('operator.jabatan') }}">
        <i class="fa fa-briefcase"></i> <span>Manajemen Jabatan</span>
    </a>
</li>

<li class="header" style="font-weight:bold;">INFORMASI WEBSITE</li>
<li class="treeview {{ set_active(['operator.profil','operator.berita','operator.testimonial','operator.visi','operator.misi','operator.layanan','operator.slider']) }}">
    <a href="#">
        <i class="fa fa-info-circle"></i> <span>Pengaturan Informasi</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active('operator.slider') }}"><a href="{{ route('operator.slider') }}"><i class="fa fa-sliders"></i>Slider</a></li>
        <li class="{{ set_active('operator.profil') }}"><a href="{{ route('operator.profil') }}"><i class="fa fa-check-circle"></i>Profil</a></li>
        <li class="{{ set_active('operator.berita') }}"><a href="{{ route('operator.berita') }}"><i class="fa fa-newspaper-o"></i>Berita dan Pengumunan</a></li>
    </ul>
</li>

<li class="">
    <a href="{{ route('home') }}">
        <i class="fa fa-globe"></i> <span>Kunjungi Website</span>
    </a>
</li>

<li class="">
    <a href="">
        <i class="fa fa-power-off text-danger"></i> <span class="text-danger">Keluar</span>
    </a>
</li>
