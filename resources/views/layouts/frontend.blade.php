
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Koperasi Amanah Sejati</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/koperasi.png') }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('assets/frontend/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('assets/frontend/lib/nivo-slider/css/nivo-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/lib/owlcarousel/owl.carousel.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/lib/owlcarousel/owl.transitions.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/lib/venobox/venobox.css') }}" rel="stylesheet">
  <style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
      padding:4px !important;
    }
  </style>
  <!-- Nivo Slider Theme -->
  <link href="{{ asset('assets/frontend/css/nivo-slider-theme.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">

  <!-- =======================================================
    Theme Name: eBusiness
    Theme URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <div id="preloader"></div>

  <header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
                <!-- Brand -->
                <a class="navbar-brand page-scroll sticky-logo" href="{{ route('home') }}">
                  <h1 style="font-size: 20px;line-height:2.1;"><span>Koperasi </span>Amanah</h1>
                  <!-- Uncomment below if you prefer to use an image logo -->
                  <!-- <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" title=""> -->
								</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                  <li class="active">
                    <a class="page-scroll" href="#home">Home</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#about">Tentang</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#team">Anggota</a>
                  </li>

                  <li>
                    <a class="page-scroll" href="#portfolio">Galeri</a>
                  </li>

                  <li>
                    <a class="page-scroll" href="{{ route('berita') }}">Berita</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="{{ route('anggota.login') }}">Login</a>
                  </li>

                </ul>
              </div>
              <!-- navbar-collapse -->
            </nav>
            <!-- END: Navigation -->
          </div>
        </div>
      </div>
    </div>
    <!-- header-area end -->
  </header>
  <!-- header end -->

  <!-- Start Slider Area -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
       @foreach ($sliders as $slider)
       <img src="{{ asset($slider->gambar) }}" alt="" title="#id" />
       @endforeach
        
      </div>

      <!-- direction 1 -->
      <div id="id" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Koperasi Amanah Sejati </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">{{ $profils->alamat_lengkap }}
                  </h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#contact"><i class="fa fa-info-circle"></i>&nbsp;Informasi</a>
                  <a class="ready-btn page-scroll" href="{{ route('anggota.login') }}"><i class="fa fa-sign-in"></i>&nbsp;Login Anggota</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Slider Area -->

  <!-- Start About area -->
  <div id="about" class="about-area area-padding" style="padding-bottom: 0px !important;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Tentang Kami</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- single-well start-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-left">
            <div class="single-well">
              <a href="#">
								  <img src="{{ asset('upload/foto_lembaga/gambar1.jpeg') }}" alt="">
								</a>
            </div>
          </div>
        </div>
        <!-- single-well end-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle">
            <div class="single-well">
              <a href="#">
                <h4 class="sec-head">Profil Singkat</h4>
              </a>
              <p>
                Susunan kepengurusan koperasi Amanah Sejati Tahun 2021 adalah sebagai berikut :
              </p>
              <table class="table">
                <tr>
                  <td>1</td>
                  <td colspan="2">Pengurus Inti Koperasi</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Ketua</td>
                  <td>Candra Kesuma. ZA</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Sekretaris</td>
                  <td>Suharto, SP </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Bendahara</td>
                  <td>Nurul Komaraiah, S.Si, M.Si </td>
                </tr>
                
                <tr>
                  <td>2</td>
                  <td colspan="2">Badan Pengawas</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Koordinator</td>
                  <td>Untung Idaman, HSB</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Anggota</td>
                  <td>Ampermi, SH</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Anggota</td>
                  <td>Soeroso, SH </td>
                </tr>

                <tr>
                  <td>3</td>
                  <td colspan="2">Pembina</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Walikota Bengkulu</td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="2">Kepala Dinas Koperasi dan UKM Kota Bengkulu</td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="2">Ir. H. Syiful A. Yusuf</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- End col-->
      </div>
    </div>
  </div>
  <!-- End About area -->
  <!-- Faq area start -->
  <div class="faq-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Informasi Kami</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="faq-details">
            <div class="panel-group" id="accordion">
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" class="active" data-parent="#accordion" href="#check1">
                                                <span class="acc-icons"></span>Pendirian/Pembentukan Koperasi
											</a>
										</h4>
                </div>
                <div id="check1" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <p>
                      Pendirian/pembentukan koperasi dilaksanakan pada tanggal 28 Maret 2015
                    </p>
                  </div>
                </div>
              </div>
              <!-- End Panel Default -->
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                                <span class="acc-icons"></span> Akta Pendirian
											</a>
										</h4>
                </div>
                <div id="check2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <p>
                      Akta Pendirian Koperasi Nomor: 01/KPAS/2015 pada tanggal 6 April 2015, dikukuhkan dengan akta notaris Kuswari Ahmad, SH, M.Kn No.20 tanggal 13 April 2015 dan selanjutnya disahkan oleh Kepala Dinas Koperasi dan UKM Kota Bengkulu Nomor: 09/IX.4/2015 tanggal 15 April 2015.
                    </p>
                  </div>
                </div>
              </div>
              <!-- End Panel Default -->
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check3">
                                                <span class="acc-icons"></span>Latar Belakang Pendirian
											</a>
										</h4>
                </div>
                <div id="check3" class="panel-collapse collapse ">
                  <div class="panel-body">
                    
                    <p style="text-indent: 45px;">Koperasi merupakan organisasi ekonomi kerakyatan yang berwatak sosial yang didirikan oleh para anggota </p>
                    <p style="text-indent: 45px;">dipimpin oleh para anggota dan dijalankan untuk meningkatkan kesejahteraan para anggota.
	Bertitik tolak dari pengertian “Dari, oleh dan untuk anggota”, maka suatu koperasi itu akan mencapai suatu kemajuan dan pengembangan yang wajar kalau koperasi tersebut benar-benar memperoleh dukungan peran serta aktif dan nyata dari para anggotanya, baik itu berupa peran serta didalam pemupukan modal sendiri oleh koperasi maupun peran serta anggota dalam mengambil keputusan-keputusan yang penting bagi kebahagiaan koperasi. </p>
  <p style="text-indent: 45px;">Dengan demikian dapat disimpulkan bahwa anggota adalah pemilik sekaligus pelanggan dan pada hakekatnya pengolahan dan penanganan kegiatan haruslah berada ditangan para anggota sendiri yang kemudian didalam undang-undang No.12 tahun 1967 tentang Pokok-pokok Perkoperasian telah diatur sedemikian rupa sehingga mewujudkan bentuk mekanisme kerja dari pada alat-alat kelengkapan organisasi koperasi (BAB VIII Undang-undang No.12/1967) </p>
	<p style="text-indent: 45px;">Berpedoman dari peran dan fungsi koperasi dalam hal kebersamaan dalam pemupukan modal usaha, maka kami dari Ketua P2MKP (Pusat Pelatihan Mandiri Kelautan dan Perikanan) Surabaya Makmur bersama para pembudidaya ikan dan keluarganya dengan semangat kebersamaan untuk mencapai tujuan khususnya untuk memperoleh modal usaha yang lebih cepat, mudah dan murah maka kami sepakat untuk membentuk koperasi. </p>
  <p style="text-indent: 45px;">Berdasarkan musyawarah dalam pembentukan koperasi disepakati dari pihak anggota sebanyak 3 (tiga) orang bersedia meminjamkan uang untuk modal usaha koperasi sebesar Rp.100.000.000,- (seratus juta rupiah) tanpa bunga dan menghibahkan uang sebanyak Rp.5.000.000,- (lima juta rupiah) untuk biaya operasional kepengurusan pendirian koperasi, akte notaris, pembuatan papan nama, struktur organisasi, cap koperasi, buku administrasi dan keuangan, dll. </p>
	<p style="text-indent: 45px;">Dengan telah disepakatinya pembentukan koperasi tersebut, maka pada tanggal 28 Maret 2015 dilaksanakan sosialisasi pembentukan koperasi oleh pejabat dari Dinas Koperasi dan UKM Kota Bengkulu bertempat di sekretariat koperasi Jl.Tutwuri No.59 RT.04 RW.02 Kelurahan Surabaya Kecamatan Sungai Serut Kota Bengkulu bergabung dengan sekretariat P2MKP Surabaya Makmur.

                    </p>
                  </div>
                </div>
              </div>
              <!-- End Panel Default -->
              <!-- Panel Default -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="check-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#check4">
                                                <span class="acc-icons"></span>Maksud dan Tujuan
											</a>
										</h4>
                </div>
                <div id="check4" class="panel-collapse collapse">
                  <div class="panel-body">
                    <ul>
                      <li>
                        <i class="fa fa-check text-success"></i> Mendirikan kelembagaan keuangan yang mudah diakses, murah bunga pinjaman, simpel dalam urusan administrasi dan terbuka dalam manajemen keuangan.
                      </li>
                      <li>
                        <i class="fa fa-check text-success"></i> Menumbuh kembangkan rasa kebersamaan, rasa memiliki dan bertanggung jawab dalam kemajuan organisasi.
                      </li>
                      <li>
                        <i class="fa fa-check text-success"></i> Membangun organisasi yang solid untuk kemajuan dan kesejahteraan anggota
                      </li>
                      <li>
                        <i class="fa fa-check text-success"></i> Membangun organisasi yang solid untuk kemajuan dan kesejahteraan anggota
                      </li>
                      <li>
                        <i class="fa fa-check text-success"></i> Menumbuh kembangkan sinergitas antara kelembagaan Pusat Pelatihan Mandiri Kelautan dan Perikanan (P2MKP) Surabaya Makmur sebagai sumber pengetahuan dan ketrampilan dengan Koperasi Produksi Amanah Sejati sebagai sumber keuangan/modal usaha untuk meningkatkan produktivitas dibidang perikanan budidaya.
                      </li>
                      <li>
                        <i class="fa fa-check text-success"></i> Mendorong tumbuh kembangnya jiwa kewirausahaan dan kemandirian dalam usaha serta mendukung program pemerintah dengan mendekatkan sumber usaha serta sumber pengetahuan dan ketrampilan untuk menghasilkan produk yang optimal dan berkualitas.
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- End Panel Default -->
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="tab-menu">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="active">
                <a href="#p-view-1" role="tab" data-toggle="tab">Visi</a>
              </li>
              <li>
                <a href="#p-view-2" role="tab" data-toggle="tab">Misi</a>
              </li>
              <li>
                <a href="#p-view-3" role="tab" data-toggle="tab">Tujuan</a>
              </li>
              <li>
                <a href="#p-view-4" role="tab" data-toggle="tab">Kerjasama</a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" id="p-view-1">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Visi</h4>
                  <p>
                    Menjadi Koperasi Produksi yang mampu memproduksi, menampung dan mempromosikan produk anggota ke wilayah Provinsi Bengkulu maupun ke Tingkat Nasional untuk meningkatkan kesejahteraan anggota secara demokratis. 
                  </p>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-2">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Misi</h4>
                  <ol>
                    <li>Menghasilkan produk pertanian dan perikanan yang berkualitas dan mampu bersaing di pasaran dari hasil produksi koperasi dan/atau anggota koperasi.</li>
                    <li>Menyediakan peralatan dan bahan-bahan yang diperlukan/dibutuhkan oleh anggota koperasi untuk keperluan produksi.</li>
                    <li>Menampung hasil produksi, melakukan penyempurnaan dan mempromosikan produk tersebut ke pasaran Tingkat Provinsi Bengkulu maupun Tingkat Nasional.</li>
                    <li>Menampung hasil produksi, melakukan penyempurnaan dan mempromosikan produk tersebut ke pasaran Tingkat Provinsi Bengkulu maupun Tingkat Nasional.</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="p-view-3">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Tujuan</h4>
                  <ol>
                    <li>Memberikan pinjaman modal kerja dengan jasa yang serendah-rendahnya dengan anggota agar dapat mengembangkan usahanya secara berkesinambungan.</li>
                    <li>Memberikan alternatif produk konsumsi khususnya pertanian dan perikanan kepada masyarakat.</li>
                    <li>Meningkatkan kesejahteraan anggota Koperasi Produksi Amanah Sejati.</li>
                  </ol>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="p-view-4">
              <div class="tab-inner">
                <div class="event-content head-team">
                  <h4>Kerjasama</h4>
                  <table class="table">
                    <tr>
                      <td>1</td>
                      <td>KERJASAMA DENGAN PT. TASPEN BENGKULU</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>Kerjasama dalam bentuk pemberian pinjaman penguatan modal usaha koperasi yang tertuang dalam Surat Perjanjian Modal Kerja antara PT. Taspen (Perser) dengan Candra Kesuma, ZA (Ketua Koperasi) Nomor: 011/102/2019 tanggal 09 September 2019.</td>
                    </tr>

                    <tr>
                      <td>2</td>
                      <td>KERJASAMA DENGAN PEMERINTAH KOTA BENGKULUU</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        Kerjasama antara Pemerintah Kota Bengkulu melalui Dinas Koperasi dan UKM Kota Bengkulu dengan Koperasi Produksi Amanah Sejati dalam Program Penguatan Pinjman Modal Bergulir bagi Koperasi Berprestasi di Kota Bengkulu Tahun 2020 yang tertuang dalam Surat Perjanjian Kerjasama Nomor: 518/289/D.KUKM/VIII/2020 dan Nomor: 40/KPAS/VIII/2020.
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end Row -->
    </div>
  </div>
  <!-- End Faq Area -->

  <!-- Start Wellcome Area -->
  <div class="wellcome-area">
    <div class="well-bg">
      <div class="test-overly"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="wellcome-text">
              <div class="well-text text-center">
                <h2>Selamat Datang Di Koperasi Amanah Sejati</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Wellcome Area -->

  <!-- Start team Area -->
  <div id="team" class="our-team-area area-padding" style="padding-bottom: 0px !important;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Anggota Koperasi</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="team-top">
          @foreach ($anggotas as $anggota)
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="#">
										<img src="{{ asset($anggota->gambar) }}" alt="" style="height: 300px; width:100%">
									</a>
                <div class="team-social-icon text-center">
                  
                </div>
              </div>
              <div class="team-content text-center">
                <h4>{{ $anggota->nm_anggota }}</h4>
                <p>Terdaftar Sejak {{ $anggota->created_at->diffForHumans() }}</p>
              </div>
            </div>
          </div>
          @endforeach
          <!-- End column -->
        </div>
      </div>
      <div class="row">
        {{ $anggotas->links() }}
      </div>
    </div>
  </div>
  <!-- End Team Area -->

  <!-- Start portfolio Area -->
  <div id="portfolio" class="portfolio-area area-padding fix" style="padding-bottom: 0px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Galeri Foto</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Start Portfolio -page -->
        <div class="awesome-project-content">
          <!-- single-awesome-project start -->
          @foreach ($galeris as $galeri)
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
              <div class="single-awesome-project">
                <div class="awesome-img">
                  <a href="#"><img src="{{ asset($galeri->gambar) }}" style="width: 100%" alt="" /></a>
                  <div class="add-actions text-center">
                    <div class="project-dec">
                      <a class="venobox" data-gall="myGallery" href="{{ asset($galeri->gambar) }}">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <div class="col-md-12">
            {{ $galeris->links() }}
          </div>
          <!-- single-awesome-project end -->
        </div>
      </div>
    </div>
  </div>
  <!-- awesome-portfolio end -->

  <!-- End pricing table area -->

  <!-- End Testimonials -->
  <!-- Start Blog Area -->
  <div id="blog" class="blog-area">
    <div class="blog-inner area-padding">
      <div class="blog-overly"></div>
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Berita dan Pengumuman</h2>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- End Left Blog-->
          <!-- Start Right Blog-->
          @foreach ($beritas as $berita)
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="single-blog">
              <div class="single-blog-img">
                <a href="blog.html">
										<img src="{{ asset($berita->gambar) }}" alt="">
									</a>
              </div>
              <div class="blog-meta">
                <span class="comments-type">
										<i class="fa fa-clock-o"></i>
										<a href="#">{{ $berita->created_at->diffForHumans() }}</a>
									</span>
                <span class="date-type">
										<i class="fa fa-calendar"></i>{{ $berita->created_at }}
									</span>
              </div>
              <div class="blog-text">
                <h4>
                                        <a href="blog.html">{{ $berita->judul }}</a>
									</h4>
                <p>
                  {{ substr($berita->isi,0,35) }}
                </p>
              </div>
              <span>
									<a href="{{ route('berita.detail',[$berita->id]) }}" class="ready-btn">Lanjutkan Baca</a>
								</span>
            </div>
          </div>
          @endforeach
          <!-- End Right Blog-->
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog -->
  <!-- Start contact Area -->
  <div id="contact" class="contact-area">
    <div class="contact-inner area-padding">
      <div class="contact-overly"></div>
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Kontak Kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-mobile"></i>
                <p>
                  Telephone<br>
                  <span>{{ $profils->telephone }}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-envelope-o"></i>
                <p>
                  Email<br>
                  <span>{{ $profils->email }}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-map-marker"></i>
                <p>
                  <span>{{ $profils->alamat_lengkap }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- Start Google Map -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- Start Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.6176316685709!2d102.31411302914253!3d-3.790633561656558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b0ee60a5f457%3A0xb1b87638c0831fb8!2sBengkulu%2C%20Surabaya%2C%20Kec.%20Sungai%20Serut%2C%20Kota%20Bengkulu%2C%20Bengkulu%2038119!5e0!3m2!1sid!2sid!4v1617132709340!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <!-- End Map -->
          </div>
          <!-- End Google Map -->

        </div>
      </div>
    </div>
  </div>
  <!-- End Contact Area -->

  <!-- Start Footer bottom Area -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <div class="footer-logo">
                  <h2><span>Koperasi</span>Amanah</h2>
                </div>

                <p>
                  Menjadi Koperasi Produksi yang mampu memproduksi, menampung dan mempromosikan produk anggota ke wilayah Provinsi Bengkulu maupun ke Tingkat Nasional untuk meningkatkan kesejahteraan anggota secara demokratis.


                </p>
                <div class="footer-icons">
                  <ul>
                    <li>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-google"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-pinterest"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>information</h4>
                <p>
                  Pendirian/pembentukan koperasi dilaksanakan pada tanggal 28 Maret 2015
                </p>
                <div class="footer-contacts">
                  <p><span>Telephone:</span> {{ $profils->telephone }}</p>
                  <p><span>Email:</span> {{ $profils->email }}</p>
                  <p><span>Alamat:</span> {{ $profils->alamat_lengkap }}</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>Galeri</h4>
                <div class="flicker-img">
                  @foreach ($galeris as $galeri)
                  <a ><img src="{{ asset($galeri->gambar) }}" alt=""></a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>eBusiness</strong>. All Rights Reserved
              </p>
            </div>
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
              -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('assets/frontend/lib/jquery/jquery.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/bootstrap/js/bootstrap.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/owlcarousel/owl.carousel.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/venobox/venobox.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/knob/jquery.knob.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/wow/wow.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/parallax/parallax.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/easing/easing.min.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/nivo-slider/js/jquery.nivo.slider.js ') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/lib/appear/jquery.appear.js ') }}"></script>
  <script src="{{ asset('assets/frontend/lib/isotope/isotope.pkgd.min.js ') }}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('assets/frontend/contactform/contactform.js ') }}"></script>

  <script src="{{ asset('assets/frontend/js/main.js ') }}"></script>
</body>

</html>
