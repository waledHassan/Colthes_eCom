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
        <h1 style="font-weight:300">Orders</h1>
    <div class="cart-table">

        <?php $totalprice = 0?>

        @foreach ($orders as $product)
        
                <div class="row cart-row">
                    <div class="col-xs-12 col-md-2">
                    <img src="productimage/{{ $product->image }}" width="100%">
                    </div>
                    <div class="col-md-6">
                    <div class="product-name">{{ $product->product_title }}</div>
                    <div class="product-price">Delivery : {{ $product->delivery_status }}</div>
                    <div class="product-price">Pay : {{ $product->payment_status }}</div>
                    <div class="product-price"> Price :
                        ${{ $product->price }}
                    </div>
                    </div>
                    <div class="col-md-3 cart-actions">
                        <div class="product-price-total">Q: {{ $product->quantity }}</div>
                    <div class="product-delete">
                        @if ($product->delivery_status == 'processing')
                            
                        <a onclick="return confirm('Are You Sure to Cancel This Order')" href="{{url('Cancelorder' , $product->id)}}" type="button" data-toggle="tooltip" title="Ta bort" class="delete" onclick="return return confirm('Are You Sure')"><i class="fa fa-times-circle"></i></a>
                        
                        @endif
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
   </body>
</html>