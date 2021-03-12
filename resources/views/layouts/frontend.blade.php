
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Koperasi Amanah - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/frontend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/frontend/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mamba - v2.5.0
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">{{ $profils->email }}</a>
        <i class="icofont-phone"></i> {{ $profils->telephone }}
      </div>
      <div class="social-links float-right">
        <a href="{{ $profils->facebook }}" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="{{ $profils->instagram }}" class="instagram"><i class="icofont-instagram"></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="{{ route('home') }}"><span>Koperasi Amanah</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="{{ asset('assets/frontend/assets/img/koperasi.png') }}" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('home') }}">Home</a></li>
          <li><a href="#about">Profil</a></li>
          <li><a href="#portfolio">Berita & Pengumuman</a></li>
          <li><a href="#team">Pengurus & Anggota</a></li>
          <li><a href="#contact">Kontak</a></li>
          <li><a href="{{ route('anggota.login') }}" target="_blank">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
          @foreach ($sliders as $index=>$slider)
          <!-- Slide 1 -->
            <div class="carousel-item @if($index == '1') {{ 'active' }} @endif" style="background-image: url('{{ asset($slider->gambar)}}');">
              <div class="carousel-container">
                <div class="carousel-content container">
                  <h2 class="animate__animated animate__fadeInDown">{{ $slider->title }}</h2>
                  <p class="animate__animated animate__fadeInUp">{{ $slider->slogan }}</p>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Lihat Profil</a>
                </div>
              </div>
            </div>
          @endforeach

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="col-lg-6 video-box">
            <img src="{{ asset($profils->foto) }}" class="img-fluid" alt="">
            <a class="venobox  mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center about-content">

            <div class="section-title">
              <h2>Alamat Lengkap</h2>
              <p>
                {{ $profils->alamat_lengkap }}
              </p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Visi</a></h4>
              <p class="description">
                {{ $profils->visi }}
              </p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Misi</a></h4>
              <p class="description">
                {!! $profils->misi !!}
              </p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section class="counts section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
            <div class="count-box">
              <i class="icofont-simple-smile" style="color: #20b38e;"></i>
              <span data-toggle="">{{ $profils->tahun_berdiri }}</span>
              <p>Tahun Berdiri</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="icofont-document-folder" style="color: #c042ff;"></i>
              <span data-toggle="">{{ $jumlah_anggota }}</span>
              <p>Jumlah Anggota</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="count-box">
              <i class="icofont-live-support" style="color: #46d1ff;"></i>
              <span data-toggle="">{{ $profils->jumlah_pengurus }}</span>
              <p>Jumlah Pengurus</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="600">
            <div class="count-box">
              <i class="icofont-users-alt-5" style="color: #ffb459;"></i>
              <span data-toggle="">{{ $profils->kerja_sama }}</span>
              <p>Jumlah Kerja Sama</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->
    <!-- ======= Our Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
          <h2>Berita & Pengumuman</h2>
        </div>

        <div class="row portfolio-container">
          @foreach ($beritas as $berita)
            <a href="{{ route('berita.detail',[$berita->id,$berita->slug]) }}">
              <div class="col-lg-4 col-md-6 portfolio-item ">
                <div class="portfolio-wrap">
                  <img src="{{ asset($berita->gambar) }}" class="img-fluid" alt="">
                  <div class="portfolio-info" style="padding: 0px 30px !important">
                    <h4 style="font-size: 12px !important">{{ $berita->judul }}</h4>
                    <div class="portfolio-links">
                    </div>
                  </div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
        {{ $beritas->links() }}
      </div>
    </section><!-- End Our Portfolio Section -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2>Pengurus Dan Anggota</h2>
        </div>

        <div class="row">

          @foreach ($anggotas as $anggota)
          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up">
            <div class="member">
              <div class="pic"><img src="{{ asset($anggota->gambar) }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>{{ $anggota->nm_anggota }}</h4>
                <span>{{ $anggota->email }}</span>
                <div class="social">
                <span>{{ $anggota->nik }}</span>
                  
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Hubungi Kami</h2>
        </div>

        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Alamat Lengkap</h3>
              <p>{{ $profils->alamat_lengkap }}</p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>{{ $profils->email }}x</p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box ">
              <i class="bx bx-phone-call"></i>
              <h3>Telephone</h3>
              <p>{{ $profils->telephone }}</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Koperasi Amanah</h3>
            <p>
              {{ $profils->alamat_lengkap }} <br>
              NY 535022, USA<br><br>
              <strong>Telephome:</strong> {{ $profils->telephone }}<br>
              <strong>Email:</strong> {{ $profils->email }}<br>
            </p>
            <div class="social-links mt-3">
              <a href="{{ $profils->facebook }}" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="{{ $profils->instagram }}" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Menu Tersedia</h4>
            <ul>
              <li class="active"><a href="{{ asset('home') }}">Home</a></li>
              <li><a href="#about">Profil</a></li>
              <li><a href="#portfolio">Berita & Pengumuman</a></li>
              <li><a href="#team">Pengurus & Anggota</a></li>
              <li><a href="#contact">Kontak</a></li>
            </ul>
          </div>

 

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Visi</h4>
            <p>{{ $profils->visi }}</p>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Misi</h4>
            <p>{{ $profils->misi }}</p>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Mamba</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/frontend/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/assets/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/frontend/assets/js/main.js') }}"></script>

</body>

</html>