@extends('layouts.master')

@section('content')
<h1 class="greetings">Hello, {{ Auth::user()->name }} - This is your profile and your real estates list</h1>
<div class="row">
  <!-- Roles -->
  <div class="col-md-12 col-md-offset-2">    
    <p class="user-profile-roles">Roles: @foreach ($roles as $role) {{ $role->title }} | @endforeach</p>
    <button class="btn btn-primary add-new-real-estate-btn"  onclick="window.location='{{ route('user.add.realestate') }}'">Add Real Estate</button>
    @if(Auth::user()->isAdmin() == true)
    <button id="add-new-category-btn" class="btn btn-primary add-new-real-estate-btn"  onclick="window.location='{{ route('user.add.realestate.category') }}'">Add Category</button>
    @endif
    <div class="clearfix"></div>
  </div> 
  <!-- Roles -->   
</div>
<!-- Categories -->
@includeWhen(Auth::user()->isAdmin() == true, 'partials.admin-categories')
<!-- Categories -->

<!-- Real Esatte -->
@include('partials.profile-real-estates')
<!-- Real Esatte -->

@endsection