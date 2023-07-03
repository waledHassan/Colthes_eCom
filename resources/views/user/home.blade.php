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

      <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <link href="css/style.css" rel="stylesheet" />
      <link href="css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   </head>
   <body>
                         @include('sweetalert::alert')
@include('user.header');

@include('user.whyus')

@include('user.new_arrivals')

@include('user.popular_products')

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

@include('user.Testimonial')

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