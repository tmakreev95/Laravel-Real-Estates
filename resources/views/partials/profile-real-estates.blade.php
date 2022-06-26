<!-- Published Real Estates -->
@if(Auth::user()->isAdmin())
<div class="row realestates-tab">
  <div class="accordion" id="accordionRealEstatesPublished">
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button aria-expanded="true" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRealEstatesPublished" aria-expanded="true" aria-controls="collapseTwo">
           Published - Real Estates <span class="badge badge-dark">{{ $publishedRealEstates->count() }}</span>
          </button>
        </h5>
      </div>

      <div id="collapseRealEstatesPublished" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionRealEstatesPublished">
        <div class="card-body">
          @if($publishedRealEstates->isEmpty())
          <p>There are no real estates in status 'Published'!</p>
          @else
          @foreach($publishedRealEstates->chunk(2) as $realEstatesChunk)
            <div class="row">
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
                    @if (Auth::user()->isAdmin() == true)
                    <button class="btn btn-danger add-new-real-estate-btn"  onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/delete/realestate/' . $realEstate->id ) }}'; } else {}">Delete</button>
                    @if ($realEstate->status == 'Pending Approve')
                    <button class="btn btn-secondary add-new-real-estate-btn" id="real-estate-approve-btn" onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/approve/realestate/' . $realEstate->id ) }}'; } else {}">Approve</button>
                    @endif
                    @endif   
                    <a href="{{ url('user/edit/realestate/'.$realEstate->id) }}"
                       class="btn btn-success edit-realestate">Edit</a>        
                    <div class="clearfix"></div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            @endforeach          
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
<!-- Published Real Estates -->

<!-- Pending Approve Real Estates -->
<div class="row realestates-tab">
  <div class="accordion" id="accordionRealEstatesPendingApprove">
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button aria-expanded="true" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRealEstatesPendingApprove" aria-expanded="true" aria-controls="collapseTwo">
           Pending Approve - Real Estates <span class="badge badge-dark">{{ $pendingApproveRealEstates->count() }}</span>
          </button>
        </h5>
      </div>

      <div id="collapseRealEstatesPendingApprove" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionRealEstatesPendingApprove">
        <div class="card-body">
          @if($pendingApproveRealEstates->isEmpty())
          <p>There are no real estates in status 'Pending Approve'!</p>
          @else
          @foreach($pendingApproveRealEstates->chunk(2) as $realEstatesChunk)
            <div class="row">
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
                    
                    @if (Auth::user()->isAdmin() == true)
                    <button class="btn btn-danger add-new-real-estate-btn"  onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/delete/realestate/' . $realEstate->id ) }}'; } else {}">Delete</button>
                    
                    @endif
                    <a href="{{ url('user/edit/realestate/'.$realEstate->id) }}"
                       class="btn btn-success edit-realestate">Edit</a>   
                       @if ($realEstate->status == 'Pending Approve')
                    <button class="btn btn-secondary add-new-real-estate-btn" id="real-estate-approve-btn" onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/approve/realestate/' . $realEstate->id ) }}'; } else {}">Approve</button>
                    @endif       
                    <div class="clearfix"></div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            @endforeach          
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
@else
<div class="row realestates-tab">
  <div class="accordion" id="accordionRealEstatesPendingApprove">
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button aria-expanded="true" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRealEstatesPendingApprove" aria-expanded="true" aria-controls="collapseTwo">
           Real Estates <span class="badge badge-dark">{{ $realEstates->count() }}</span>
          </button>
        </h5>
      </div>

      <div id="collapseRealEstatesPendingApprove" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionRealEstatesPendingApprove">
        <div class="card-body">
          @if($realEstates->isEmpty())
          <p>There are no real estates yet!</p>
          @else
          @foreach($realEstates->chunk(2) as $realEstatesChunk)
            <div class="row">
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
                    <button class="btn btn-danger add-new-real-estate-btn"  onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/delete/realestate/' . $realEstate->id ) }}'; } else {}">Delete</button>
                    @if (Auth::user()->isAdmin() && $realEstate->status == 'Pending Approve')
                    <button class="btn btn-secondary add-new-real-estate-btn" id="real-estate-approve-btn" onclick="if(confirm('Are you sure?')){ window.location='{{ url('user/approve/realestate/' . $realEstate->id ) }}'; } else {}">Approve</button>
                    @endif
                    <a href="{{ url('user/edit/realestate/'.$realEstate->id) }}"
                       class="btn btn-success edit-realestate">Edit</a> 
                    <div class="clearfix"></div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            @endforeach          
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
@endif
<!-- Pending Approve Real Estates -->

