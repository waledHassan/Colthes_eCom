<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>


         <div class="col-lg-6">
         <form action="{{url('searchproducts')}}" method="get">
            @csrf
            <input type="text" class="form-control" placeholder="Search..."  name="name"/>
            <button class="form-control"><i class="lni lni-search-alt"></i> Search</button>
         </form>
         </div>


       <div class="row">

         @if (session()->has('message'))

         <div class="alert alert-primary text-center container">
             {{session()->get('message')}}
             <button type="button" class="close" data-dismiss='alert'>x</button>
         </div>
         
     @endif

         @foreach ($data as $product)

          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_detail' , $product->id)}}" class="option1">
                           {{$product->name}}
                      </a>

                      <form action="{{url('AddToCart' , $product->id)}}" method="POST">
                        @csrf
                         <div class="row">
                            <div class="col-md-4">
                               <input style="height: 20px;margin-top:10px;" type="number" name="quantity" value="1" min="1">
                            </div>
                            <div class="col-md-4">
                               <input type="submit" value="Add To Cart">
                            </div>
                         </div>
                      </form>

                   </div>
                </div>
                <div class="img-box">
                   <img src="productimage/{{$product->image}}" style="width:350px;" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                           {{$product->name}}
                   </h5>

                   @if ($product->discount_price != null)
                     <h6>
                        ${{$product->discount_price}}
                     </h6>
                   @endif
                   <h6>
                      ${{$product->price}}
                   </h6>
                </div>
             </div>
          </div>

          @endforeach

          {{-- @if (method_exists($data,'links'))

            {!! $data->links() !!}

        @endif --}}

        <span style="padding-top:20px;">
           {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
        </span>

       </div>
       <div class="btn-box">
          <a href="">
          View All products
          </a>
       </div>
    </div>
 </section>