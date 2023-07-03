<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\product;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\cart;

use App\Models\order;

use App\Models\comments;

use App\Models\Reply;

use Egulias\EmailValidator\Parser\Comment as ParserComment;
use Illuminate\Support\Facades\Auth;

use Session;

use Stripe;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
        public function redirect()
        {
            if(Auth::id())
            {
                    $usertype = Auth::user()->usertype;
                    if($usertype == '1')
                    {
                        $total_product = product::all()->count();
                        $total_order = order::all()->count();
                        $total_user = user::all()->count();
                        $total_delivered_order = order::where('delivery_status' , 'Delivered')->count();
                        $total_processing_order = order::where('delivery_status' , 'processing')->count();
                        
                        $order = order::all();
                        $total_revenue = 0;
                        foreach($order as $order)
                        {
                            $total_revenue = $total_revenue + $order->price;
                        }
                       
                        return view('admin.home' , compact('total_product', 'total_order', 'total_user', 'total_delivered_order', 'total_processing_order', 'total_revenue'));
                    }
                    else
                    {
                        $comments = comments::orderby('id' , 'desc')->get();
                        $replies = reply::all();
                        $data = product::paginate(6);
                        return view('user.home' , compact('data', 'comments' , 'replies'));
                    }

            }
            else
            { 
                $comments = comments::orderby('id' , 'desc')->get();
                $replies = reply::all();
                $data = product::paginate(6);
                return view('user.home' , compact('data', 'comments' , 'replies'));
            }
        }



        public function product_detail($id)
        {
            $product = product::find($id);
            return view('user.product_detail' , compact('product'));
        }



        public function AddToCart(Request $request , $id)
        {
            if(Auth::id())
            {
                $user = Auth::user();
                $product = product::find($id);

                $product_exist_id = cart::where('product_id' , '=' , $id)->where('user_id' , '=' , $user->id)->get('id')->first();

                if($product_exist_id)
                {
                    $cart = cart::find($product_exist_id)->first();
                    $quantity = $cart->quantity;
                    $cart->quantity = $quantity + $request->quantity;
                }
                else
                {

                    $cart = new cart;
                    $cart->name = $user->name ;
                    $cart->email = $user->email ;
                    $cart->phone = $user->phone ;
                    $cart->address = $user->address ;
                    $cart->user_id = $user->id ;
                    $cart->product_title = $product->name ;
                    $cart->quantity = $request->quantity ;

                    if($product->discount_price != null)
                    {
                        $cart->price = $product->discount_price * $cart->quantity;
                    }
                    else
                    {
                        $cart->price = $product->price * $cart->quantity;
                    }
                    $cart->image = $product->image ;
                    $cart->product_id = $id ;

                }
                $cart->save();
                Alert::success('Product Added Successfully' , 'We Add This Product To Your Cart');
                return redirect()->back();
            }
            else
            { 
                return redirect('login');
            }
        }



        public function ShowCart()
        {
            if(Auth::id())
            {
                $userid = Auth::user()->id;
                $cart = cart::where('user_id' , $userid)->get();

                return view('user.ShowCart' , compact('cart'));
            }
            else
            {
                return redirect('login');
            }
        }



        public function Showorders()
        {
            if(Auth::id())
            {
                $userid = Auth::user()->id;
                $orders = order::where('user_id' , $userid)->get();

                return view('user.Showorders' , compact('orders'));
            }
            else
            {
                return redirect('login');
            }
        }



        public function DeleteFromCart($id)
        {
            $cart = cart::find($id);
            $cart->delete();
            Alert::warning('Product Removed Successfully' , 'We remove This Product from Your Cart');
            return redirect()->back();
        }



        public function Cancelorder($id)
        {
            $order = order::find($id);
            $order->delivery_status='Canceled';
            $order->save();
            return redirect()->back()->with('message' , 'Canceled Successfully');
        }



        public function cash_order()
        {
            if(Auth::id())
            {
                $userid = Auth::user()->id;
                $data = cart::where('user_id' , '=' , $userid)->get();

                foreach($data as $data)
                {
                    $order = new order;

                    $order->name = $data->name;
                    $order->email = $data->email;
                    $order->phone = $data->phone;
                    $order->address = $data->address;
                    $order->user_id = $data->user_id;
                    $order->product_title = $data->product_title;
                    $order->price = $data->price;
                    $order->quantity = $data->quantity;
                    $order->image = $data->image;
                    $order->product_id = $data->product_id;
                    $order->payment_status = 'Cash on Delivery';
                    $order->delivery_status = 'Processing';

                    $order->save();

                    $cart_id = $data->id;
                    $cart = cart::find($cart_id);
                    $cart->delete();
                }

                return redirect()->back()->with('message' , 'We Have Received Your Order . We Will Contact You Soon');
            }
            else
            { 
                return redirect('login');
            }
        }




        public function stripe($totalprice)
        {
            return view('user.stripe' , compact('totalprice'));
        }


        public function stripePost(Request $request , $totalprice)
        {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            Stripe\Charge::create ([
                    "amount" => $totalprice * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Thanks For payment." 
            ]);


            $userid = Auth::user()->id;
            $data = cart::where('user_id' , '=' , $userid)->get();

            foreach($data as $data)
            {
                $order = new order;

                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->user_id = $data->user_id;
                $order->product_title = $data->product_title;
                $order->price = $data->price;
                $order->quantity = $data->quantity;
                $order->image = $data->image;
                $order->product_id = $data->product_id;
                $order->payment_status = 'Paid';
                $order->delivery_status = 'Processing';

                $order->save();

                $cart_id = $data->id;
                $cart = cart::find($cart_id);
                $cart->delete();
            }


            Session::flash('success', 'Payment $ '.$totalprice.' successful!');
            return back();
        }   




        public function add_comment(Request $request)
        {
            if(Auth::id())
            {
                $comment = new comments;
                $username = Auth::user()->name;
                $userid = Auth::user()->id;

                $comment->name=$username;
                $comment->user_id=$userid;
                $comment->comment=$request->comment;

                $comment->save();
                return redirect()->back();
            }
            else
            {
                return redirect('login');
            }
        }



        public function add_reply(Request $request)
        {
            if(Auth::id())
            {
                $reply = new reply;
                $username = Auth::user()->name;
                $userid = Auth::user()->id;

                $reply->name=$username;
                $reply->comment_id=$request->commentId;
                $reply->reply=$request->reply;
                $reply->user_id=$userid;

                $reply->save();
                return redirect()->back();
            }
            else
            {
                return redirect('login');
            }
        }




        public function searchproductsdata(Request $request)
        {
            $search = $request->name;
            $data = product::where('name' , 'like' , "%$search%")->orwhere('category' , 'like' , "%$search%")->paginate(6);

            $comments = comments::orderby('id' , 'desc')->get();
            $replies = reply::all();
            return view('user.products' , compact('data', 'comments', 'replies'));
        }



        public function products()
        {
            $data = product::all();
            $comments = comments::orderby('id' , 'desc')->get();
            $replies = reply::all();
            return view('user.products' , compact('data', 'comments', 'replies'));
        }
}

