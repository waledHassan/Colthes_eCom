@include('admin.css')

@include('admin.sidebar')

    <div class="overlay"></div>

    <main class="main-wrapper">

@include('admin.navbar')

@if (session()->has('message'))

<div class="alert alert-primary text-center container">
    {{session()->get('message')}}
    <button type="button" class="close" data-dismiss='alert'>x</button>
</div>

@endif

<div class="row">
    <div class="col-lg-10" style='margin:50px;'>
      <div class="card-style mb-30">
        <h6 class="mb-10">Categories Table</h6>
        <p class="text-sm mb-20">

        </p>
        <div class="table-wrapper table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><h6>Category</h6></th>
                <th><h6>Action</h6></th>
              </tr>
              <!-- end table row-->
            </thead>
            <tbody>

                @foreach ($data as $category)
                    
              <tr>
                <td class="min-width">
                    <p>{{ $category->name }}</p>
                </td>

                <td>
                  <div class="action">
                        
                    <a href='{{url('Delete_Category' , $category->id)}}' class="text-danger">
                        <i class="lni lni-trash-can"></i>
                    </a>
                  </div>
                </td>
              </tr>

                @endforeach

            </tbody>
          </table>
          <!-- end table -->
        </div>
      </div>
      <!-- end card -->
    </div>
    <!-- end col -->
  </div>

@include('admin.footer')