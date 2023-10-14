@extends('layouts.web')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <!-- Pricing Plans -->
      <div class="pb-sm-5 pb-2 rounded-top">
        <div class="container py-5">
          <h2 class="text-center mb-3 mt-0 mt-md-4">Memudahkan Pelaporan Penjualan untuk Pengusaha Aqiqah</h2>
          <p class="text-center">
            AqiqahPro adalah sebuah platform yang dirancang untuk mengurangi beban pelaporan penjualan bagi pengusaha aqiqah. <br>
            Dengan menggunakan sistem ini, pengusaha aqiqah dapat memudahkan pelaporan penjualan dengan cara yang lebih efisien dan akurat, 
          </p>
          <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 py-5">
            <label class="switch switch-primary ms-sm-5 ps-sm-5 me-0">
              <span class="switch-label">Bulanan</span>
              <input type="checkbox" class="switch-input price-duration-toggler" checked />
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label">Tahunan</span>
            </label>
            <div class="mt-n5 ms-n5 ml-2 mb-2 d-none d-sm-block">
              <i class="bx bx-subdirectory-right bx-sm rotate-90 text-muted scaleX-n1-rtl"></i>
              <span class="badge badge-sm bg-label-primary rounded-pill">Dapatkan 2 Bulan gratis</span>
            </div>
          </div>

          <div class="row mx-4 gy-3">
            <!-- Starter -->
            <div class="col-xl mb-lg-0 lg-4">
              <div class="card border shadow-none">
                <div class="card-body">
                  <h5 class="text-start text-uppercase">Starter</h5>

                  <div class="text-center position-relative mb-4 pb-1">
                    <div class="mb-2 d-flex">
                      <h1 class="price-toggle text-primary price-yearly mb-0">Rp 300K</h1>
                      <h1 class="price-toggle text-primary price-monthly mb-0 d-none">Rp 300k</h1>
                      <sub class="h5 text-muted pricing-duration mt-auto mb-2">/Bulan</sub>
                    </div>
                    <small
                      class="position-absolute start-0 m-auto price-yearly price-yearly-toggle text-muted"
                      >3000K / Tahun</small
                    >
                  </div>

                  {{-- <p>All the basics for business that are just getting started</p> --}}

                  <hr />

                  <ul class="list-unstyled pt-2 pb-1">
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                    Formulir Pemesanan Tanpa Batas
                    </li>
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                      1 Dapur
                    </li>
                    <li class="mb-2">
                        <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                          <i class="bx bx-check bx-xs"></i>
                        </span>
                        1 Rph
                      </li>
                      <li class="mb-2">
                        <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                          <i class="bx bx-check bx-xs"></i>
                        </span>
                        Akuntansi Dasar
                      </li>
                      <li class="mb-2">
                        <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                          <i class="bx bx-check bx-xs"></i>
                        </span>
                        Managemen Pengguna
                      </li>
                  
                  </ul>

                  <a href="auth-register-basic.html" class="btn btn-label-primary d-grid w-100"
                    >Get Started</a
                  >
                </div>
              </div>
            </div>

            <!-- Exclusive -->
            <div class="col-xl mb-lg-0 lg-4">
              <div class="card border border-2 border-primary">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-wrap mb-3">
                    <h5 class="text-start text-uppercase mb-0">Pro / 15% OFF</h5>
                    <span class="badge bg-primary rounded-pill">Popular</span>
                  </div>

                  <div class="text-center position-relative mb-4 pb-1">
                    <div class="mb-2 d-flex">
                      <h1 class="price-toggle text-primary price-yearly mb-0">Rp 850K</h1>
                      <h1 class="price-toggle text-primary price-monthly mb-0 d-none">Rp 850K</h1>
                      <sub class="h5 text-muted pricing-duration mt-auto mb-2">/Bulan</sub>
                    </div>
                    <small
                      class="position-absolute start-0 m-auto price-yearly price-yearly-toggle text-muted"
                      >Rp 8.500K / Tahun</small
                    >
                  </div>
                  {{-- <p>Batter for growing business that want to more customers</p> --}}

                  <hr />

                  <ul class="list-unstyled pt-2 pb-1">
                    <li class="mb-2">
                        <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                          <i class="bx bx-check bx-xs"></i>
                        </span>
                      Formulir Pemesanan Tanpa Batas
                      </li>
                      <li class="mb-2">
                        <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                          <i class="bx bx-check bx-xs"></i>
                        </span>
                        Multi Dapur
                      </li>
                      <li class="mb-2">
                          <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                            <i class="bx bx-check bx-xs"></i>
                          </span>
                          Multi Rph
                        </li>
                        <li class="mb-2">
                          <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                            <i class="bx bx-check bx-xs"></i>
                          </span>
                          Akuntansi Pro
                        </li>
                        <li class="mb-2">
                          <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                            <i class="bx bx-check bx-xs"></i>
                          </span>
                          Multi Pengguna
                        </li>
                  </ul>

                  <a href="auth-register-basic.html" class="btn btn-primary d-grid w-100">Get Started</a>
                </div>
              </div>
            </div>

            <!-- Enterprise -->
            <div class="col-xl mb-lg-0 lg-4">
              <div class="card border shadow-none">
                <div class="card-body">
                  <h5 class="text-start text-uppercase">ENTERPRISE</h5>

                  <div class="text-center position-relative mb-4 pb-1">
                    <div class="mb-2 d-flex">
                      <h1 class="price-toggle text-primary price-yearly mb-0">CUSTOM</h1>
                      <h1 class="price-toggle text-primary price-monthly mb-0 d-none">CUSTOM</h1>
                      {{-- <sub class="h5 text-muted pricing-duration mt-auto mb-2">/mo</sub> --}}
                    </div>
                    {{-- <small
                      class="position-absolute start-0 m-auto price-yearly price-yearly-toggle text-muted"
                      >$ 1,788 / year</small
                    > --}}
                  </div>
                  {{-- <p>Advance features for enterprise who need more customization</p> --}}

                  <hr />

                  <ul class="list-unstyled pt-2 pb-1">
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                     Semua Fitur Pro
                    </li>
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                      Integrasi Payment Gateway
                    </li>
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                      Custom Module
                    </li>
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                     Dedicated Server
                    </li>
                    
                    <li class="mb-2">
                      <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                        <i class="bx bx-check bx-xs"></i>
                      </span>
                      Full Support
                    </li>
                  </ul>

                  <a href="auth-register-basic.html" class="btn btn-label-primary d-grid w-100"
                    >Get Started</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Pricing Plans -->
      <!-- Pricing Free Trial -->
      <div class="pricing-free-trial">
        <div class="container">
          <div class="position-relative">
            <div class="d-flex justify-content-between flex-column flex-md-row align-items-center px-5 pt-3">
              <!-- image -->
              <div class="text-center">
                <img
                  src="{{ asset('/') }}assets/img/illustrations/boy-working-light.png"
                  class="img-fluid scaleX-n1"
                  alt="Api Key Image"
                  width="300"
                  data-app-light-img="illustrations/boy-working-light.png"
                  data-app-dark-img="illustrations/boy-working-dark.png" />
              </div>
              <div class="text-center text-md-end mt-3">
                <h3 class="text-primary">Masih Ragu ? Mulailah dengan percobaan Gratis 14 Hari</h3>
                <p class="fs-5">Anda dapat mendapatkan akses penuh ke semua fitur selama 14 Hari. </p>
                <a href="auth-register-basic.html" class="btn btn-primary my-3 my-md-5"
                  >Coba  14 Hari Gratis</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Pricing Free Trial -->
     
      <!--/ Plans Comparison -->
      <!-- FAQS -->
      <div class="row mt-5">
        <div class="col-12 text-center mb-4">
          <div class="badge bg-label-primary">Pertanyaan?</div>
          <h4 class="my-2">Masih Memiliki Pertanyaan?</h4>
          <p>
            Anda selalu bisa menghubungi saya. Saya akan menjawab secepatnya!
          </p>
        </div>
      </div>
      <div class="row text-center justify-content-center gap-sm-0 gap-3">
        <div class="col-sm-6">
          <div class="py-3 rounded bg-faq-section text-center">
            <span class="badge bg-label-primary rounded-3 p-2 my-3">
              <i class="bx bx-phone bx-sm"></i>
            </span>
            <h4 class="mb-2"><a class="h4" href="tel:+(62)89649532860">+ (62) 8964 9532 860</a></h4>
            <p>Saya selalu senang untuk membantu</p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="py-3 rounded bg-faq-section text-center">
            <span class="badge bg-label-primary rounded-3 p-2 my-3">
              <i class="bx bx-envelope bx-sm"></i>
            </span>
            <h4 class="mb-2"><a class="h4" href="mailto:alisadikinsyahrizal@gmail.com">alisadikinsyahrizal@gmail.com</a></h4>
            <p>Cara terbaik untuk mendapatkan jawaban dengan cepat</p>
          </div>
        </div>
      </div>
      <!--/ FAQS -->
    </div>
  </div>
  

@endsection

@push('after-script')
    <script>
      

    document.addEventListener('DOMContentLoaded', function (event) {
        (function () {
            const priceDurationToggler = document.querySelector('.price-duration-toggler'),
            priceMonthlyList = [].slice.call(document.querySelectorAll('.price-monthly')),
            priceYearlyList = [].slice.call(document.querySelectorAll('.price-yearly'));

            function togglePrice() {
            if (priceDurationToggler.checked) {
                // If checked
                priceYearlyList.map(function (yearEl) {
                yearEl.classList.remove('d-none');
                });
                priceMonthlyList.map(function (monthEl) {
                monthEl.classList.add('d-none');
                });
            } else {
                // If not checked
                priceYearlyList.map(function (yearEl) {
                yearEl.classList.add('d-none');
                });
                priceMonthlyList.map(function (monthEl) {
                monthEl.classList.remove('d-none');
                });
            }
            }
            // togglePrice Event Listener
            togglePrice();

            priceDurationToggler.onchange = function () {
            togglePrice();
            };
        })();
    });

    </script>
@endpush