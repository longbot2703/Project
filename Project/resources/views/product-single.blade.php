@extends('layouts.frontend')

@section ('content')

<div class="hero-wrap hero-bread" style="background-image: url(images/bg_1.jpg);">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span class="mr-2"><a href="{{ route('shop') }}">Product</a></span></p>
        <h1 class="mb-0 bread">Product Details</h1>
      </div>
    </div>
  </div>
</div>

{{-- chi tiet san pham neu co --}}
@if (isset($product))

    <section class="ftco-section">
        <div class="container">
        <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="" class="image-popup"><img src="images/{{$product->pr_image}}" id="img" class="img-fluid" alt="Colorlib Template">

                </a>

                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 id="name">{{$product->pr_name}}</h3>

                    <div class="rating d-flex">

                    </div>
                    <p class="price"><span id="price">
                        @if ($product->discount > 0)
                            <span class="price-sale">${{ ($product->pr_price)-($product->pr_price)*($product->discount)/100 }} / SP</span>
                        @else
                            <span class="price">{{ $product->pr_price }} / SP</span>
                        @endif</span></p>


                    <p class = "price"> <span>Còn hàng : {{ $product->pr_quantity }} </span></p>
                    <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="text-editor"  >{{ $product->pr_description }} </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        {{-- <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                            <i class="ion-ios-remove"></i>
                            </button>
                        </span> --}}
                        {{-- <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="{{ $product->pr_quantity }}"> --}}
                        {{-- <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                            <i class="ion-ios-add"></i>
                        </button>
                        </span> --}}
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;"></p>
                    </div>
                    </div>
                    <p><a href="add/{{$product->pr_id}}" onclick="message()" class="btn btn-black py-3 px-5">Add to Cart</a></p>
                </div>
            </div>
            <hr>
        </div>
    </section>

@else
    <div class="container ftco-section ftco-category ftco-no-pt">
        <div class="row " style="margin-top:10px;">
            <div class="col-md-12 ">
                <h2 class="text-center  ">Bạn chưa chọn sản phẩm nào  </h2>
            </div>

        </div>
         <hr>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-12 order-md-last align-items-stretch d-flex">
                  <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(images/image_5.jpg);">
                      <div class="text text-center">
                          <h2>Vegetables</h2>
                          <p>Protect the health of every home</p>
                          <p><a href="{{ route('index.shop') }}" class="btn btn-primary">Shop now</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
       <hr>
    </div>

@endif
{{-- end  --}}

{{-- cac san pham lien quan or sp mới --}}
<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Products</span>
        <h2 class="mb-4">New Products</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
        @foreach($listproduct as $pr)
        <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
                <a href="{{ route('prdsingle.id',$pr->pr_id)}}" class="img-prod"><img class="img-fluid" src="images/{{ $pr->pr_image }}" alt="Colorlib Template">
                    @if($pr->discount)
                    <span class="status">{{ $pr->discount }}%</span>
                    <div class="overlay"></div>
                    @endif
                </a>

            <div class="text py-3 pb-4 px-3 text-center">
                <h3>{{$pr->pr_name}}></h3>
                <div class="d-flex">
                    <div class="pricing">
                        <p class="price">
                            @if ($pr->discount >0)
                                <span class="mr-2 price-dc">${{$pr->pr_price}}</span>
                                <span class="price-sale">${{ ($pr->pr_price)-($pr->pr_price)*($pr->discount)/100 }}</span>
                            @else
                                <span class="mr-2 ">${{$pr->pr_price}}</span>
                            @endif
                        </p>

                    </div>
                </div>

                <<div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                    <a href="{{ route('prdsingle.id',$product->pr_id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                        <span><i class="ion-ios-menu"></i></span>
                    </a>
                    <a href="add/{{$product->pr_id}}" onclick="message()" class="buy-now d-flex justify-content-center align-items-center mx-1">
                    <span><i class="ion-ios-cart"></i></span>
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    </div>
<div class="row">{{$listproduct->links()}}</div>
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
{{-- end --}}
@endsection
