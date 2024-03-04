@extends('layouts.admin.base')

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
            
          </div>
        </main>
      </div>
    </div>
  </section>
  <!-- content -->
  
  

@endsection