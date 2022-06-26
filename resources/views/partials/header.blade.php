<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('real-estates.index') }}">Real Estates</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"> 
      @if(Auth::guest() || !Auth::user()->isAdmin())     
      <li class="nav-item">
        <a class="nav-link" href="{{ route('contact-us') }}"><i class="fa fa-envelope"></i> Contact us</a>
      </li>
      @endif
      <!-- Categories -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-list-alt"></i> Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach (RealEstateCategory::all() as $category)                
            <a class="dropdown-item" href="{{ url('/realestates/category/'.$category->id) }}"><i class="fa fa-tag"></i>{{ $category->title }}</a>
            <div class="dropdown-divider"></div>
          @endforeach
        </div>
      </li>
      <!-- Categories -->
      <!-- User Management -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i> User Management
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::check())
            <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i>{{ Auth::user()->name }} - Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fa fa-sign-out"></i>Logout</a>
            @else
            <a class="dropdown-item" href="{{ route('user.signup') }}"><i class="fa fa-pencil-square-o"></i>SignUp</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('user.signin') }}"><i class="fa fa-sign-in"></i>SignIn</a>
            @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('test-page') }}">About us</a>
      </li>
      <!-- User Management -->    
    </ul>
  </div>
</nav>
