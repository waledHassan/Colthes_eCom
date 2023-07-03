@include('admin.css')

@include('admin.sidebar')

    <div class="overlay"></div>

    <main class="main-wrapper">

@include('admin.navbar')

            @if (session()->has('message'))

                <div class="alert alert-primary container text-center">
                    <button type="button" class="close" data-dismiss='alert' aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
                
            @endif

       <form action="{{url('uploadCategory')}}" method='POST'>
          @csrf
        <div class="col-lg-10 mt-8" style='margin-left:100px;'>
            <div class="card-style mb-30">
            <h6 class="mb-25">Add Category</h6>

            <div class="input-style-1">
                <label>Category Name</label>
                <input type="text" name='name' placeholder="Category Name" required='require'/>
            </div>
            
            <div class="input-style-1">
                 <button class='btn btn-primary'>Add</button>
            </div>
         </div>
        </div>
      </form>

@include('admin.footer')