<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
</head>
<body>

 Customer Name : <h3>{{ $product->name }}</h3>
 Customer Email : <h3>{{ $product->email }}</h3>
 Customer Phone : <h3>{{ $product->phone }}</h3>
 Customer Address : <h3>{{ $product->address }}</h3>
 Customer id : <h3>{{ $product->user_id }}</h3>
 Product : <h3>{{ $product->product_title }}</h3>
 Product id : <h3>{{ $product->product_id }}</h3>
 quantity : <h3>{{ $product->quantity }}</h3>
 price : <h3>$ {{ $product->price }}</h3>
 payment Status : <h3>{{ $product->payment_status }}</h3>
 delivery Status : <h3>{{ $product->delivery_status }}</h3>

 <img src="productimage/{{ $product->image}}" alt="">
    
</body>
</html>