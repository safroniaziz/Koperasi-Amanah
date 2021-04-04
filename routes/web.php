<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/berita/detail/{id}','FrontendController@beritaDetail')->name('berita.detail');
Route::get('/berita_pengumuman','FrontendController@berita')->name('berita');
// Auth::routes();

Route::get('/operator',function(){
    return redirect()->route('operator.login');
});

Route::group(['prefix' => 'operator'], function () {
    Route::get('/login', 'Auth\LoginOperatorController@showLoginForm')->name('operator.login');
    Route::post('/login', 'Auth\LoginOperatorController@login')->name('operator.login.submit');
    Route::get('/dashboard','Operator\DashboardOperatorController@dashboard')->name('operator.dashboard');
});

Route::group(['prefix' => 'operator/jenis_transaksi'], function () {
    Route::get('/','Operator\JenisTransaksiController@index')->name('operator.jenis_transaksi');
    Route::post('/tambah','Operator\JenisTransaksiController@post')->name('operator.jenis_transaksi.post');
    Route::get('/{id}/edit','Operator\JenisTransaksiController@edit')->name('operator.jenis_transaksi.edit');
    Route::patch('/update','Operator\JenisTransaksiController@update')->name('operator.jenis_transaksi.update');

    Route::patch('/aktifkan_status/{id}','Operator\JenisTransaksiController@aktifkanStatus')->name('operator.jenis_transaksi.aktifkan_status');
    Route::patch('/nonaktifkan_status/{id}','Operator\JenisTransaksiController@nonAktifkanStatus')->name('operator.jenis_transaksi.nonaktifkan_status');
});

Route::group(['prefix' => 'operator/manajemen_jabatan'], function () {
    Route::get('/','Operator\JabatanController@index')->name('operator.jabatan');
    Route::post('/tambah','Operator\JabatanController@post')->name('operator.jabatan.post');
    Route::get('/{id}/edit','Operator\JabatanController@edit')->name('operator.jabatan.edit');
    Route::patch('/update','Operator\JabatanController@update')->name('operator.jabatan.update');

    Route::patch('/aktifkan_status/{id}','Operator\JabatanController@aktifkanStatus')->name('operator.jabatan.aktifkan_status');
    Route::patch('/nonaktifkan_status/{id}','Operator\JabatanController@nonAktifkanStatus')->name('operator.jabatan.nonaktifkan_status');
});

Route::group(['prefix' => 'operator/simpanan_wajib'], function () {
    Route::get('/','Operator\SimpananWajibController@index')->name('operator.simpanan_wajib');
    Route::get('/tambah','Operator\SimpananWajibController@add')->name('operator.simpanan_wajib.add');
    Route::post('/tambah','Operator\SimpananWajibController@post')->name('operator.simpanan_wajib.post');
    Route::get('/{id}/edit','Operator\SimpananWajibController@edit')->name('operator.simpanan_wajib.edit');
    Route::patch('/update','Operator\SimpananWajibController@update')->name('operator.simpanan_wajib.update');
    Route::get('/cari_bulan','Operator\SimpananWajibController@cariBulan')->name('admin.simpanan_wajib.cari_bulan');
});

Route::group(['prefix' => 'operator/pinjaman'], function () {
    Route::get('/','Operator\PinjamanController@index')->name('operator.pinjaman');
    Route::get('/tambah','Operator\PinjamanController@add')->name('operator.pinjaman.add');
    Route::post('/tambah','Operator\PinjamanController@post')->name('operator.pinjaman.post');
    Route::get('/{id}/edit','Operator\PinjamanController@edit')->name('operator.pinjaman.edit');
    Route::patch('/update','Operator\PinjamanController@update')->name('operator.pinjaman.update');
    Route::get('/cari_bulan','Operator\PinjamanController@cariBulan')->name('admin.pinjaman.cari_bulan');
});

