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
              <h1 class="h2">Order SR{{ $transaction->id_transaction}}</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="customer-orders.html">My Orders</a></li>
                <li class="breadcrumb-item active">Order SR{{$transaction->id_transaction}}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div id="customer-order" class="col-lg-9">
              <p>Silahkan Lakukan pembayaran melalui No Rekening (seralight) 02324347627 ( BCA ).Apabila sudah melakukan pembayatran, silahkan hubungi admin</a>
              <a href="https://api.whatsapp.com/send?phone=6282237021974&text=Selamat%20siang%20admin%2C%20saya%20dengan%20Kode%20Transaksi%20....%20sudah%20melakukan%20pembayaran%20ke%20rekening%20BCA%20SERALIGHT.ID%20.%20Berikut%20akan%20saya%20kirimkan%20bukti%20transaksi%20nya.%20Sekian%2C%20terimakasih.%20Saya%20tunggu%20barangnya%20%F0%9F%98%8A%F0%9F%91%8D" class="btn btn-success">Hubungi admin</a>
              <div class="box">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="border-top-0">No</th>
                        <th  colspan="2" class="border-top-0">Product</th>
                        <th class="border-top-0">Quantity</th>
                        <th class="border-top-0">Price</th>
                        <th class="border-top-0">Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
     
                    @php
                    $gt = 0;
                    $no = 1;
                    @endphp
                    @foreach($transaction->product as $barang)
                    <tr>
                    <td>{{ $no++}}</td>
                    <td> <img src="{{ asset('static/dist/img/' . $barang->photo) }}" alt="Black Blouse Armani" class="img-fluid"> </td>
                    <td> {{ $barang->name_product }}</td>
                    <td>{{ $barang->pivot->quantity }}</td>
                    <td> Rp.{{ number_format($barang->price,2,",",".") }}</td>
                    <td> Rp.{{ number_format($barang->price * $barang->pivot->quantity,2,",",".") }}</td>
                    </tr>
                    
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5" class="text-right ">Order subtotal</th>
                        <th>Rp.{{ number_format($transaction->subtotal,2,",",".") }}</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right">Ongkir</th>
                        <th>Rp.{{ number_format($transaction->biaya_ongkir,2,",",".") }}</th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-right"><b>Grand Total</b></th>
                        <th>Rp.{{number_format($transaction->total_harga, 2, ",", ".")}}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="row addresses">
                  {{-- <div class="col-md-6 text-right">
                    <h3 class="text-uppercase">Pengirim</h3>
                    <p>
                    {{ $transaction->product->user->name }}<br>
                     {{ $transaction->product->user->address }}<br>	
                    {{ $transaction->ekspedisi['name'] }} <br>
                     {{ $transaction->ekspedisi['etd'] }} day <br>				    
                    </p>
                  </div> --}}
                  <div class="col-md-6 text-left">
                    <h3 class="text-uppercase">DETAIL PEMBELIAN</h3>
                    <p> PEMBELI : {{ $transaction->user->name_user }} </p><br>
                     <p> Alamat pengiriman :  {{ $transaction->address_receiver }} </p><br>
                        {{ $transaction->kota}} ,
                        {{ $transaction->provinsi}} ,
                        {{ $transaction->portal_code }} , <br>
                     <p> Lama pengiriman : {{ $transaction->lama_kirim}} hari </p>
                        @if($transaction->status_pembayaran == "belum lunas")
                        STATUS PEMBAYARAN : Belum dibayar
                        @else
                        STATUS PEMBAYARAN : Lunas
                        @endif
                    </p>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
              <!-- CUSTOMER MENU -->
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Customer section</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    <li class="nav-item"><a href="customer-orders.html" class="nav-link active"><i class="fa fa-list"></i> My orders</a></li>
                    <li class="nav-item"><a href="customer-wishlist.html" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a></li>
                    <li class="nav-item"><a href="customer-account.html" class="nav-link"><i class="fa fa-user"></i> My account</a></li>
                    <li class="nav-item"><a href="index.html" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('footer')
 
@endsection
@show