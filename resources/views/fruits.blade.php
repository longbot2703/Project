@extends('layouts.frontend')

@section ('content')



<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
        <h1 class="mb-0 bread">Products</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 mb-5 text-center">
        <ul class="product-category">
          <li><a href="javascript:void(0);" class="active">All</a></li>
          @foreach($lstCategory as $cat)
          <li><a href="javascript:void(0);" onclick="loadListProduct({{$cat->cat_id}})" class="active">{{$Product->$cat->cat_name}}</a></li>
          @endforeach

        </ul>
      </div>
    </div>

    <div class="row">
    @foreach($lsProduct as $Product)
      <div class="col-md-6 col-lg-3 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod"><img class="img-fluid" src="{{asset($Product->pr_image)}}" alt="Colorlib Template">
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="">{{$Product->pr_name}}</a></h3>
            <div class="d-flex">
              <div class="pricing">
                <p class="price"><span>{{$Product->pr_price}}</span></p>
              </div>
            </div>
            <div class="bottom-area d-flex px-3">
            <div class="m-auto d-flex">
                <a href="add/{{$product->pr_id}}" onclick="message()" class="buy-now d-flex justify-content-center align-items-center mx-1">
                <span><i class="ion-ios-cart"></i></span>
                </a>
            </div>
            </div>
          </div>
        </div>
      </div>
       @endforeach
       {{$lsProduct->links()}}


</section>
<script type="text/javascript"src ="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

</script>
<script type="text/javascript" >
function message(){
    swal({
      title:"Sản phẩm đã thêm vào giỏ hàng",
      text:"",
      icon:"success"
    }).then((success)=>{
      if(success){
        location.reload();
      }
    })
  };
</script>

@endsection
