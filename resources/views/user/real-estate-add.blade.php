@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-6 real-estate-add-wrapper">
    <h1>Add new Real Estate </h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
      @endforeach
    </div>
    @endif
    <form action="{{ route('user.add.realestate') }}" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" required id="title" value="" placeholder="Enter real estate title...">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Enter a description for the real estate" name="description" class="form-control" id="description" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="dimension">Dimension</label>
        <input class="form-control" type="number" name="dimension" required id="dimension" value="" placeholder="Enter real estate dimension...">
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
      </div>      
      <div class="form-group">
        <label for="categories">Categories</label>
        <select name="categories[]" multiple="multiple" class="form-control" id="categories">
        @foreach ($categories as $category)
          <option>{{ $category->title }} </option>
         @endforeach               
        </select>
      </div>
      <input type="submit" class="btn btn-primary pull-right" name="submit" value="Add">
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
