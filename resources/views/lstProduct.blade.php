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
          <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
            <span><i class="ion-ios-menu"></i></span>
          </a>
          <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
            <span><i class="ion-ios-cart"></i></span>
          </a>
          <a href="#" class="heart d-flex justify-content-center align-items-center ">
            <span><i class="ion-ios-heart"></i></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<div class="row">
  {{$lsProduct->links()}}
</div>