@extends('layouts.website.base')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('website/assets/img/logh.jpeg');">
        <div class="container position-relative d-flex flex-column align-items-center">

          <h2>Services</h2>
          <ol>
            <li><a href="{{ route('website.home') }}">Nyumbani</a></li>
            <li>Huduma Zetu</li>
          </ol>

        </div>
      </div><!-- End Breadcrumbs -->

      <!-- ======= Services Cards Section ======= -->
      <section id="services-cards" class="services-cards">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Huduma zetu</h2>

          </div>

          <div class="row gy-4">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="card-item">
                <div class="row">
                  <div class="col-xl-5">
                    <div class="card-bg" style="background-image: url('website/assets/img/CAGE.JPG');"></div>
                  </div>
                  <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                      <h4 class="card-title">UDHAMINI NA USAMBAZAJI WA VIFAA VYA KILIMO</h4>
                      <p>Tunatoa suluhisho mbalimbali za kilimo, ikiwa ni pamoja na Kuuza na kudhamini  vifaa vya  kisasa kwa ufugaji wa kuku, mifumo ya ukusanyaji wa mayai, makazi ya kuku yenye ubora, vifaa vya kuotea mayai vya  kisasa, nk. Suluhisho zetu zinaboresha ufanisi, kuboresha mbinu za kilimo, na kutilia mkazo endelevu na ustawi wa wanyama..
</p>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Card Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <div class="card-item">
                <div class="row">
                  <div class="col-xl-5">
                    <div class="card-bg" style="background-image: url('website/assets/img/feed.PNG');"></div>
                  </div>
                  <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                      <h4 class="card-title">UZALISHAJI WA CHAKULA CHA WANYAMA</h4>
                      <p>SAB Investment na SAB Feeds wanaweka kipaumbele katika lishe ya wanyama, hasa kwa kuwa na chakula bora cha kuku kinachosaidia ukuaji na afya bora. Wanapanga kuongeza aina mbalimbali za vyakula vya wanyama kwenye bidhaa zao ili kuhudumia wanyama wa spishi tofauti, na lengo lao ni kutoa suluhisho kamili kwa lishe ya wanyama kwa kuzingatia mahitaji maalum ya wanyama nchini Tanzania.





</p>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Card Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
              <div class="card-item">
                <div class="row">
                  <div class="col-xl-5">
                    <div class="card-bg" style="background-image: url('website/assets/img/TRAIN.JPG');"></div>
                  </div>
                  <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                      <h4 class="card-title">MAFUNZO NA USHAURI</h4>
                      <p>Kampuni ya Uwekezaji ya SAB inawawezesha wakulima kupitia programu mbalimbali za mafunzo, ikiwa ni pamoja na kilimo cha uhakika, afya ya mifugo, upatikanaji wa masoko, na kujumuisha jinsia hasa jinsia ya kike. Miradi hii inaboresha ujuzi na maarifa ya wakulima, kukuza mafanikio na mazoea endelevu ya kilimo.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Card Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
              <div class="card-item">
                <div class="row">
                  <div class="col-xl-5">
                    <div class="card-bg" style="background-image: url('website/assets/img/mng.jpg');"></div>
                  </div>
                  <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                      <h4 class="card-title">KILIMO NA UFUGAJI WA WANYAMA</h4>
                      <p>Kampuni ya Uwekezaji ya SAB inatoa humwa katika usimamizi wa kilimo na ufugaji wa wanyama. Wanatoa ushauri wa kibinafsi kuhusu chaguzi za mazao kulingana na hali ya udongo na hali ya hewa, wanaweza kusaidia katika kubuni mipango ya kulisha wanyama yenye lishe, na wana ujuzi katika ujenzi wa nyumba za wanyama, usafi, na kuzuia magonjwa. Katika ufugaji wa kuku, wanatoa huduma maalum kama vile kuchagua aina za kuku, mifumo bora ya makazi, na mipango ya lishe iliyoundwa kwa kuzingatia afya na ufanisi kwenye ufugaji wa kuku</p>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Card Item -->

           ><!-- End Card Item -->
<!-- End Card Item -->

          </div>

        </div>
      </section><!-- End Services Cards Section -->

      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Testimonials</h2>

          </div>

          <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                  </p>
                  <div class="profile mt-auto">
                    <img src="{{ asset('website/assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                    <h3>Saul Goodman</h3>
                    <h4>Ceo &amp; Founder</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                  </p>
                  <div class="profile mt-auto">
                    <img src="{{ asset('website/assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                    <h3>Sara Wilsson</h3>
                    <h4>Designer</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  </p>
                  <div class="profile mt-auto">
                    <img src="{{ asset('website/assets/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                    <h3>Jena Karlis</h3>
                    <h4>Store Owner</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                  </p>
                  <div class="profile mt-auto">
                    <img src="{{ asset('website/assets/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                    <h3>Matt Brandon</h3>
                    <h4>Freelancer</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->



              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                  </p>

                    <h3>John Larson</h3>
                    <h4>Entrepreneur</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>
      </section><!-- End Testimonials Section -->
@endsection
