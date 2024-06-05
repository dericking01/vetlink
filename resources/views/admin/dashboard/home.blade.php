@extends('layouts.admin.base')

@section('content')
<div class="row g-3 mb-3">
    <div class="col-xxl-6 col-xl-12">
      <div class="row g-3">
        <div class="col-12">
          <div class="card bg-transparent-50 overflow-hidden">
            <div class="card-header position-relative">
              <div class="bg-holder d-none d-md-block bg-card z-1" style="background-image:url(../assets/img/illustrations/ecommerce-bg.png);background-size:230px;background-position:right bottom;z-index:-1;"></div>
              <!--/.bg-holder-->
              <div class="position-relative z-2">
                <div>
                  <h3 class="text-primary mb-1">{{ \App\Helpers\SettingsHelper::getGreeting() }}, {{ auth('admin')->user()->name }}!</h3>
                  <p>Here’s what happening with your store today </p>
                </div>
                <div class="d-flex py-3 px-2 text-center">
                  <div class="ps-4">
                    <p class="text-600 fs--1">Today’s Dodoki sales </p>
                    <h4 class="text-800 mb-0">Tsh {{ number_format($totalCompletedAmount) }}/=</h4>
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="card-body p-0">
              <ul class="mb-0 list-unstyled">
                <li class="alert mb-0 rounded-0 py-3 px-x1 alert-warning border-x-0 border-top-0">
                  <div class="row flex-between-center">
                    <div class="col">
                      <div class="d-flex">
                        <div class="fas fa-circle mt-1 fs--2"></div>
                        <p class="fs--1 ps-2 mb-0"><strong>5 products</strong> didn’t publish to your Facebook page</p>
                      </div>
                    </div>
                    <div class="col-auto d-flex align-items-center"><a class="alert-link fs--1 fw-medium" href="#!">View products<i class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                  </div>
                </li>
                <li class="alert mb-0 rounded-0 py-3 px-x1 greetings-item border-top border-x-0 border-top-0">
                  <div class="row flex-between-center">
                    <div class="col">
                      <div class="d-flex">
                        <div class="fas fa-circle mt-1 fs--2 text-primary"></div>
                        <p class="fs--1 ps-2 mb-0"><strong>7 orders</strong> have payments that need to be captured</p>
                      </div>
                    </div>
                    <div class="col-auto d-flex align-items-center"><a class="alert-link fs--1 fw-medium" href="#!">View payments<i class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                  </div>
                </li>
                <li class="alert mb-0 rounded-0 py-3 px-x1 greetings-item border-top  border-0">
                  <div class="row flex-between-center">
                    <div class="col">
                      <div class="d-flex">
                        <div class="fas fa-circle mt-1 fs--2 text-primary"></div>
                        <p class="fs--1 ps-2 mb-0"><strong>50+ orders</strong> need to be fulfilled</p>
                      </div>
                    </div>
                    <div class="col-auto d-flex align-items-center"><a class="alert-link fs--1 fw-medium" href="#!">View orders<i class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                  </div>
                </li>
              </ul>
            </div> --}}
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row flex-between-center g-0">
                <div class="col-6 d-lg-block flex-between-center">
                  <h6 class="mb-2 text-900">Active Customer</h6>
                  <h4 class="fs-3 fw-normal text-700 mb-0">{{$totalActiveAgents}}</h4>
                  {{-- <a href="#">View all</a> --}}
                </div>
                <div class="col-auto h-100">
                  <div class="d-flex align-items-center text-4">
                    <span class="nav-link-icon">
                      <span class="fa fa-users" style="font-size: 2em;"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row flex-between-center g-0">
                <div class="col-6 d-lg-block flex-between-center">
                  <h6 class="mb-2 text-800">Dormant Customer</h6>
                  <h4 class="fs-3 fw-normal text-700 mb-0">{{$totalInactiveAgents}}</h4>
                  {{-- <a href="#">View all</a> --}}
                </div>
                <div class="col-auto h-100">
                  <div class="d-flex align-items-center text-4">
                    <span class="nav-link-icon">
                      <span class="fa fa-users" style="font-size: 2em;"></span>
                      {{-- <span class="fa fa-shopping-bag" style="font-size: 2em;"></span> --}}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row flex-between-center g-0">
                <div class="col-6 d-lg-block flex-between-center">
                  <h6 class="mb-2 text-900">Total Customer</h6>
                  <h4 class="fs-3 fw-normal text-700 mb-0"> {{$totalAgents}} </h4>
                  <a href="{{route('admin.listagents')}}">View all</a>
                </div>
                <div class="col-auto h-100">
                  <div class="d-flex align-items-center text-4">
                    <span class="nav-link-icon">
                      <span class="fa fa-user-secret" style="font-size: 2em;"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xxl-6 col-xl-12">
      <div class="card py-3 mb-3">
        <div class="card-body py-3">
          <h5 class="mb-2 text-primary">DODOKI Orders</h5>
          <div class="row g-0">
            <div class="col-6 col-md-4 border-200 border-bottom border-end pb-4">
              <h6 class="pb-1 text-700">Orders </h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2">{{$totalOrders}} </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">7 </h6>
                <h6 class="fs--2 ps-3 mb-0 text-primary"><span class="me-1 fas fa-caret-up"></span>21.8%</h6>
              </div>
            </div>
            <div class="col-6 col-md-4 border-200 border-bottom border-end-md pb-4 ps-3">
              <h6 class="pb-1 text-700">Items sold </h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2">{{$totalItems}} </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">6 </h6>
                <h6 class="fs--2 ps-3 mb-0 text-warning"><span class="me-1 fas fa-caret-up"></span>11.8%</h6>
              </div>
            </div>
            <div class="col-6 col-md-4 border-200 border-bottom border-end border-end-md-0 pb-4 pt-4 pt-md-0 ps-md-3">
              <h6 class="pb-1 text-700">Total sale </h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2">Tsh {{number_format($totalSale)}}/= </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">Tsh 13,675/= </h6>
                <h6 class="fs--2 ps-3 mb-0 text-success"><span class="me-1 fas fa-caret-up"></span>81.8%</h6>
              </div>
            </div>
            <div class="col-6 col-md-4 border-200 border-bottom border-bottom-md-0 border-end-md pt-4 pb-md-0 ps-3 ps-md-0">
              <h6 class="pb-1 text-700">Pending Orders</h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2"> {{$PendingOrders}} </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">3 </h6>
                <h6 class="fs--2 ps-3 mb-0 text-danger"><span class="me-1 fas fa-caret-down"></span>1.8%</h6>
              </div>
            </div>
            <div class="col-6 col-md-4 border-200 border-bottom-md-0 border-end pt-4 pb-md-0 ps-md-3">
              <h6 class="pb-1 text-700">Completed Orders </h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2">{{$CompletedOrders}} </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">4 </h6>
                <h6 class="fs--2 ps-3 mb-0 text-success"><span class="me-1 fas fa-caret-up"></span>8%</h6>
              </div>
            </div>
            <div class="col-6 col-md-4 pb-0 pt-4 ps-3">
              <h6 class="pb-1 text-700">Rejected Orders </h6>
              <p class="font-sans-serif lh-1 mb-1 fs-2">{{$RejectedOrders}} </p>
              <div class="d-flex align-items-center">
                <h6 class="fs--1 text-500 mb-0">1 </h6>
                <h6 class="fs--2 ps-3 mb-0 text-info"><span class="me-1 fas fa-caret-up"></span>13%</h6>
              </div>
            </div>
          </div>
        </div>
      </div>


        {{-- <div class="card">
            <div class="card-header">
                <div class="row flex-between-center g-0">
                    <div class="col-auto">
                    <h6 class="mb-0">Total Sales</h6>
                    </div>
                    <div class="col-auto d-flex">
                    <div class="form-check mb-0 d-flex"><input class="form-check-input form-check-input-primary" id="ecommerceLastMonth" type="checkbox" checked="checked" /><label class="form-check-label ps-2 fs--2 text-600 mb-0" for="ecommerceLastMonth">Last Month<span class="text-dark d-none d-md-inline">: $32,502.00</span></label></div>
                    <div class="form-check mb-0 d-flex ps-0 ps-md-3"><input class="form-check-input ms-2 form-check-input-warning opacity-75" id="ecommercePrevYear" type="checkbox" checked="checked" /><label class="form-check-label ps-2 fs--2 text-600 mb-0" for="ecommercePrevYear">Prev Year<span class="text-dark d-none d-md-inline">: $46,018.00</span></label></div>
                    </div>
                </div>
            </div>
            <div class="card-body pe-xxl-0">
            <!-- Find the JS file for the following chart at: src/js/charts/echarts/total-sales-ecommerce.js-->
            <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
            <div class="echart-line-total-sales-ecommerce" data-echart-responsive="true" data-options='{"optionOne":"ecommerceLastMonth","optionTwo":"ecommercePrevYear"}'></div>
            </div>
        </div> --}}
    </div>

    <div class="row g-3 mb-3">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0" data-anchor="data-anchor" id="bar-chart">Products Sold<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#bar-chart" style="padding-left: 0.375em;"></a></h5>
                </div>
                {{-- <div class="col-auto ms-auto">
                  <div class="nav nav-pills nav-pills-falcon flex-grow-1" role="tablist"><button class="btn btn-sm active" data-bs-toggle="pill" data-bs-target="#dom-bc8e9a9e-e14d-48b7-b378-449e5a885a8e" type="button" role="tab" aria-controls="dom-bc8e9a9e-e14d-48b7-b378-449e5a885a8e" aria-selected="true" id="tab-dom-bc8e9a9e-e14d-48b7-b378-449e5a885a8e">Preview</button><button class="btn btn-sm" data-bs-toggle="pill" data-bs-target="#dom-fbf63e9a-f181-4770-853f-4983dc922966" type="button" role="tab" aria-controls="dom-fbf63e9a-f181-4770-853f-4983dc922966" aria-selected="false" id="tab-dom-fbf63e9a-f181-4770-853f-4983dc922966" tabindex="-1">Code</button></div>
                </div> --}}
              </div>
            </div>
            <div class="card-body bg-light">
              <div class="tab-content">
                <div class="tab-pane preview-tab-pane active show" role="tabpanel" aria-labelledby="tab-dom-bc8e9a9e-e14d-48b7-b378-449e5a885a8e" id="dom-bc8e9a9e-e14d-48b7-b378-449e5a885a8e">
                  <!-- Find the JS file for the following chart at: src/js/charts/chartjs/chart-bar.js-->
                  <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js--><canvas class="max-w-100" id="chartjs-bar-chart" width="688" height="425" style="box-sizing: border-box; display: block; height: 340px; width: 550.4px;"></canvas>
                </div>
                <div class="tab-pane code-tab-pane" role="tabpanel" aria-labelledby="tab-dom-fbf63e9a-f181-4770-853f-4983dc922966" id="dom-fbf63e9a-f181-4770-853f-4983dc922966"><pre class="scrollbar rounded-1 language-html" style="max-height:420px" tabindex="0"><code class="language-html">
                    <span class="token comment">&lt;!-- Find the JS file for the following chart at: src/js/charts/chartjs/chart-bar.js--&gt;</span>

                    <span class="token comment">&lt;!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js--&gt;</span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>canvas</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>max-w-100<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>chartjs-bar-chart<span class="token punctuation">"</span></span> <span class="token attr-name">width</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>1618<span class="token punctuation">"</span></span> <span class="token attr-name">height</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>1000<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>canvas</span><span class="token punctuation">&gt;</span></span></code></pre>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0" data-anchor="data-anchor" id="line-chart">Sales Line Chart<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#line-chart" style="padding-left: 0.375em;"></a></h5>
                </div>
                {{-- <div class="col-auto ms-auto">
                  <div class="nav nav-pills nav-pills-falcon flex-grow-1" role="tablist"><button class="btn btn-sm active" data-bs-toggle="pill" data-bs-target="#dom-0b8a4b6d-d049-420c-9bab-7195d2a70ef5" type="button" role="tab" aria-controls="dom-0b8a4b6d-d049-420c-9bab-7195d2a70ef5" aria-selected="true" id="tab-dom-0b8a4b6d-d049-420c-9bab-7195d2a70ef5">Preview</button><button class="btn btn-sm" data-bs-toggle="pill" data-bs-target="#dom-557a3f1e-b288-48fe-a18c-1631ea60b01d" type="button" role="tab" aria-controls="dom-557a3f1e-b288-48fe-a18c-1631ea60b01d" aria-selected="false" id="tab-dom-557a3f1e-b288-48fe-a18c-1631ea60b01d" tabindex="-1">Code</button></div>
                </div> --}}
              </div>
            </div>
            <div class="card-body bg-light">
              <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-0b8a4b6d-d049-420c-9bab-7195d2a70ef5" id="dom-0b8a4b6d-d049-420c-9bab-7195d2a70ef5">
                  <!-- Find the JS file for the following chart at: src/js/charts/chartjs/chart-line.js-->
                  <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js--><canvas class="max-w-100" id="chartjs-line-chart" width="688" height="425" style="box-sizing: border-box; display: block; height: 340px; width: 550.4px;"></canvas>
                </div>
                <div class="tab-pane code-tab-pane" role="tabpanel" aria-labelledby="tab-dom-557a3f1e-b288-48fe-a18c-1631ea60b01d" id="dom-557a3f1e-b288-48fe-a18c-1631ea60b01d"><pre class="scrollbar rounded-1 language-html" style="max-height:420px" tabindex="0"><code class="language-html">
                    <span class="token comment">&lt;!-- Find the JS file for the following chart at: src/js/charts/chartjs/chart-line.js--&gt;</span>

                    <span class="token comment">&lt;!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js--&gt;</span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>canvas</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>max-w-100<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>chartjs-line-chart<span class="token punctuation">"</span></span> <span class="token attr-name">width</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>1618<span class="token punctuation">"</span></span> <span class="token attr-name">height</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>1000<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>canvas</span><span class="token punctuation">&gt;</span></span></code></pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>

  <div class="row">
    <div class="col">
      <div class="card h-lg-100 overflow-hidden">
        <div class="card-body p-0">
          <div class="table-responsive scrollbar">
            <table class="table table-dashboard mb-0 table-borderless fs--1 border-200">
              <thead class="bg-light">
                <tr class="text-900">
                  <th>Best Selling Products</th>
                  <th class="text-center">Orders( {{$totalOrders}} )</th>
                  <th class="text-center">Order(%)</th>
                  <th class="text-end">Revenue</th>
                  <th class="pe-x1 text-end" style="width: 8rem">Revenue (%)</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-bottom border-200">
                  {{-- <td>
                    <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('/') }}assets/img/ecommerce/1.jpg" width="60" alt="" />
                      <div class="flex-1 ms-3">
                        <h6 class="mb-1 fw-semi-bold text-nowrap"><a class="text-900 stretched-link" href="#!">Conor</a></h6>
                        <p class="fw-semi-bold mb-0 text-500">Chakula</p>
                      </div>
                    </div>
                  </td> --}}
                  {{-- <td class="align-middle text-center fw-semi-bold">10</td> --}}
                  {{-- <td class="align-middle text-center fw-semi-bold">31%</td> --}}
                  {{-- <td class="align-middle text-end fw-semi-bold">15000</td> --}}
                  {{-- <td class="align-middle pe-x1">
                    <div class="d-flex align-items-center">
                      <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary rounded-pill" style="width: 41%;"></div>
                      </div>
                      <div class="fw-semi-bold ms-2">41%</div>
                    </div> --}}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer bg-light py-2">
          <div class="row flex-between-center">
            <div class="col-auto">
                <select class="form-select form-select-sm">
                    <option>Last 7 days</option>
                    <option>Last Month</option>
                    <option>Last Year</option>
                </select>
            </div>
            <div class="col-auto"><a class="btn btn-sm btn-falcon-default" href="{{route('admin.products.listproducts')}}">View All</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
