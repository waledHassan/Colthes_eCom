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
    <div class="col-lg-11" style='margin:50px 0px 0 0 ;'>
      <div class="card-style mb-30">
        <h6 class="mb-10">Products Table</h6>
        <p class="text-sm mb-20">

        </p>
        <div class="table-wrapper table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><h6>Name</h6></th>
                <th><h6>Price</h6></th>
                <th><h6>Discount Price</h6></th>
                <th><h6>Description</h6></th>
                <th><h6>quantity</h6></th>
                <th><h6>Category</h6></th>
                <th><h6>Update</h6></th>
                <th><h6>delete</h6></th>
              </tr>
              <!-- end table row-->
            </thead>
            <tbody>

                @foreach ($data as $product)
                    
              <tr>
                <td class="min-width">
                  <div class="lead">
                    <div class="lead-image">
                      <img
                        src="productimage/{{ $product->image }}"
                        alt=""
                      />
                    </div>
                    <div class="lead-text">
                      <p>{{ $product->name }}</p>
                    </div>
                  </div>
                </td>
                <td class="min-width">
                  <p>{{ $product->price }}</p>
                </td>
                <td class="min-width">
                  <p>{{ $product->discount_price }}</p>
                </td>
                <td class="min-width">
                  <p>{{ $product->description }}</p>
                </td>
                <td class="min-width">
                  <p>{{ $product->quantity }}</p>
                </td>
                <td class="min-width">
                  {{ $product->category }}
                </td>
                  <td class="min-width">
                      <a href="{{url('updateproduct' , $product->id)}}" class='btn btn-primary'>Update</a>
                  </td>
                <td>
                  <div class="action">
                    <a onclick="return confirm('Are You Sure')" href='{{url('deleteproduct' , $product->id)}}' class="text-danger">
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