Route::group(['prefix' => 'operator/transaksi_angsuran'], function () {
    Route::get('/','Operator\AngsuranController@index')->name('operator.transaksi_angsuran');
    Route::get('/tambah','Operator\AngsuranController@add')->name('operator.transaksi_angsuran.add');
    Route::post('/tambah','Operator\AngsuranController@post')->name('operator.transaksi_angsuran.post');
    Route::get('/{id}/edit','Operator\AngsuranController@edit')->name('operator.transaksi_angsuran.edit');
    Route::patch('/update','Operator\AngsuranController@update')->name('operator.transaksi_angsuran.update');
    Route::get('/cari_angsuran','Operator\AngsuranController@cariAngsuran')->name('admin.transaksi_angsuran.cari_angsuran');
});

Route::group(['prefix' => 'operator/transaksi_koperasi'], function () {
    Route::get('/','Operator\TransaksiKoperasiController@index')->name('operator.transaksi_koperasi');
    Route::get('/tambah','Operator\TransaksiKoperasiController@add')->name('operator.transaksi_koperasi.add');
    Route::post('/tambah','Operator\TransaksiKoperasiController@post')->name('operator.transaksi_koperasi.post');
    Route::get('/{id}/edit','Operator\TransaksiKoperasiController@edit')->name('operator.transaksi_koperasi.edit');
    Route::patch('/update','Operator\TransaksiKoperasiController@update')->name('operator.transaksi_koperasi.update');
    Route::get('/cari_angsuran','Operator\TransaksiKoperasiController@cariAngsuran')->name('admin.transaksi_koperasi.cari_angsuran');
});

Route::group(['prefix' => 'operator/laporan/buku_kas_koperasi'], function () {
    Route::get('/','Operator\LaporanController@bukuKas')->name('operator.laporan.buku_kas');
    Route::post('/','Operator\LaporanController@cariBukuKas')->name('operator.laporan.cari_buku_kas');
});

Route::group(['prefix' => 'operator/laporan/tabelaris'], function () {
    Route::get('/','Operator\LaporanController@tabelaris')->name('operator.laporan.tabelaris');
    Route::post('/','Operator\LaporanController@cariTabelaris')->name('operator.laporan.cari_tabelaris');
});

Route::group(['prefix' => 'operator/laporan/kartu_pinjaman'], function () {
    Route::get('/','Operator\LaporanController@pinjaman')->name('operator.laporan.pinjaman');
    Route::post('/cetak_kartu_pinjaman','Operator\LaporanController@cariKartu')->name('operator.laporan.cari_kartu');
});

Route::group(['prefix' => 'operator/laporan/catatan_simpanan_wajib'], function () {
    Route::get('/','Operator\LaporanController@catSimpWajib')->name('operator.laporan.cat_simp_wajib');
    Route::get('/{anggota_id}/detail','Operator\LaporanController@detailSimpWajib')->name('operator.laporan.detail_simp_wajib');
});

Route::group(['prefix' => 'operator/laporan/sisa_hasil_usaha'], function () {
    Route::get('/simpanan_jasa','Operator\LaporanShuController@simpJasa')->name('operator.laporan.simp_jasa');
    Route::get('/simpanan_jasa_generate','Operator\LaporanShuController@generateSimpJasa')->name('operator.laporan.simp_jasa_generate');
    Route::get('/shu_tahun_berjalan','Operator\LaporanShuController@shuTahunBerjalan')->name('operator.laporan.shu_tahun_berjalan');
    Route::get('/tahun_berjalan_generate','Operator\LaporanShuController@generateTahunBerjalan')->name('operator.laporan.tahun_berjalan_generate');
    Route::get('/persentase_shu','Operator\LaporanShuController@persentaseShu')->name('operator.laporan.persentase_shu');
    Route::get('/persentase_generate','Operator\LaporanShuController@generatePersentase')->name('operator.laporan.persentase_generate');
    Route::get('/shu_anggota','Operator\LaporanShuController@shuAnggota')->name('operator.laporan.shu_anggota');
    Route::get('/lihat_shu','Operator\LaporanShuController@lihatShu')->name('operator.laporan.lihat_shu');
    Route::get('/generate_shu','Operator\LaporanShuController@generateShu')->name('operator.laporan.generate_shu');

});

