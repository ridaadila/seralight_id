@extends('homepage.index')
@section('header')
    <title>Seralight.ID - Make Up & Skin Care</title>

@endsection
@section('slide')
 
@endsection
@section('contents')
   <div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">Shopping Cart</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Shopping Cart</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-lg-12">
              <p class="text-muted lead">You currently have {{ count($cart) }} item(s) in your cart.</p>
            </div>
            <form action="{{ url('cart/transaction') }}" method="POST">
              {{ @csrf_field() }}
            <div id="basket" class="col-lg-9">
              <div class="box mt-0 pb-0 no-horizontal-padding">
                <div class="content">
                   <div class="row">
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="company">Name(Member)</label>
                          <input type="hidden" value="{{ Auth::user()->id_user}}" name="iduser">
                               <input id="street" type="text" class="form-control" name="nameuser" value="{{ Auth::user()->name_user }}" readonly="">
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="street">Email(Member)</label>
                          <input id="street" type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="firstname">Alamat</label>
                          <textarea id="addressreceiver" type="text" name="addressreceiver" class="form-control" placeholder="Masukan Alamat Penerima"></textarea>
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="firstname">Kota</label>
                         <select class="form-control" id="city" name="city" onchange="check()">
                              @php
                                  $city = city();
                                  $city = json_decode($city,true);
                              @endphp
                              @foreach($city['rajaongkir']['results'] as $citys)
                                <option value="{{ $citys['city_id']}}">{{ $citys['city_name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="company">Provinsi</label>
                           <input type="text" value="" class="form-control" id="provinsi" readonly="">
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="row">
                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label for="zip">Kode POS</label>
                              <input  type="text" class="form-control" name="portal_code" id="portal_code">
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label for="city" >Ekspedisi</label>
                          <select class="form-control" name="eks">
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                          </select>
                        </div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                    </div>
                  </form>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div id="order-summary" class="box mt-0 mb-4 p-0">
                <div class="box-header mt-0">
                  <h3>Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Order subtotal</td>
                        <th>Rp. {{ number_format(Cart::session(Auth::user()->id_user)->getTotal())}}</th>
                      </tr>
                      <tr class="total">
                        <td>Total</td>
                        <th>Rp. {{ number_format(Cart::session(Auth::user()->id_user)->getTotal())}}</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('footer')
  <script type="text/javascript">
    function check (){
      var id = $("#city").val();
      $.ajax({
        type: "GET",
        url : "{{ url('citybyid/') }}/"+id,
        dataType : "JSON",
        success:function(data){
          $("#provinsi").val(data.rajaongkir.results.province)
          // $("#portal_code").val(data.rajaongkir.results.postal_code)
        }
      });
    }
  </script>
@endsection
@show