<!DOCTYPE html>
<html>
   <head>

      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>

      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <link href="css/style.css" rel="stylesheet" />
      <link href="css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   </head>
   <body>
        
@include('user.header');



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


       </div>

    </div>
 </section>



        {{-- comments And Reply System --}}


        <div class="heading_container heading_center">
         <h2>
            Make <span>Comment</span>
         </h2>
      </div>
      <div class="container">
         <div class="col-lg-6" style="margin-left: 300px;">
            <form action="{{url('add_comment')}}" method="POST">
               @csrf
                  <textarea placeholder="Comment Something here" name="comment" id="" cols="30" rows="3" class='form-control'></textarea>
                  <button class="btn btn-outline-primary">Comment</button>
            </form>
         </div>

         @foreach ($comments as $comment)

         <div class="col-lg-6" style="margin: 30px 0 0 300px;">
               <b>{{ $comment->name  }}</b>
               <p>{{ $comment->comment  }}</p>
               <a href="javascript::void(0);" onclick="reply(this)" data-commentid="{{ $comment->id }}">Reply</a>
         </div>

         @foreach ($replies as $reply)

         @if ($reply->comment_id == $comment->id)

            <div class="col-lg-6" style="margin: 10px 0 0 370px;">
               <b>{{ $reply->name  }}</b>
               <p>{{ $reply->reply  }}</p>
            </div>

            @endif

            @endforeach

         @endforeach


   <div class="col-lg-12 replyDiv" style="margin: 50px 0 0 0;display:none;">
      <form action="{{url('add_reply')}}" method="POST">
         @csrf
            <input type="hidden" id="commentId" name="commentId">
            <textarea placeholder="Reply here" name="reply" cols="30" rows="3" class='form-control'></textarea>
            <button class="btn btn-outline-primary">Reply</button>
            <a href="javascript::void(0);" class="btn btn-outline-danger" onclick="reply_close(this)">Close</a>
      </form>
   </div>


      </div>









        {{-- End comments And Reply System --}}


@include('user.footer')

<script>

      function reply(caller)
      {
            document.getElementById('commentId').value=$(caller).attr('data-commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
      }

      function reply_close(caller)
      {
            $('.replyDiv').hide();
      }

      

      document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };

</script>

   </body>
</html>