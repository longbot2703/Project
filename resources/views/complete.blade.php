@extends('layouts.frontend')

@section ('content')

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="col-md-9" id="warp-inner">
      <div class="col-md-12 hoanthanh">
        <div class="clearfix"></div>
        <p class="info">Quý khách đã đặt hàng thành công!</p>
        <p>- Hóa đơn mua hàng của Quý khách đã được chuyển đến
        địa chỉ email có trong phần Thông tin khách hàng của
        chúng tôi. </p>
        <p>- Sản phẩm của quý khách sẽ được chuyển đến địa chỉ
        của quý khách sau thời gian từ 2-8h, tính từ thời điểm
         xác nhận đơn hàng thành công.</p>
        <p>- Nhân viên giao hàng sẽ liên hệ với quý khách qua
        số điện thoại của quý khách trước khi giao hàng.</p>
        <p>Cám ơn quý khách đã sử dụng sản phẩm của công ty
        chúng tôi!</p><br>

        <h5>Team 1 Shop</h5>
        <p>Detech Tower - số 8 Tôn Thất Thuyết,
           Mỹ Đình, Nam Từ Liêm, Hà Nội</p>


      </div>
      <div class="text-right return"><a href="{{asset('/')}}">Quay lại trang chủ</a>

      </div>
    </div>
  </div>
</section>

@endsection
