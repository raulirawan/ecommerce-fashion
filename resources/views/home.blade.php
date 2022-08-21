@extends('layouts.frontend')

@section('title','Home')

@section('content')
<div class="site-blocks-cover" data-aos="fade">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto order-md-2 align-self-start">
          <div class="site-block-cover-content">
          <h2 class="sub-title">#New Summer Collection 2019</h2>
          <h1>Arrivals Sales</h1>
          <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
          </div>
        </div>
        <div class="col-md-6 order-1 align-self-end">
          <img src="{{ asset('/frontend') }}/images/model_3.png" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </div>


  <div class="site-section custom-border-bottom" data-aos="fade">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6">
          <div class="block-16">
            <figure>
              <img src="{{ asset('frontend/images/blog_1.jpg') }}" alt="Image placeholder" class="img-fluid rounded">
              {{-- <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="icon-play"></span></a> --}}

            </figure>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">


          <div class="site-section-heading pt-3 mb-4">
            <h2 class="text-black">Murni Collection</h2>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius repellat, dicta at laboriosam, nemo exercitationem itaque eveniet architecto cumque, deleniti commodi molestias repellendus quos sequi hic fugiat asperiores illum. Atque, in, fuga excepturi corrupti error corporis aliquam unde nostrum quas.</p>
          <p>Accusantium dolor ratione maiores est deleniti nihil? Dignissimos est, sunt nulla illum autem in, quibusdam cumque recusandae, laudantium minima repellendus.</p>

        </div>
      </div>
    </div>
  </div>

  <div class="site-blocks-cover inner-page py-5" data-aos="fade">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto order-md-2 align-self-start">
          <div class="site-block-cover-content">
          <h2 class="sub-title">#New Summer Collection 2019</h2>
          <h1>New Shoes</h1>
          <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
          </div>
        </div>
        <div class="col-md-6 order-1 align-self-end">
          <img src="{{ asset('/frontend') }}/images/model_6.png" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
@endsection
