@extends('layouts.frontend')

@section('title','Home')

@section('content')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="{{ route('home.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.html">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $produk->nama_produk }}</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="item-entry">
            <a href="#" class="product-item md-height bg-gray d-block">
              <img src="{{ url($produk->gambar) }}" alt="Image" class="img-fluid">
            </a>

          </div>

        </div>
        <div class="col-md-6">
            <h2 class="text-black">{{ $produk->nama_produk }}</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, vitae, explicabo? Incidunt facere, natus soluta dolores iusto! Molestiae expedita veritatis nesciunt doloremque sint asperiores fuga voluptas, distinctio, aperiam, ratione dolore.</p>
            <p class="mb-4">Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.</p>
            <p><strong class="text-primary h4">Rp{{ number_format($produk->harga) }}</strong></p>
            <form action="{{ route('add.cart', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" name="qty" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <p><button  class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Add To Cart</button></p>

          </div>
       </form>
      </div>
    </div>
  </div>

  {{-- <div class="site-section block-3 site-blocks-2">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Featured Products</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 block-3">
          <div class="nonloop-block-3 owl-carousel">
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="{{ asset('/frontend') }}/images/model_1.png" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a href="#">Smooth Cloth</a></h2>
                <strong class="item-price"><del>$46.00</del> $28.00</strong>

              </div>
            </div>
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="{{ asset('/frontend') }}/images/prod_3.png" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a href="#">Blue Shoe High Heels</a></h2>
                <strong class="item-price"><del>$46.00</del> $28.00</strong>


              </div>
            </div>
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="{{ asset('/frontend') }}/images/model_5.png" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a href="#">Denim Jacket</a></h2>
                <strong class="item-price"><del>$46.00</del> $28.00</strong>



              </div>
            </div>
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="{{ asset('/frontend') }}/images/prod_1.png" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a href="#">Leather Green Bag</a></h2>
                <strong class="item-price"><del>$46.00</del> $28.00</strong>

              </div>
            </div>
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="{{ asset('/frontend') }}/images/model_7.png" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a href="#">Yellow Jacket</a></h2>
                <strong class="item-price">$58.00</strong>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div> --}}

@endsection
