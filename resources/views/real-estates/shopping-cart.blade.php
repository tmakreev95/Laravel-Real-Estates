@extends('layouts.master')

@section('title')
PC Store - Shopping Cart
@endsection

@section('content')
  @if(Session::has('cart'))
    <div class="row">
      <div class="col-sm-7 col-md-7 col-md-offset-4 col-sm-offset-4">
        <ul class="list-group">
          @foreach($products as $product)
            <li class="list-group-item">
              <span class="badge pull-right">Quantity: {{ $product['qty'] }}</span>
              <div class="shopping-cart-image-holder pull-left">
                <img src="{{ $product['item']['imagePath'] }}" alt="">
              </div>
              <h5>{{ $product['item']['title'] }}</h5>
              <span class="shopping-cart-product-price pull-left">Price: </span><span class="shopping-cart-product-price-numeric badge badge-success pull-left">{{ $product['price'] }}$</span>
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">Reduce by 1</a>
                  <a class="dropdown-item" href="{{ route('product.remove', ['id' => $product['item']['id']]) }}">Remove item</a>
                </div>
              </div>
            </li>
            <div class="clearfix"></div>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <strong>Total Price: {{ $totalPrice }}$</strong>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
      </div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <h2>No Items In Cart!</h2>
    </div>
  </div>
@endif
@endsection