Route::group(['prefix' => 'anggota/laporan/buku_kas_koperasi'], function () {
    Route::get('/','Anggota\LaporanController@bukuKas')->name('anggota.laporan.buku_kas');
    Route::post('/','Anggota\LaporanController@cariBukuKas')->name('anggota.laporan.cari_buku_kas');
});

Route::group(['prefix' => 'anggota/laporan/tabelaris'], function () {
    Route::get('/','Anggota\LaporanController@tabelaris')->name('anggota.laporan.tabelaris');
    Route::post('/','Anggota\LaporanController@cariTabelaris')->name('anggota.laporan.cari_tabelaris');
});

Route::group(['prefix' => 'anggota/laporan/kartu_pinjaman'], function () {
    Route::get('/','Anggota\LaporanController@pinjaman')->name('anggota.laporan.pinjaman');
    Route::post('/cetak_kartu_pinjaman','Anggota\LaporanController@cariKartu')->name('anggota.laporan.cari_kartu');
});

Route::group(['prefix' => 'anggota/laporan/catatan_simpanan_wajib'], function () {
    Route::get('/','Anggota\LaporanController@catSimpWajib')->name('anggota.laporan.cat_simp_wajib');
});

Route::group(['prefix' => 'anggota/laporan/sisa_hasil_usaha'], function () {
    Route::get('/','Anggota\LaporanController@shu')->name('anggota.laporan.shu');
    Route::get('/lihat_shu','Anggota\LaporanController@lihatShu')->name('anggota.laporan.lihat_shu');
});

Route::group(['prefix' => 'operator/manajemen_operator'], function () {
    Route::get('/','Operator\ManajemenOperatorController@index')->name('operator.manajemen_operator');
    Route::post('/tambah','Operator\ManajemenOperatorController@post')->name('operator.manajemen_operator.post');
    Route::get('/{id}/edit','Operator\ManajemenOperatorController@edit')->name('operator.manajemen_operator.edit');
    Route::patch('/update','Operator\ManajemenOperatorController@update')->name('operator.manajemen_operator.update');
    Route::delete('/hapus','Operator\ManajemenOperatorController@delete')->name('operator.manajemen_operator.delete');
    Route::patch('/ubah_password','Operator\ManajemenOperatorController@updatePassword')->name('operator.manajemen_operator.update_password');

    Route::patch('/aktifkan_status/{id}','Operator\ManajemenOperatorController@aktifkanStatus')->name('operator.manajemen_operator.aktifkan_status');
    Route::patch('/nonaktifkan_status/{id}','Operator\ManajemenOperatorController@nonAktifkanStatus')->name('operator.manajemen_operator.nonaktifkan_status');
});

Route::group(['prefix' => 'operator/manajemen_anggota'], function () {
    Route::get('/manajemen_anggota','Operator\ManajemenAnggotaController@index')->name('operator.manajemen_anggota');
    Route::post('/tambah','Operator\ManajemenAnggotaController@post')->name('operator.manajemen_anggota.post');
    Route::get('/{id}/edit','Operator\ManajemenAnggotaController@edit')->name('operator.manajemen_anggota.edit');
    Route::patch('/update','Operator\ManajemenAnggotaController@update')->name('operator.manajemen_anggota.update');
    Route::delete('/hapus','Operator\ManajemenAnggotaController@delete')->name('operator.manajemen_anggota.delete');
    Route::patch('/ubah_password','Operator\ManajemenAnggotaController@updatePassword')->name('operator.manajemen_anggota.update_password');

    Route::patch('/aktifkan_status/{id}','Operator\ManajemenAnggotaController@aktifkanStatus')->name('operator.manajemen_anggota.aktifkan_status');
    Route::patch('/nonaktifkan_status/{id}','Operator\ManajemenAnggotaController@nonAktifkanStatus')->name('operator.manajemen_anggota.nonaktifkan_status');
});

