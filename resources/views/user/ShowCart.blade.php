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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .cart-row{padding:15px 0}
.cart-row:nth-child(even){background:#efefef}
.product-name{font-size:16px;font-weight:600}
.product-options{font-size:12px;margin-bottom:5px}
.product-options span{color:#666;font-weight:400;text-transform:uppercase}
.product-articlenr{color:#666;font-weight:400;text-transform:uppercase}
.product-price small{color:#666;font-weight:300;font-size:20px;margin:0;padding:0;line-height:initial}
.cart-table .cart-row input{width:30px;height:auto;padding:2px;border-radius:0;border-color:#000;float:left;font-size:14px;text-align:center}
.cart-table .cart-row button.update{border:0;padding:7px 8px;background:#000;color:#fff;font-size:9px;float:left;margin-right:5px}
.cart-table .cart-row button.delete{background-color:#FFB2B2;color:#000!important;padding:7px 13px;font-size:13px;border:0;border-radius:50px}
.product-price-total{font-size:16px;font-weight:400;width:80%;float:left}
.cart-actions{display:flex;justify-content:center;align-items:center}
.cart-special-holder{background:#efefef}
.cart-special{padding:1em 1em 0;display:block;margin-top:.5em;border-top:1px solid #dadada}
.cart-special .cart-special-content:before{content:"\21b3";font-size:1.5em;margin-right:1em;color:#6f6f6f;font-family:helvetica,arial,sans-serif}
      </style>
   </head>
   <body>

                             @include('sweetalert::alert')

        
@include('user.header');


    <div class="container">
                <div class="row">
                                
                    @if (session()->has('message'))

                    <div class="alert alert-primary text-center container">
                        {{session()->get('message')}}
                        <button type="button" class="close" data-dismiss='alert'>x</button>
                    </div>
                    
                @endif
                </div>
        <h1 style="font-weight:300">Cart</h1>
    <div class="cart-table">

        <?php $totalprice = 0?>

        @foreach ($cart as $product)
        
                <div class="row cart-row">
                    <div class="col-xs-12 col-md-2">
                    <img src="productimage/{{ $product->image }}" width="100%">
                    </div>
                    <div class="col-md-6">
                    <div class="product-name">{{ $product->product_title }}</div>
                    <div class="product-price">
                        ${{ $product->price }}
                    </div>
                    </div>
                    <div class="col-md-3 cart-actions">
                    <div class="product-price-total">Q: {{ $product->quantity }}</div>
                    <div class="product-delete">
                        <a  onclick="confirmation(event)" href="{{url('/DeleteFromCart' , $product->id)}}" class="delete"><i class="fa fa-times-circle"></i></a>
                        </div>
                    </div>
                </div>

                <?php $totalprice = $totalprice + $product->price ?>

        @endforeach
    
    <div class="row cart-special-holder">
        <div class="col-md-12">
    <div class="cart-special"><div class="cart-special-content">Add some more articles and get discount!!</div></div>
        </div>
    </div>

    <div class="container text-center" style="margin-top:20px;">

    Total Price = $ {{ $totalprice }}

    <h3 style="margin-top:20px;">Proceed To Order</h3>

    <a style="margin:15px 0 20px 0px;" href="{{url('cash_order')}}" class="btn btn-outline-danger">Cash On Delivery</a>

    <a style="margin:15px 0 20px 0px;" href="{{url('stripe' , $totalprice)}}" class="btn btn-outline-danger">Pay Using Cards</a>

    </div>
    </div>

    @include('user.footer')

    <script>
            function confirmation(ev){
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                    title: 'Are you Sure To Cancel This Product',
                    text: 'you Will not be able To revert This!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then(willCancel) => {
                    if(willCancel){
                        window.location.href = urlToRedirect;   
                    }
                }
            }
    </script>
   </body>
</html>