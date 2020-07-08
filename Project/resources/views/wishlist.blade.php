@extends('layouts.frontend')

@section ('content')

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
        <h1 class="mb-0 bread"> Wishlist</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">

                <th>Product List</th>
                <th>Name</th>

                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $pr)
              <tr class="text-center">


                        <td class="image-prod"><div class="img" style="background-image:url(images/{{$pr->pr_image}});"></div></td>

                        <td class="product-name">{{ $pr->pr_name}}</td>

                        <td class="price">${{ $pr->pr_price }} </td>

                        <td class="quantity">
                            <div class="alert alert-danger">Hết hàng</div>
                        </td>

                        <td class="total">{{ $pr->pr_price }}</td>

              </tr><!-- END TR-->
               @endforeach
            </tbody>
          </table>
          <div class="row">
              <div class="col-md-12">{{ $data->links() }} </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
