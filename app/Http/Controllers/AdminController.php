<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\User;

use App\Models\order;

use PDF;

class AdminController extends Controller
{
    public function showcategory()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == '1')
            {
                $data = Category::all();
                return view('admin.Show_Categories' , compact('data'));
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }
    }


    public function AddcategoryForm()
    {
        return view('admin.AddcategoryForm');
    }


    public function uploadCategory(Request $request)
    {
        $data = new category;

        $data->name=$request->name;
        $data->save();

        return redirect()->back()->with('message' , 'Category Added Successfully');
    }


    public function Delete_Category($id)
    {
        $data = category::find($id);
        
        $data->delete();

        return redirect()->back()->with('message' , 'Category Deleted Successfully');
    }


    public function showproducts()
    {

            if(Auth::id())
            {
                if(Auth::user()->usertype == '1')
                {
                    $data = product::all();
                    return view('admin.show_products' , compact('data'));
                }
                else
                {
                    return redirect()->back();
                }
            }
            else
            {
                return redirect('login');
            }
    }


    public function Addproducts()
    {
        $categories = Category::all();
        return view('admin.Addproducts' , compact('categories'));
    }


    public function uploadproduct(Request $request)
    {
       $data = new product;

       $image = $request->file;
       $imagename = time().'.'.$image->getClientoriginalExtension();
       $request->file->move('productimage' , $imagename);

       $data->image=$imagename;
       $data->name=$request->name;
       $data->price=$request->price;
       $data->discount_price=$request->discount_price;
       $data->description=$request->desc;
       $data->quantity=$request->quantity;
       $data->category=$request->category;

       $data->save();
       return redirect()->back()->with('message' , 'Product Added Successfully');
    }


    public function updateproduct($id)
    {
       $categories = Category::all();
       $data=product::find($id);
       return view('admin.update_product' , compact('data' , 'categories'));
    }


    public function do_update_product(Request $request , $id)
    {

       $data = product::find($id);

       $image = $request->file;

       if($image)
       {
           $imagename = time().'.'.$image->getClientoriginalExtension();
           $request->file->move('productimage' , $imagename);
           $data->image=$imagename;
       }


       $data->name=$request->name;
       $data->price=$request->price;
       $data->discount_price=$request->discount_price;
       $data->description=$request->desc;
       $data->quantity=$request->quantity;
       $data->category=$request->category;

       $data->save();
       return redirect()->back()->with('message' , 'product Updated Successfully');

    }


    public function deleteproduct($id)
    {
       $data = product::find($id);

       $data->delete();
       return redirect()->back()->with('message' , 'Product Deleted Successfully');
    }



    public function showorders()
    {

            if(Auth::id())
            {
                if(Auth::user()->usertype == '1')
                {
                    $product = order::all();
                    return view('admin.show_orders' , compact('product'));
                }
                else
                {
                    return redirect()->back();
                }
            }
            else
            {
                return redirect('login');
            }
    }



    public function updateDeliveredstatus($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back()->with('message' , 'Order Updated To Delivered Successfully');
    }



    public function print_pdf($id)
    {
        $product = order::find($id);
        $pdf = PDF::loadView('admin.pdf' , compact('product'));
        return $pdf->download('order_details.pdf');
    }



    public function searchOrdersdata(Request $request)
    {
        $search = $request->name;

        $product = order::where('product_title' , 'like' , "%$search%")->get();
        return view('admin.show_orders' , compact('product'));
    }
}
