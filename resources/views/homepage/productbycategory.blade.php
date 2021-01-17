@extends('homepage.index')
@section('header')
    <title> {{$category->category_name}} - Seralight.ID</title>
@endsection
@section('slide')
 
@endsection
@section('contents')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{$category->category_name}}</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item ">Product</li>
          <li class="breadcrumb-item active">{{$category->category_name}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
 <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-md-9">
              <div class="row products products-big">
                @if(count($category->product) > 0)
                  @foreach($category->product as $pro)
                  <div class="col-lg-4 col-md-6">
                    <div class="product">
                      <div class="image"><a href="{{url('product/detail/' . $pro->id_product)}}"><img src="{{asset('static/dist/img/' . $pro->photo)}}" alt="" class="img-fluid image"></a></div>
                      <div class="text">
                        <h3 class="h5"><a href="{{url('product/detail/' . $pro->id_product)}}">{{$pro->name_product}}</a></h3>
                        <p class="price">Rp. {{ number_format($pro->price)}}</p>
                      </div>
                    </div>
                  </div>
                 @endforeach
                 @else
                  <h4>Product Tidak tersedia</h4>
                 @endif
              </div>
              <div class="row">
                <div class="col-md-12 banner mb-small"><a href="#"><img src="img/banner2.jpg" alt="" class="img-fluid"></a></div>
              </div>
            </div>
            <div class="col-md-3">
              <!-- MENUS AND FILTERS-->
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm category-menu">
                      @foreach($parents as $par)
                        <li class="nav-item"><a href="#" class="nav-link active d-flex align-items-center justify-content-between"><span> {{$par->parent_name}}  </span><span class="badge badge-light">{{count($par->category)}}</span></a>
                          <ul class="nav nav-pills flex-column">
                               @foreach($par->category as $cat)
                              <li class="nav-item"><a href="{{route('category.product', $cat->id_category)}}" class="nav-link">{{$cat->category_name}}</a></li>
                                @endforeach
                           
                          </ul>
                        </li>
                       @endforeach
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