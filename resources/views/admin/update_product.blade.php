<base href="/public">
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

       <form action="{{url('do_update_product' , $data->id)}}" method='POST' enctype="multipart/form-data">
          @csrf
        <div class="col-lg-10 mt-8" style='margin-left:100px;'>
            <div class="card-style mb-30">
            <h6 class="mb-25">Add Product</h6>

            <div class="input-style-1">
                <label>Product Name</label>
                <input value='{{$data->name}}' type="text" name='name' placeholder="Product Name" required='require'/>
            </div>

            <div class="input-style-1">
                <label>Product Price</label>
                <input value='{{$data->price}}' type="number" name='price' placeholder="Product Price" required='require' />
            </div>

            <div class="input-style-1">
                <label>Product Discount Price</label>
                <input value='{{$data->discount_price}}' type="number" name='discount_price' placeholder="Product Discount Price" required='require' />
            </div>

            <div class="input-style-1">
                <label>Product Description</label>
                <input value='{{$data->description}}' type="text" name='desc' placeholder="Product Description" required='require' />
            </div>

            <div class="input-style-1">
                <label>Product Quantity</label>
                <input value='{{$data->quantity}}' type="number" name='quantity' placeholder="Product Quantity" required='require' />
            </div>

            <div class="select-style-2">
                <div class="select-position">
                <select name="category">
                    <option value="{{$data->category}}" selected>{{$data->category}}</option>
                    @foreach ($categories as $category)
                       <option value="{{$category->name}}">{{$category->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="input-style-1">
                <label>Product Image</label>
                <input type="file" name='file' />
                <img src="productimage/{{$data->image}}" alt="" style='width:200px;margin-top:20px;'>
            </div>

            
            <div class="input-style-1">
                 <button class='btn btn-primary'>Update</button>
            </div>
         </div>
        </div>
      </form>

@include('admin.footer')