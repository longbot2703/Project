@extends('layouts.frontend')

@section ('content')


<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/bg_1.jpg);">
            <div class="overlay"></div>
            <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                <div class="col-md-12 ftco-animate text-center">
                <h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
                <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                {{-- <p><a href="#" class="btn btn-primary">View Details</a></p> --}}
                </div>
            </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
            <div class="overlay"></div>
            <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-sm-12 ftco-animate text-center">
                <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
                <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                {{-- <p><a href="#" class="btn btn-primary">View Details</a></p> --}}
                </div>

            </div>
            </div>
        </div>
    </div>
</section>

    <section class="ftco-section">
      <div class="container">
        <div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over $100</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Always Fresh</h3>
                <span>Product well package</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<section class="ftco-section ftco-category ftco-no-pt">
  <div class="container">
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
    <div class="row">
      @foreach ($lsCategory as $cat)
        <a href="{{ route('shop.id',$cat->cat_id) }} ">
            <div class="col-md-6">
                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/{{ $cat->imgUrl}});">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="{{route('shop.id',$cat->cat_id)}}">{{ $cat->cat_name }}</a></h2>
                    </div>
                </div>
            </div>
      </a>
      @endforeach

    </div>
  </div>
</section>
<hr>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Featured Products</span>
        <h2 class="mb-4">Our Products</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
        @foreach ($lsProduct as $product)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('prdsingle.id',$product->pr_id)}}" class="img-prod"><img class="img-fluid" src="images/{{ $product->pr_image }}" alt="Colorlib Template">
                        <span class="status">{{ $product->discount }}%</span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">

                        <h3><a href="#">{{ $product->pr_name }}</a></h3>
                         <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc">${{ $product->pr_price }}</span><span class="price-sale">${{ ($product->pr_price)-($product->pr_price)*($product->discount)/100 }}</span> </p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                        <div class="m-auto d-flex">
                            <a href="{{ route('prdsingle.id',$product->pr_id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                            <span><i class="ion-ios-menu"></i></span>
                            </a>
                            <a href="add/{{$product->pr_id}}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                            <span><i class="ion-ios-cart"></i></span>
                            </a>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="text-center">{{ $lsProduct->links() }}</div>
    </div>
  </div>
</section>

{{-- <section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
        <span class="subheading">Best Price For You</span>
        <h2 class="mb-4">Deal of the day</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        <h3><a href="#">Spinach</a></h3>
        <span class="price">$10 <a href="#">now $5 only</a></span>
        <div id="timer" class="d-flex mt-5">
          <div class="time" id="days"></div>
          <div class="time pl-3" id="hours"></div>
          <div class="time pl-3" id="minutes"></div>
          <div class="time pl-3" id="seconds"></div>
        </div>
      </div>
    </div>
  </div>
</section> --}}
<hr>
{{-- mạnh làm --}}
{{-- không có coment , đây là những lời chia sẻ của người sáng lập --}}
<section class="ftco-section testimony-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Testimony</span>
                <h2 class="mb-4">Our satisfied customer says</h2>
                <p>We sell only fresh fruit and vegetables. We sell no saturated fats or anything like that.
                  If you are interested in a healthier life, please chose us for free and we will served you all of our best!</p>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line">We sell only fresh fruit and vegetables. I sell no saturated fats or anything like that.</p>
                                <p class="name">Garreth Smith</p>
                                <span class="position">Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line">i love fresh fruit and vegetables. I'm not a strict dieter.
                                  I don't think that anything in life should be so regimented that you're not having fun or can't enjoy like everybody else.
                                  Just know that fresh food is always going to be better for you</p>
                                <p class="name">James Hetfield</p>
                                <span class="position">Interface Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line">Adopting a healthier new lifestyle may involve changing your diet to include more fresh fruits and vegetables as well as increasing exercise levels.
                                  But the results will be greater than you imagine</p>
                                <p class="name">Fred Durst</p>
                                <span class="position">UI Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <div class="user-img mb-5" style="background-image: url(images/person_4.png)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line">The fresh fruit and vegetables website is a very effective way to raise awareness and consumption of two vital food group
                                  that are sometimes ignored, especially by children.
                                  We hope that with our products, more children will become healthier, no more childrent be in overweight,
                                  and we will have a future generation healthier.</p>
                                <p class="name">Nicolai Reedtz</p>
                                <span class="position">Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <div class="user-img mb-5" style="background-image: url(images/person_5.png)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line">We hope that what we have done will contribute to promoting modern,
                                  efficient and sustainable agricultural production in Vietnam; supply clean and quality products to the domestic market;
                                  contribute to developing and elevating the position of Vietnamese agricultural product brand in the international market.</p>
                                <p class="name">Clinton Loomis</p>
                                <span class="position">System Analyst</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-6">
        <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
        <span>Get e-mail updates about our latest shops and special offers</span>
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <form action="subscribe" class="subscribe-form" method="post">
          @csrf
          <div class="form-group d-flex">
            <input type="text" class="form-control" placeholder="Enter your email address" name="email">
            <input type="submit" value="Subscribe" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>




@endsection
