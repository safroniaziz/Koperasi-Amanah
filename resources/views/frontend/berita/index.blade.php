
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Koperasi Amanah Sejati</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/koperasi.png') }}') }}">
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
                  <li class="">
                    <a class="page-scroll" href="{{ route('home') }}">Home</a>
                  </li>

                  <li class="active">
                    <a class="page-scroll" href="{{ route('berita') }}">Berita</a>
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

  <!-- Start Bottom Header -->
  <div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2">Berita dan Pengumuman</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">Tampilkan semua berita dan pengumuman</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Header -->
  <div class="blog-page area-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="page-head-blog">
            <div class="single-blog-page">
              <!-- search option start -->
              <form action="#">
                <div class="search-option">
                  <input type="text" placeholder="Search...">
                  <button class="button" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                </div>
              </form>
              <!-- search option end -->
            </div>
            <div class="single-blog-page">
              <!-- recent start -->
              <div class="left-blog">
                <h4>Berita Terbaru</h4>
                <div class="recent-post">
                  <!-- start single post -->
                  @foreach ($terbaru as $berita)
                    <div class="recent-single-post">
                      <div class="post-img">
                        <a href="{{ route('berita.detail',[$berita->id]) }}">
                            <img src="{{ asset($berita->gambar) }}" alt="">
                          </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{ route('berita.detail',[$berita->id]) }}"> {{ $berita->judul }}</a></p>
                      </div>
                    </div>
                  @endforeach
                  <!-- End single post -->
                  <!-- End single post -->
                </div>
              </div>
              <!-- recent end -->
            </div>
          </div>
        </div>
        <!-- End left sidebar -->
        <!-- Start single blog -->
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="row">
            @foreach ($beritas as $berita)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-blog">
                  <div class="single-blog-img">
                    <a href="{{ route('berita.detail',[$berita->id]) }}">
                                              <img src="{{ asset($berita->gambar) }}" alt="">
                                          </a>
                  </div>
                  <div class="blog-meta">
                    <span><i class="fa fa-clock-o"></i> {{ $berita->created_at->diffForHumans() }}</span>
                    <span><i class="fa fa-clock-o"></i> {{ $berita->created_at }}</span>
                  </div>
                  <div class="blog-text">
                    <h4>
                                              <a href="#">{{ $berita->judul }}</a>
                                          </h4>
                    <p>
                        {{ substr($berita->isi,0,35) }}
                    </p>
                  </div>
                  <span>
                                          <a href="{{ route('berita.detail',[$berita->id]) }}" class="ready-btn">Baca Selengkapnya</a>
                                      </span>
                </div>
              </div>
            @endforeach
            <!-- End single blog -->
            <div class="blog-pagination">
                {{ $beritas->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->

  <div class="clearfix"></div>

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
  <script src="{{ asset('assets/frontend/contactform/contactform.js') }}"></script>

  <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
</body>

</html>
