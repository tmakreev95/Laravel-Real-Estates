@extends('layouts.master')

@section('title')
Real Estates - 2020
@endsection

@section('content')
  @if (session()->has('success'))
    <div class="row">
      <div class="col-sm-6 col-md-offset-4 col-sm-offset-3">
        <div class="alert alert-success" id="charge-message">
          {{ Session::get('success') }}
        </div>
      </div>
    </div>
  @endif
  @if($realEstates->isEmpty())
    <h2>There is no real estates with this categories!</h2>
  @else
    <h2 class="heading-real-estates-category">There @if($realEstates->count() > 1) are @elseif($realEstates->count() == 1) is @endif {{ $realEstates->count() }} @if($realEstates->count() > 1) real estates @elseif($realEstates->count() == 1) real estate @endif of category - {{ $categoryNew->title }}</h2>
    <div class="row">
        <div class="real-estates-pagination">
         {{ $realEstates->links() }}
        </div>
        <div class="clearfix"></div>
    </div>
    @foreach($realEstates->chunk(2) as $realEstatesChunk)
  <div class="row row-index-realEstate">
    @foreach ($realEstatesChunk as $realEstate)
    <div class="col-sm-6 col-md-6">
      <div class="thumbnail">
        <img src="{{ $realEstate->imagePath }}">
        <div class="caption">
          <span class="real-estate-ref pull-right">№ {{ $realEstate->ref }}</span>
          <h3>{{ $realEstate->title }}</h3>
          <p class="product-description">{{ $realEstate->description }}</p>
          <p class="product-categories">Categories: 
            @foreach ($realEstate->categories as $category)
              <span class="real-state-category">
                {{ $category->title }}
              </span>
            @endforeach
          </p>
          <p class="product-categories">Posted by: {{ $realEstate->user->name }}</p>
          <p class="product-categories">Status: {{ $realEstate->status }}</p>
          <span class="product-price-tag pull-left">{{ $realEstate->dimension }} кв. м.</span>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endforeach
  @endif
@endsection