Route::group(['prefix' => 'operator/manajemen_slider'], function(){
    Route::get('/','Operator\SliderController@index')->name('operator.slider');
    Route::post('/','Operator\SliderController@post')->name('operator.slider.add');
    Route::get('/{id}/edit','Operator\SliderController@edit')->name('operator.slider.edit');
    Route::patch('/','Operator\SliderController@update')->name('operator.slider.update');
    Route::delete('/','Operator\SliderController@delete')->name('operator.slider.delete');
});

Route::group(['prefix' => 'operator/manajemen_profil'], function(){
    Route::get('/','Operator\ProfilController@index')->name('operator.profil');
    Route::post('/','Operator\ProfilController@post')->name('operator.profil.add');
    Route::get('/{id}/edit','Operator\ProfilController@edit')->name('operator.profil.edit');
    Route::patch('/','Operator\ProfilController@update')->name('operator.profil.update');
    Route::delete('/','Operator\ProfilController@delete')->name('operator.profil.delete');
});

Route::group(['prefix' => 'operator/manajemen_berita'], function(){
    Route::get('/','Operator\BeritaController@index')->name('operator.berita');
    Route::post('/','Operator\BeritaController@post')->name('operator.berita.add');
    Route::get('/{id}/edit','Operator\BeritaController@edit')->name('operator.berita.edit');
    Route::patch('/','Operator\BeritaController@update')->name('operator.berita.update');
    Route::delete('/','Operator\BeritaController@delete')->name('operator.berita.delete');
});

Route::group(['prefix' => 'operator/manajemen_galeri'], function(){
    Route::get('/','Operator\GaleriController@index')->name('operator.galeri');
    Route::post('/','Operator\GaleriController@post')->name('operator.galeri.add');
    Route::delete('/','Operator\GaleriController@delete')->name('operator.galeri.delete');
});

Route::group(['prefix' => 'operator/anggota'], function(){
    Route::get('/','Operator\AnggotaController@index')->name('operator.anggota');
    Route::post('/','Operator\AnggotaController@post')->name('operator.anggota.add');
    Route::get('/{id}/edit','Operator\AnggotaController@edit')->name('operator.anggota.edit');
    Route::patch('/','Operator\AnggotaController@update')->name('operator.anggota.update');
    Route::delete('/','Operator\AnggotaController@delete')->name('operator.anggota.delete');
});

Route::group(['prefix' => 'operator/testimonial'], function(){
    Route::get('/','OperatorTestimonialController@index')->name('operator.testimonial');
    Route::post('/','OperatorTestimonialController@post')->name('operator.testimonial.add');
    Route::get('/{id}/edit','OperatorTestimonialController@edit')->name('operator.testimonial.edit');
    Route::patch('/','OperatorTestimonialController@update')->name('operator.testimonial.update');
    Route::delete('/','OperatorTestimonialController@delete')->name('operator.testimonial.delete');
});

Route::group(['prefix' => 'operator/layanan'], function(){
    Route::get('/','OperatorlayananController@index')->name('operator.layanan');
    Route::post('/','OperatorlayananController@post')->name('operator.layanan.add');
    Route::get('/{id}/edit','OperatorlayananController@edit')->name('operator.layanan.edit');
    Route::patch('/','OperatorlayananController@update')->name('operator.layanan.update');
});



// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => ''], function () {
    Route::get('/login', 'Auth\LoginAnggotaController@showLoginForm')->name('anggota.login');
    Route::post('/login', 'Auth\LoginAnggotaController@login')->name('anggota.login.submit');
    Route::get('/anggota/dashboard','Anggota\DashboardAnggotaController@dashboard')->name('anggota.dashboard');
    Route::post('/logout', 'Auth\LoginAnggotaController@logout')->name('anggota.logout');

});