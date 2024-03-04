@extends('layouts.website.base')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('website/assets/img/logh.jpeg');">
        <div class="container position-relative d-flex flex-column align-items-center">

            <h2>Kuhusu</h2>
            <ol>
                <li><a href="index.html">Nyumbani</a></li>
                <li>Kuhusu</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4" data-aos="fade-up">
                <div class="col-lg-4">
                    <img src="{{ asset('website/assets/img/abt.jpeg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="content ps-lg-5">
                        <h3>Historia Fupi</h3>
                        <p>
                           SAB INVESTMENTS Ni Kampuni inayoongoza katika sekta ya kilimo iliyopo katika jiji la Dar es Salaam nchini Tanzania. Ilianzishwa mwaka 2016 kama JESA ANIMAL FEEDS, ambapo tumeweza kujenga sifa imara kama mshirika mwenye uaminifu na kuaminika katika sekta ya kilimo.
Kampuni yetu inajikita katika kilimo na ufugaji wa wanyama, biashara na usambazaji wa vifaa vya kilimo, uzalishaji wa chakula cha wanyama, pamoja na kutoa mafunzo na ushauri kwa wakulima. Tukiwa na dhamira ya kutoa ubora na kuzingatia mahitaji ya wateja, lengo letu ni kuwawezesha wakulima, kuboresha kilimo, na kuchangia katika maendeleo ya jumla katika sekta ya kilimo nchini Tanzania.


                        </p>


                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Why Choose Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>MAADILI YETU YA MSINGI</h2>

            </div>

            <div class="row g-0" data-aos="fade-up" data-aos-delay="200">

                <div class="col-xl-5 img-bg" style="background-image: url('website/assets/img/why-us-bg.jpg')"></div>
                <div class="col-xl-7 slides  position-relative">

                    <div class="slides-1 swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3"><u>MAONO YETU</u></h3>
                                    <h4 class="mb-3">Kuwa mshirika nambari moja kwa wakulima wa kuku nchini Tanzania, hasa wanawake na vijana.</h4>
                                    <p>Dira yetu ni kuwa kichocheo cha mabadiliko chanya katika sekta ya kilimo, kubadilisha mazoea ya kilimo na kuchochea ukuaji endelevu. Tunatazamia siku za usoni ambapo wakulima watakuwa na ufikiaji wa teknolojia za kisasa, mafunzo, na rasilimali, kuwawezesha kupata mavuno makubwa, faida, na mafanikio kwa ujumla.</p>
                                </div>
                            </div><!-- End slide item -->

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3"><u>DHAMIRA YETU</u></h3>
                                    <h4 class="mb-3">Kujenga ushirikiano na kuendeleza viunganishi  vyote katika mlolongo wa thamani wa ufugaji wa kuku.</h4>
                                    <p>Dhamira yetu ni kutoa suluhisho kamili na huduma zinazoboresha uzalishaji wa kilimo, kusaidia mazoea endelevu, na kuboresha maisha ya wakulima nchini Tanzania. Tunajitahidi kuwa mshirika wa kwanza na kuaminika kwa wakulima, kutoa bidhaa za ubora wa juu, ushauri wa wataalamu, na suluhisho za ubunifu ili kukidhi mahitaji yao yanayobadilika. </p>
                                </div>
                            </div><!-- End slide item -->

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3"><u>MAADILI YETU</u></h3>
                                    <div class="row gy-4">

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">
                                                <i class="bi bi-check-circle-fill" style="color: #ffbb2c;"></i>
                                                <span>&nbsp; Ubora</span>
                                            </div>
                                        </div><!-- End Icon List Item-->

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">

                                                <i class="bi bi-check-circle-fill" style="color: #5578ff;"></i>
                                                <span>&nbsp; Uaminifu</span>
                                            </div>
                                        </div><!-- End Icon List Item-->

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">
                                                <i class="bi bi-check-circle-fill" style="color: #e80368;"></i>
                                                <span>&nbsp; Uadilifu</span>
                                            </div>
                                        </div><!-- End Icon List Item-->

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">
                                                <i class="bi bi-check-circle-fill" style="color: #e361ff;"></i>
                                                <span>&nbsp; Ushirikiano</span>
                                            </div>
                                        </div><!-- End Icon List Item-->

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">
                                                <i class="bi bi-check-circle-fill" style="color: #47aeff;"></i>
                                                <span>&nbsp; Ubunifu</span>
                                            </div>
                                        </div><!-- End Icon List Item-->

                                        <div class="col-md-6">
                                            <div class="icon-list d-flex">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>&nbsp; Matokeo chanya</span>
                                            </div>
                                        </div><!-- End Icon List Item-->
                                    </div>

                                </div>
                            </div><!-- End slide item -->

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3"><u>KAULI MBIU YETU</u></h3>
                                    <h4 class="mb-3">Kushiriki ustawi kupitia ushirikiano</h4>
                                    <p>Bidhaa na huduma bora. Uwekezaji endelevu. Uwajibikaji kwa Jamii na Mazingira.</p>
                                </div>
                            </div><!-- End slide item -->

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

            </div>

        </div>
    </section><!-- End Why Choose Us Section -->

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
                            <img src="{{ asset('website/assets/img/team/team-4.jpg') }}" class="img-fluid"
                                alt="">
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
                            <img src="{{ asset('website/assets/img/team/team-3.jpg') }}" class="img-fluid"
                                alt="">
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
                            <img src="{{ asset('website/assets/img/team/team-6.JPG') }}" class="img-fluid"
                                alt="">
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
                            <img src="{{ asset('website/assets/img/team/team-2.jpg') }}" class="img-fluid"
                                alt="">
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
                            <img src="{{ asset('website/assets/img/team/team-5.jpeg') }}" class="img-fluid"
                                alt="">
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
