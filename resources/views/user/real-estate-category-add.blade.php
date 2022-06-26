@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-6 category-add-wrapper">
    <h1>Add new Real Estate Category </h1>
    @if(count($errors) > 0)
      @foreach($errors->all() as $error)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endforeach
    @endif
    <form action="{{ route('user.add.realestate.category') }}" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" required id="title" value="" placeholder="Enter real estate category title">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Enter a description for the real estate category" name="description" class="form-control" id="description" rows="3"></textarea>
      </div>      
      <input type="submit" class="btn btn-primary pull-right" name="submit" value="Add">
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
