@extends('layouts.website.base')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('website/assets/img/logh.jpeg');">
        <div class="container position-relative d-flex flex-column align-items-center">

          <h2>Blog</h2>
          <ol>
            <li><a href="{{ route('website.home') }}">Home</a></li>
            <li>Blog</li>
          </ol>

        </div>
      </div><!-- End Breadcrumbs -->

      <!-- ======= Blog Section ======= -->
      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

          <div class="row g-5">

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

              <div class="row gy-5 posts-list">

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/cheni.JPG') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Murugenzi wa SAB Investmen na Dr.Cheni kwenye picha ya pamoja</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                       Murugenzi wa SAB Investments kwenye picha pamoja na Dr.Cheni baada ya kuelezwa mambo kadha wa kadha kuhusu kampuni ya SAB INVESTMENTS LTD
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/work.jpeg') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Wafanyakazi kwenye hafla ya YEMCO VICOBA</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                        Wafanyakazi wa kampuni ya SAB INVESTMENTS kwenye hafla ya kuadhimisha miaka 7 ya YEMCO VICOBA TANZANIA
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/chilo.jpeg') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Mkurugenzi Mkuu wa kampuni ya SAB INVESTMENTS LTD kwenye picha na Mzee Chilo</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                       Mkurugenzi Mkuu wa kampuni ya SAB INVESTMENTS LTD kwenye picha na Mzee Chilo kwenye hafla ya kuadhimisha miaka 7 ya YEMCO VICOBA TANZANIA
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/mzungu.jpeg') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Uwekezaji SAB INVESTMENTS LTD</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                       Uwekezaji SAB INVESTMENTS LTD Kwa maendeleo ya ufugaji wa Kuku kwa kisasa zaidi
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/IMG_2719.JPG') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Ufunguzi kampuni ya SAB INVESTMENTS LTD</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                        Ufunguzi kampuni ya SAB INVESTMENTS LTD kama makao makuu ya kampuni
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <img src="{{ asset('website/assets/img/IT.jpeg') }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">
                      <a href="blog-details.html">Timu ya IT SAB INVESTMENTS LTD</a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                      </ul>
                    </div>

                    <div class="content">
                      <p>
                       Timu ya ufundi kwenye maswali ya TEHAMA Kampuni ya SAB INVESTMENTS LTD
                      </p>
                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="blog-details.html">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>

                  </article>
                </div><!-- End post list item -->

              </div><!-- End blog posts list -->

              <div class="blog-pagination">
                <ul class="justify-content-center">
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                </ul>
              </div><!-- End blog pagination -->

            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">

              <div class="sidebar ps-lg-4">

                <div class="sidebar-item search-form">
                  <h3 class="sidebar-title">Search</h3>
                  <form action="" class="mt-3">
                    <input type="text">
                    <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
                </div><!-- End sidebar search formn-->

                <div class="sidebar-item categories">
                  <h3 class="sidebar-title">Categories</h3>
                  <ul class="mt-3">
                    <li><a href="#">General <span>(25)</span></a></li>
                    <li><a href="#">Lifestyle <span>(12)</span></a></li>
                    <li><a href="#">Travel <span>(5)</span></a></li>
                    <li><a href="#">Design <span>(22)</span></a></li>
                    <li><a href="#">Creative <span>(8)</span></a></li>
                    <li><a href="#">Educaion <span>(14)</span></a></li>
                  </ul>
                </div><!-- End sidebar categories-->

                <div class="sidebar-item recent-posts">
                  <h3 class="sidebar-title">Recent Posts</h3>

                  <div class="mt-3">

                    <div class="post-item mt-3">
                      <img src="{{ asset('website/assets/img/NASH.jpg') }}" alt="" class="flex-shrink-0">
                      <div>
                        <h4><a href="blog-post.html">Hotuba kutoka kwa mwakilishi wa SAB INVESTMENTS LTD</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                      </div>
                    </div><!-- End recent post item-->

                    <div class="post-item">
                      <img src="{{ asset('website/assets/img/WAKALA.jpeg') }}" alt="" class="flex-shrink-0">
                      <div>
                        <h4><a href="blog-post.html">Kwa mahitaji ya uwakala wa kusambaza chakula cha kuku kampuni ya SAB FEEDS</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                      </div>
                    </div><!-- End recent post item-->

                    <div class="post-item">
                      <img src="{{ asset('website/assets/img/KCH.jpeg') }}" alt="" class="flex-shrink-0">
                      <div>
                        <h4><a href="blog-post.html">Wafanyakazi wa SAB INVESTMENTS kwenye picha na Raisi wa  YEMCO VICOBA Tanzania</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                      </div>
                    </div><!-- End recent post item-->

                    <div class="post-item">
                      <img src="{{ asset('website/assets/img/KYZ.jpeg') }}" alt="" class="flex-shrink-0">
                      <div>
                        <h4><a href="blog-post.html">YEMCO VICOBA tanzania hafla</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                      </div>
                    </div><!-- End recent post item-->

                    <div class="post-item">
                      <img src="{{ asset('website/assets/img/TRAIN.JPG') }}" alt="" class="flex-shrink-0">
                      <div>
                        <h4><a href="blog-post.html">Semina ufugaji wa kuku SAB INVESTMENTS</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                      </div>
                    </div><!-- End recent post item-->

                  </div>

                </div><!-- End sidebar recent posts-->

                <div class="sidebar-item tags">
                  <h3 class="sidebar-title">Tags</h3>
                  <ul class="mt-3">
                    <li><a href="#">App</a></li>
                    <li><a href="#">IT</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Mac</a></li>
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Office</a></li>
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Studio</a></li>
                    <li><a href="#">Smart</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
                </div><!-- End sidebar tags-->

              </div><!-- End Blog Sidebar -->

            </div>

          </div>

        </div>
      </section><!-- End Blog Section -->
@endsection
