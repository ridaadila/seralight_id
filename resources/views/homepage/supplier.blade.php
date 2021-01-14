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
              <h1 class="h2">Supplier</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Supplier</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <section class="bar mb-0">
            <div class="row">
              <div class="col-md-12">
                <div class="heading">
                  <h2>Supplier</h2>
                </div>
                <div class="row text-center">
                  @foreach($supplier as $sup)
                  <div class="col-md-2 col-sm-3">
                    <div data-animate="fadeInUp" class="team-member">
                      <div class="image"><a href="{{url('penjual/' . $sup->id_user)}}"><img src="{{asset($sup->photo)}}" alt="" class="img-fluid rounded-circle"></a></div>
                      <h3><a href="#">{{$sup->name_user}}</a></h3>
                      <p class="role">{{date('d/m/y', strtotime($sup->created_at))}}</p>
                    </div>
                  </div>
                   @endforeach
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
@endsection

@section('footer')

@endsection
@show