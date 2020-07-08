@extends('layouts.frontend')

@section ('content')


<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
  <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
              <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Contact us</span></p>
              <h1 class="mb-0 bread">Contact us</h1>
          </div>
      </div>
  </div>
</div>

<section class="ftco-section contact-section bg-light">
  <div class="container">
      <div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
              <div class="info bg-white p-4">
                  <p><span>Address:</span> Số 8A Tôn Thất Thuyết, Mỹ Đình, Nam Từ Liêm, Hà Nội 100000</p>
              </div>
          </div>
          <div class="col-md-3 d-flex">
              <div class="info bg-white p-4">
                  <p><span>Phone:</span> <a href="tel://1234567920">+84.123.4567.789</a></p>
              </div>
          </div>
          <div class="col-md-3 d-flex">
              <div class="info bg-white p-4">
                  <p><span>Email:</span> <a href="mailto:t1904efpt@gmail.com">t1904efpt@gmail.com</a></p>
              </div>
          </div>
          <div class="col-md-3 d-flex">
              <div class="info bg-white p-4">
                  <p><span>Website:</span> <a href="#">yoursite.com</a></p>
              </div>
          </div>
      </div>
      <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
              <form action="{{url('/contact')}}" class="bg-white p-5 contact-form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Your Name" id="fb_name" name="fb_name">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Your Email" id="fb_email" name="fb_email">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Subject" id="fb_subject" name="fb_subject">
                  </div>
                  <div class="form-group">
                      <textarea name="fb_message" id="fb_message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                  </div>
                  <div class="form-group">
                      <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                  </div>
              </form>

          </div>

          <div class="col-md-6 d-flex">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0968141835706!2d105.78009371563375!3d21.02881188599833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455f9bdf0e1c7%3A0x26caee8e7662dd9b!2zRlBUIEFwdGVjaCBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1592062747246!5m2!1svi!2s"
              width="600"
              height="600"
              frameborder="0"
              style="border:0;"
              allowfullscreen=""
              aria-hidden="false"
              tabindex="0">
            </iframe>
          </div>
      </div>
  </div>
</section>

@endsection
