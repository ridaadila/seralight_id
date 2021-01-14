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
                <li class="breadcrumb-item active">Product</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-md-12">
              <p class="text-muted lead text-center">Jual Make Up & Skin Care terlengkap.</p>
              <div class="products-big">
                <div class="row products">
                  @foreach($product as $products)
                  <div class="col-lg-3 col-md-4">
                    <div class="product">
                      <div class="image">
                        <a href="{{url('product/detail/' . $products->id_product)}}"><img src="{{ asset('static/dist/img/' . $products->photo) }}" alt="" class="img-fluid image1"></a></div>
                      <div class="text">
                        <h3 class="h5"><a href="{{url('product/detail/' . $products->id_product)}}">
                          {{ $products->name_product }}
                        </a></h3>
                        <p class="price">Rp. {{ number_format($products->price) }}</p>
                      </div>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
              <div class="pages">
                <div class="col-md-12" >
                     <div style="text-align: center;" >
                      {{ $product->links() }}
                   </div>
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