@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-6 real-estate-edit-wrapper">
    <h1>Edit Real Estate </h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
      @endforeach
    </div>
    @endif
    <form action="{{ url('user/edit/realestate/'. $realEstate->id) }}" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" value="{{ $realEstate->title }}" type="text" name="title" required id="title" value="" placeholder="Enter real estate title...">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Enter a description for the real estate" name="description" class="form-control" id="description" rows="3">{{ $realEstate->description }}</textarea>
      </div>
      <div class="form-group">
        <label for="dimension">Dimension</label>
        <input class="form-control" value="{{ $realEstate->dimension }}" type="number" name="dimension" required id="dimension" value="" placeholder="Enter real estate dimension...">
      </div>            
      <div class="form-group">
        <label for="categories">Categories</label>
        <select name="categories[]" multiple="multiple" class="form-control" id="categories">
         @foreach ($categories as $category)
            @if($realEstate->categories->contains('title', $category->title))
                <option selected>{{ $category->title }}</option>
            @else
                <option>{{ $category->title }}</option>
            @endif
         @endforeach               
        </select>
      </div>
      <input type="submit" class="btn btn-primary pull-right" name="submit" value="Save">
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
