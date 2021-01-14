@extends('homepage.index')
@section('header')
    <title>Seralight.ID - Make Up & Skin Care</title>

@endsection
@section('slide')
  @include('homepage.layout.slider')
@endsection
@section('contents')
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
                          {{ $products->name_product}}
                        </a></h3>
                        <p class="price">Rp. {{number_format($products->price)}}</p>
                      </div>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
              <div class="pages">
                <p class="loadMore text-center"><a href="{{url('product')}}" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Load more</a></p>
              </div>
            </div>
          </div>
        </div>
  </div>

@endsection

@section('footer')

@endsection
@show