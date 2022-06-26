<!-- Categories -->
<div class="row categories-tab">
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button aria-expanded="true" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseOne">
           Real Estate Categories <span class="badge badge-dark">{{ $categories->count() }}</span>
          </button>
        </h5>
      </div>

      <div id="collapseCategories" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          @if($categories == null)
          <p>There is no categories yet!</p>
          @else
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($categories as $key => $category) 
              <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>                  
                  <a href="{{ url('user/edit/realestate/category/'.$category->id) }}"
                   class="btn btn-success">Edit</a>
                   <a href="{{ url('user/delete/realestate/category/'.$category->id) }}" 
                  class="btn btn-danger" onclick="return confirm('Are you sure?')"
                  >Delete</a>
                </td>
              </tr> 
            @endforeach   
          </tbody>
        </table>
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
<!-- Categories -->