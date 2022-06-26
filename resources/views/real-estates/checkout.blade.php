@extends('layouts.master')

@section('title')
PC Store - Shopping Cart
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <h1>Checkout</h1>
      <h4>Your Total: ${{ $total }}</h4>
      <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'd-none' : '' }}">
        {{ Session::get('error')}}
      </div>
      <form action="{{ route('checkout') }}" method="post" id="checkout-form">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="name-checkout">Name</label>
              <input type="text" id="name-checkout" name="name_checkout" class="form-control" required placeholder="Enter your name...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" name="address" class="form-control" required placeholder="Enter your address...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-name">Card Holder Name</label>
              <input type="text" id="card-name" class="form-control" required placeholder="Enter your card holder name...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-number">Credit Card Number</label>
              <input type="text" id="card-number" class="form-control" required placeholder="Enter your card number...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-expiry-month">Expiration Month</label>
              <input type="text" id="card-expiry-month" class="form-control" required placeholder="Enter card's expiration month...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-expiry-year">Expiration Year</label>
              <input type="text" id="card-expiry-year" class="form-control" required placeholder="Expiration Year...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-cvc">CVC</label>
              <input type="text" id="card-cvc" class="form-control" required placeholder="Enter your card's CVC...">
            </div>
          </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success">Buy Now</button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://js.stripe.com/v2/"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{  URL::to('src/javascript/checkout.js') }}"></script>
@endsection
