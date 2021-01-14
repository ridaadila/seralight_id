@extends('homepage.index')
@section('header')
    <title> {{ $product->name_product}}- Seralight.ID</title>
@endsection
@section('slide')
 
@endsection
@section('contents')
<div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2"> {{ $product->name_product}}</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
 <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-md-9">
              <div id="productMain" class="row">
                <div class="col-sm-6">
                  <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                    <div> <img src=" {{asset('static/dist/img/' . $product->photo)}}" alt="" class="img-fluid"></div>
                   {{--  <div> <img src="img/detailbig2.jpg" alt="" class="img-fluid"></div>
                    <div> <img src="img/detailbig3.jpg" alt="" class="img-fluid"></div> --}}
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="box">
                    <form action="{{url('cart')}}" method="POST">
                      {{ @csrf_field() }}
                    <p class="price" style="margin:0px 0px;">Rp. {{number_format($product->price)}}</p>
                    <br>
                    @if($product->stock < 1 )
                      <p class="text-center">Habis</p>
                    @else
                      <div class="sizes">
                        <select name="qty">
                        <?php
                            for($i=1; $i<=$product->stock; $i++) {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        ?>  
                    </select>
                        @endif
                        <br>
                      </div>
                      <input type="hidden" name="id_product" value="{{$product->id_product}}>">
                      <br><br>
                      <p class="text-center">
                        @if(Auth::user())
                          @if($product->stock < 1)

                          @else
                            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                          @endif
                        @else
                        <small>Login dahulu untuk melakukan transaksi</small>
                        @endif
                      </p>
                    </form>
                  </div>
                  <div data-slider-id="1" class="owl-thumbs">
                    <button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt="" class="img-fluid"></button>
                  </div>
                </div>
              </div>
              <div id="details" class="box mb-4 mt-4">
                 <h4>Penjual</h4>
                 {{$product->user->name_user}}
                <br><br>
                <h4>Weight</h4>
                {{$product->weight}}
                <br><br>
                <h4>Product details</h4>
                {!! $product->description !!}
              </div>
            <!-- <div class="row"> -->
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
                                <li class="nav-item"><a href="#" class="nav-link">{{$cat->category_name}}</a></li>
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