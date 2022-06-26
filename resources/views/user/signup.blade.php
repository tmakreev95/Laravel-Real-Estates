@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-4 sign-up-wrapper">
    <h1>Sign Up</h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
      @endforeach
    </div>
    @endif
    <form action="{{ route('user.signup') }}" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" required id="email" value="" placeholder="Enter your email...">
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" required id="name" value="" placeholder="Enter your name...">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="passwod" id="password" required value="" placeholder="Enter your password...">
      </div>
      <input type="submit" class="btn btn-primary pull-right" name="submit" value="Sign Up">
      {{ csrf_field() }}
      <div class="clearfix"></div>
    </form>
  </div>
</div>
@endsection
