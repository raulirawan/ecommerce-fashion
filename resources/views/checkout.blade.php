@extends('layouts.frontend')

@section('title','Halaman Checkout')

@section('content')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      {{-- <div class="row mb-5">
        <div class="col-md-12">
          <div class="border p-4 rounded" role="alert">
            Returning customer? <a href="#">Click here</a> to login
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Data Informasi</h2>
          <div class="p-3 p-lg-5 border">
            {{-- <div class="form-group">
              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
              <select id="c_country" class="form-control">
                <option value="1">Select a country</option>
                <option value="2">bangladesh</option>
                <option value="3">Algeria</option>
                <option value="4">Afghanistan</option>
                <option value="5">Ghana</option>
                <option value="6">Albania</option>
                <option value="7">Bahrain</option>
                <option value="8">Colombia</option>
                <option value="9">Dominican Republic</option>
              </select>
            </div> --}}
            <div class="form-group row">

              <div class="col-md-12">
                <label for="c_lname" class="text-black">Nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="" class="text-black">Pilih Kurir <span class="text-danger">*</span></label>
                    <select id="kurir" class="form-control">
                      <option value="1">Select a country</option>
                      <option value="2">bangladesh</option>
                      <option value="3">Algeria</option>
                      <option value="4">Afghanistan</option>
                      <option value="5">Ghana</option>
                      <option value="6">Albania</option>
                      <option value="7">Bahrain</option>
                      <option value="8">Colombia</option>
                      <option value="9">Dominican Republic</option>
                    </select>
                  </div>

              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <select id="kurir" class="form-control">
                        <option value="1">Select a country</option>
                        <option value="2">bangladesh</option>
                        <option value="3">Algeria</option>
                        <option value="4">Afghanistan</option>
                        <option value="5">Ghana</option>
                        <option value="6">Albania</option>
                        <option value="7">Bahrain</option>
                        <option value="8">Colombia</option>
                        <option value="9">Dominican Republic</option>
                      </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <select id="kurir" class="form-control">
                        <option value="1">Select a country</option>
                        <option value="2">bangladesh</option>
                        <option value="3">Algeria</option>
                        <option value="4">Afghanistan</option>
                        <option value="5">Ghana</option>
                        <option value="6">Albania</option>
                        <option value="7">Bahrain</option>
                        <option value="8">Colombia</option>
                        <option value="9">Dominican Republic</option>
                      </select>
                </div>
              </div>
            </div>

            <div class="form-group">
                <label for="" class="text-black">Alamat Lengkap<span class="text-danger">*</span></label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
            </div>


          </div>
        </div>
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Orderan Anda</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Product</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                      <td>$250.00</td>
                    </tr>
                    <tr>
                      <td>Polo Shirt <strong class="mx-2">x</strong>   1</td>
                      <td>$100.00</td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                      <td class="text-black">$350.00</td>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label for="" class="text-black">Pilih Kurir <span class="text-danger">*</span></label>
                            <select id="kurir" class="form-control">
                              <option value="1">Select a country</option>
                              <option value="2">bangladesh</option>
                              <option value="3">Algeria</option>
                              <option value="4">Afghanistan</option>
                              <option value="5">Ghana</option>
                              <option value="6">Albania</option>
                              <option value="7">Bahrain</option>
                              <option value="8">Colombia</option>
                              <option value="9">Dominican Republic</option>
                            </select>
                          </div>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                      <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                    </tr>
                  </tbody>
                </table>

                {{-- <div class="border p-3 mb-3">
                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                  <div class="collapse" id="collapsebank">
                    <div class="py-2">
                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    </div>
                  </div>
                </div>

                <div class="border p-3 mb-3">
                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                  <div class="collapse" id="collapsecheque">
                    <div class="py-2">
                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    </div>
                  </div>
                </div>

                <div class="border p-3 mb-5">
                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                  <div class="collapse" id="collapsepaypal">
                    <div class="py-2">
                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    </div>
                  </div>
                </div> --}}

                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>
@endsection
