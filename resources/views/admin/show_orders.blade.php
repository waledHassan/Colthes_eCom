@include('admin.css')

@include('admin.sidebar')

    <div class="overlay"></div>

    <main class="main-wrapper">

@include('admin.navbar')

          <div class="row">
              @if (session()->has('message'))

                <div class="alert alert-primary text-center container">
                    {{session()->get('message')}}
                    <button type="button" class="close" data-dismiss='alert'>x</button>
                </div>

              @endif
          </div>

          <div class="header-search d-none d-md-flex" style="margin: 40px 0 0 40px;">
            <form action="{{url('searchOrders')}}" method="get">
              @csrf
              <input type="text" class="form-control" placeholder="Search..."  name="name"/>
              <button class="form-control"><i class="lni lni-search-alt"></i> Search</button>
            </form>
          </div>

<div class="row text-center">
    <div class="col-lg-12" style='margin-top:50px;'>
      <div class="card-style mb-30">
        <h6 class="mb-10">Orders Table</h6>
        <p class="text-sm mb-20">

        </p>
        <div class="table-wrapper table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><h6>Product</h6></th>
                <th><h6>Customer</h6></th>
                <th><h6>Email</h6></th>
                <th><h6>phone</h6></th>
                <th><h6>address</h6></th>
                <th style="margin-right: 10px;"><h6>Price</h6></th>
                <th><h6>quantity</h6></th>
                <th><h6>Payment</h6></th>
                <th><h6>Delivery</h6></th>
                <th><h6>Action</h6></th>
                <th><h6>Print</h6></th>
              </tr>
              <!-- end table row-->
            </thead>
            <tbody>

                @forelse ($product as $product)
                    
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
                      <p>{{ $product->product_title }}</p>
                    </div>
                  </div>
                </td>
                <td class="min-width">
                  <p>{{ $product->name }}</p>
              </td>
                <td class="min-width">
                  <p>{{ $product->email }}</p>
              </td>
                <td class="min-width">
                    <p>{{ $product->phone }}</p>
                </td>
                <td class="min-width">
                    <p>{{ $product->address }}</p>
                </td>
                <td class="min-width">
                  <p>${{ $product->price }}</p>
                </td>
                <td class="min-width">
                  <p>{{ $product->quantity }}</p>
                </td>
                <td class="min-width">
                    <p>{{ $product->payment_status }}</p>
                </td>
                <td class="min-width">
                  <p>{{ $product->delivery_status }}</p>
              </td>
                <td>
                  <div class="action">
                    @if ($product->delivery_status != 'Delivered')
                        
                    <a onclick="return confirm('Are You Sure This Product Is Delivered !!!')" href='{{url('updateDeliveredstatus' , $product->id)}}' class="btn btn-outline-secondary">
                        {{-- <i class="lni lni-trash-can"></i> --}}
                        Delivered
                    </a>
                      @else
                        <h6 class="text-success">Deleivered</h6>
                    @endif
                  </div>
                </td>
                <td class="min-width">
                    <a href="{{url('print_pdf' , $product->id)}}" class="btn btn-outline-primary">Print (PDF)</a>
                </td>
              </tr>

              @empty
                   <td class="text-center" colspan="16">No Data Fount</td>

                @endforelse

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