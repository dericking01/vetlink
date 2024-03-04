@extends('layouts.seller.base')

@section('content')

  <!-- content -->
  <section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
            <div class="border rounded-4 mb-3 d-flex justify-content-center">
                <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="{{  asset('upload/catalog/' . $product->image)  }}">
                    <img style="width: 100%; height: 100vh; margin: auto; object-fit: cover;" class="rounded-4 fit" src="{{  asset('upload/catalog/' . $product->image)  }}" />
                </a>
            </div>

          {{-- <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
            </a>
          </div> --}}
          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
             {{  Str::title($product->name) }}
            </h4>
            <div class="d-flex flex-row my-3">
              <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>{{ $product->quantity }} quantity</span>
              <span class="text-success ms-2">In stock</span>
            </div>

            <div class="mb-3">
              <span class="h5">Tsh {{ $product->price }}</span>
              <span class="text-muted">/per piece</span>
            </div>

            <p>
              {{ $product->description }}
            </p>

            <h5 class="title text-muted">
                <b>SELLER DETAILS</b>
            </h5>

            <div class="row">
              <dt class="col-3">Seller:</dt>
              <dd class="col-9">{{ $product->seller->name }}</dd>

              <dt class="col-3">Phone #</dt>
              <dd class="col-9">{{ $product->seller->phone }}</dd>

              <dt class="col-3">Location</dt>
              <dd class="col-9">{{ $product->seller->location }}</dd>

            </div>

            <hr />

            @if($product->isApproved == 'Approved')
                <a href="#" class="btn btn-success shadow-0"> <i class="me-1 fa fa-check-circle"></i> Approved</a>
            @else
                <a href="#" class="btn btn-danger shadow-0"><i class="me-1 fa fa-times-circle"></i> Rejected</a>
            @endif

            @if($product->status == 'Available')
                <a href="#" class="btn btn-success shadow-0"> <i class="me-1 fa fa-check-circle"></i> Available</a>
            @else
                <a href="#" class="btn btn-danger shadow-0"><i class="me-1 fa fa-times-circle"></i> Sold Out</a>
            @endif

            @if ($product->isApproved == 'Rejected')
            <div class="border border-1 mt-4 border-300 rounded-2 p-3 ask-analytics-item position-relative mb-3">
                <div class="d-flex align-items-center mb-3"><svg class="svg-inline--fa fa-bug fa-w-16 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bug" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M511.988 288.9c-.478 17.43-15.217 31.1-32.653 31.1H424v16c0 21.864-4.882 42.584-13.6 61.145l60.228 60.228c12.496 12.497 12.496 32.758 0 45.255-12.498 12.497-32.759 12.496-45.256 0l-54.736-54.736C345.886 467.965 314.351 480 280 480V236c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v244c-34.351 0-65.886-12.035-90.636-32.108l-54.736 54.736c-12.498 12.497-32.759 12.496-45.256 0-12.496-12.497-12.496-32.758 0-45.255l60.228-60.228C92.882 378.584 88 357.864 88 336v-16H32.666C15.23 320 .491 306.33.013 288.9-.484 270.816 14.028 256 32 256h56v-58.745l-46.628-46.628c-12.496-12.497-12.496-32.758 0-45.255 12.498-12.497 32.758-12.497 45.256 0L141.255 160h229.489l54.627-54.627c12.498-12.497 32.758-12.497 45.256 0 12.496 12.497 12.496 32.758 0 45.255L424 197.255V256h56c17.972 0 32.484 14.816 31.988 32.9zM257 0c-61.856 0-112 50.144-112 112h224C369 50.144 318.856 0 257 0z"></path></svg><!-- <span class="fas fa-bug text-primary"></span> Font Awesome fontawesome.com --><a class="stretched-link text-decoration-none" href="#!">
                    <h5 class="fs--1 text-600 mb-0 ps-3 ">Reason For Rejection</h5>
                  </a></div>
                <h5 class="fs--1 text-800 text-center">{{$product->reason}}</h5>
            </div>
            @endif

        </main>
      </div>
    </div>
  </section>
  <!-- content -->



@endsection
