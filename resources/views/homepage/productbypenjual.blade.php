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
              <h1 class="h2">All Product</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">{{ $penjual->username }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  <div id="content">
  	<br>
  	<div class="container">
          <div class="row">
            <div class="col-md-12">
            	<table class="table table-bordered">
            		<tr><th width="200px">Username</th><td>{{ $penjual->username }}</td></tr>
            		<tr><th>Name</th><td>{{ $penjual->name_user }}</td></tr>
            		<tr><th>Emai</th><td>{{ $penjual->email }}</td></tr>
            		<tr><th>Address</th><td>{{ $penjual->address }}</td></tr>
            		<tr><th>Photo</th><td>
                  @if ($penjual->photo=='static/dist/img/avatar5.png')
                  <img src="{{ url($penjual->photo) }}" width="100px" height="200px"></td></tr>
                  @else
                  <img src="{{ url('static/dist/img/' . $penjual->photo) }}" width="100px" height="200px"></td></tr>
                  @endif
                  
            		<tr><th>Tanggal Bergabung</th><td>{{ date('d/m/y',strtotime($penjual->created_at)) }}</td></tr>
            	</table>
            </div>
        </div>
    </div>
        <div class="container">
          <div class="row bar">
            <div class="col-md-12">
              <p class="text-muted lead text-center">Jual Make Up & Skin Care terlengkap.</p>
              <div class="products-big">
                <div class="row products">
                  @foreach($penjual->product as $product)
                  <div class="col-lg-3 col-md-4">
                    <div class="product">
                      <div class="image">
                        <a href="{{ url('product/detail/'.$product->id_product) }}"><img src="{{ asset('static/dist/img/' . $product->photo) }}" alt="" class="img-fluid image"></a></div>
                      <div class="text">
                        <h3 class="h5"><a href="{{ url('product/detail/'.$product->id_product) }}">
                          {{ $product->name_product }}
                        </a></h3>
                        <p class="price">Rp. {{ number_format($product->price) }}</p>
                      </div>
                    </div>
                  </div>
                  @endforeach
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