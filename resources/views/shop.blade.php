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
          <li><a href="{{route('shop')}}">All</a></li>
          @foreach($lstCategory as $cat)
          <li class=" "  ><a href="{{route('shop.id',$cat->cat_id) }}"> {{$cat->cat_name}}</a></li>
          @endforeach
      </div>
    </div>


    <div class="row">
      <div class="container">
        <div class="row" id="lst-Product">
            @foreach ($lsProduct as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="{{ route('prdsingle.id',$product->pr_id)}}" class="img-prod"><img class="img-fluid" src="images/{{ $product->pr_image }}" alt="Colorlib Template">
                            @if (($product['discount']) !=0)
                                <span class="status">{{ $product->discount }}%</span>
                            @endif
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            {{-- chua day link qua chi tiet --}}
                            <h3><a href="#">{{ $product->pr_name }}</a></h3>
                            <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 @if (($product['discount']) !=0)  price-dc     @endif">${{ $product->pr_price }}</span>
                                @if (($product['discount']) !=0)
                                    <span class="price-sale">${{ ($product->pr_price)-($product->pr_price)*($product->discount)/100 }}</span> </p>
                                @endif

                            </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{ route('prdsingle.id',$product->pr_id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a id="abc" href="add/{{$product->pr_id}}" onclick="message()" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                <span><i class="ion-ios-cart"></i></span>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
         <hr>

        <div class="row "  >
            <div class="col-md-5"></div>
            <div class="col-md-4 text-center">
                {{$lsProduct->links()}}
            </div>
            <div class="col-md-3"></div>

        </div>
    </div>
  </div>
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
