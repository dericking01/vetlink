@extends('layouts.website.base')

@section('content')
      <!-- ======= Breadcrumbs ======= -->
      <div class="breadcrumbs d-flex align-items-center" style="background-image: url('website/assets/img/logh.jpeg');">
        <div class="container position-relative d-flex flex-column align-items-center">

          <h2>Viongozi</h2>
          <ol>
            <li><a href="{{ route('website.home') }}">Nyumbani</a></li>
            <li>Viongozi</li>
          </ol>

        </div>
      </div><!-- End Breadcrumbs -->

      <!-- ======= Team Section ======= -->
      <section id="team" class="team">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Viongozi Wetu</h2>

          </div>

          <div class="row gy-4">

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Saida Bwanakheri</h4>
                  <span>Mkurugenzi Mkuu</span>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-4.jpg') }}" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Jaffari Warutumo</h4>
                  <span>Meneja Mkuu</span>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-3.jpg') }}" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Gasper Aloyce Chuwa</h4>
                  <span>Mwenyekiti wa Bodi</span>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-6.JPG') }}" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Dafrosa Chuwa</h4>
                  <span>Meneja wa Mradi</span>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Emmanuel Boshe</h4>
                  <span>Katibu wa Kampuni</span>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
              <div class="team-member">
                <div class="member-img">
                  <img src="{{ asset('website/assets/img/team/team-5.jpe') }}g" class="img-fluid" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Nashy Habibu</h4>
                  <span>Afisa wa Kiufundi</span>
                </div>
              </div>
            </div><!-- End Team Member -->

          </div>

        </div>
      </section><!-- End Team Section -->
@endsection
