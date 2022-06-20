@extends('layouts.frontend')

@section('title','Halaman Checkout')

@section('content')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="{{ route('home.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
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
                    <select id="provinsi" class="form-control" name="provinsi" required>
                         <option value="">Pilih Provinsi</option>
                        @foreach ($data as $item)
                         <option value="{{ $item->province_id }}">{{ $item->province }}</option>
                        @endforeach
                    </select>
                  </div>

              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <select id="kota" class="form-control" name="kota" required>
                        <option value="">Pilih Kota</option>
                      </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                        <select id="kurir" class="form-control" name="kurir" required disabled>
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                      </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                        <select id="layanan" class="form-control" name="layanan" required disabled>
                        <option value="">Pilih Layanan</option>
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
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->produk->nama_produk }} <strong class="mx-2">x</strong> {{ $cart->qty }}</td>
                        <td>Rp{{ number_format($cart->harga) }}</td>
                      </tr>
                    @endforeach


                    <tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Sub Total</strong></td>
                      <td class="text-black font-weight-bold"><strong>Rp{{ number_format($total) }}</strong></td>
                      <input type="hidden" value="{{ $total }}" id="sub_total">
                    </tr>
                    <tr id="ongkos_kirim" class="d-none">
                        <td class="text-black font-weight-bold"><strong>Ongkos Kirim</strong></td>
                        {{-- <td class="text-black">$350.00</td> --}}
                      </tr>
                    <tr class="d-none" id="total-tr">
                      <td class="text-black font-weight-bold"><strong>Total</strong></td>
                      <td class="text-black font-weight-bold"><strong id="total"></strong></td>
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
                  <button class="btn btn-primary btn-lg btn-block" onclick="buatPesanan()">Buat Pesanan</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

  @push('down-script')
      <script>
            function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
           $('#provinsi').on('change', function (e) {
            var provinsi_id = e.target.value;
            $('#kota').empty();
            $('#kota').append('<option value="0" disable="true" selected="true">Pilih Kota</option>');
            $.get('/kota?province=' + provinsi_id, function (data) {
                $.each(data, function (index, kota) {
                    $('#kota').append('<option value="' + kota.city_id + '">' + kota.city_name + '</option>');
                })
            });
        });

        $('#kota').on('change', function (e) {
            $("#kurir").prop('disabled', false);
        });
        $('#kurir').on('change', function (e) {
            $('#ongkos_kirim').addClass('d-none');
            $('#total-tr').addClass('d-none');

            $("#kurir").prop('disabled', false);
            var provinsi_id = $('select[name=provinsi] option').filter(':selected').val();
            var kota_id = $('select[name=kota] option').filter(':selected').val();
            var kurir = $('select[name=kurir] option').filter(':selected').val();
            $('#layanan').empty();
            $('#layanan').append('<option value="0" disable="true" selected="true">Pilih Layanan</option>');
            $.ajax({
                type: "POST",
                url:  "{{ route('get.ongkir') }}",
                headers: {
                   "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    "provinsi_id": provinsi_id,
                    "kota_id": kota_id,
                    "kurir": kurir,
                },
                dataType: 'json',
                success: function(response) {
                    $('#layanan').prop('disabled', false);
                    let html = '';
                    var data = response.costs;
                    $.each(data, function( index, value ) {
                        var value = data[index].cost[0].value;
                        html += `
                            <option value="${value}" disable="true">${data[index].service} (${numberWithCommas(value)})</option>
                        `;
                    });
                    $('#layanan').append(html);
                }
            });
        });

        $('#layanan').on('change', function (e) {
            $('#text-ongkir').remove();
            $('#ongkir').remove();

            var layanan = $('select[name=layanan] option').filter(':selected').val();

            let html = '';
            html += `
                <td class="text-black" id="text-ongkir"><strong>Rp${numberWithCommas(layanan)}</strong></td>
                <input type="hidden"  id="ongkir" value="${layanan}" />
            `;
            $('#ongkos_kirim').removeClass('d-none');
            $('#ongkos_kirim').append(html);

            var ongkir = parseInt($("#ongkir").val());
            var sub_total = parseInt($("#sub_total").val());
            var total_harga = ongkir + sub_total;

            $('#total-tr').removeClass('d-none');
            $('#total').text('Rp'+numberWithCommas(total_harga));

        });

        function buatPesanan() {
            if(confirm("Buat Pesanan ?")) {
                var ongkir = parseInt($("#ongkir").val());
                var alamat = $("#alamat").val();
                var provinsi = $('select[name=provinsi] option').filter(':selected').text();
                var provinsiVal = $('select[name=provinsi] option').filter(':selected').val();
                var kota = $('select[name=kota] option').filter(':selected').text();
                var kotaVal = $('select[name=kota] option').filter(':selected').val();
                var kurir = $('select[name=kurir] option').filter(':selected').val();
                var layanan = $('select[name=layanan] option').filter(':selected').text();

                 if(provinsiVal == ''){
                    alert('Provinsi Tidak Boleh Kosong!');
                    return false;
                }
                if(kotaVal == ''){
                    alert('Kota Tidak Boleh Kosong!');
                    return false;
                }
                if(alamat.length == 0){
                    alert('Alamat Tidak Boleh Kosong!');
                    return false;
                }

                $.ajax({
                type: "POST",
                url:  "{{ route('checkout.post') }}",
                headers: {
                   "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    "ongkir": ongkir,
                    "alamat": alamat,
                    "provinsi": provinsi,
                    "kota": kota,
                    "kurir": kurir,
                    "layanan": layanan,
                },
                dataType: 'json',
                success: function (result, textStatus, jqXHR) {
                    if(result.status == 'success') {
                        alert(result.message);
                        window.location.replace(result.url);
                    } else {
                        alert(result.message);
                        window.location.replace(result.url);
                    }
                }
            });
            }


         }
      </script>
  @endpush
@endsection
