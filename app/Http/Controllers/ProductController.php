<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
Use DB;
use App\productCategory;
use Validator;
use Input;
use Image;
use Session;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $getCategory = productCategory::getAllCategories();

        $productData = Product::allProduct();
        return view('admin.product',
           [
               'productData' => $productData,
               'getCategory' => $getCategory,
           ]
        );
    }

    public function userViewProduct($id)
    {
        $product = DB::table('product')
            ->where('id', '=', $id)
            ->first();

        return view('user.productDetail',
           [
               'products' => $product,
               'id' => $id,
           ]
        );
    }

    public function userViewCuisine($id)
    {

        $cuisineItems = DB::table('daily_cuisine')
            ->join('product', 'daily_cuisine.product_id', '=', 'product.id')
            ->select('product.*', 'daily_cuisine.*')
            ->where('product.id', $id)
            ->first();

         $cuisineItems;
         return view('user.cuisineDetail',
           [
               'products' => $cuisineItems,
               'id' => $id,
           ]
        );


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'productname'  => 'required',
            'productprice' => 'required',
            'categoryname' => 'required',
            'foodtype'     => 'required',
            'productImage' => 'required',
            'productdesc'  => 'required',
        );
        $messages = [

        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/product')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $file = $request->file('productImage');
            // Get File Name
            $file->getClientOriginalName();
            // Get File Extension
            $fileExtension = $file->getClientOriginalExtension();
            // Get File Real Path
            $file->getRealPath();
            // Get File Size
            $file->getSize();
            // Get File Mime Type
            $file->getMimeType();
            // Rename file name
            $fileName = md5(microtime() . $file->getClientOriginalName()) . "." . $fileExtension;

            $destinationPath = base_path().'/resources/uploads/avatars/';
            $file->move($destinationPath, $fileName);

            $product= new Product();
            $product->product_name = $request['productname'];
            $product->product_price = $request['productprice'];
            $product->product_old_price = "0";
            $product->product_category_id = $request['categoryname'];
            $product->product_type = $request['foodtype'];
            $product->product_image_url = $fileName;
            $product->product_description = $request['productdesc'];
            $product->product_status= "1";

            if ($product->save())
            {
                Session::flash('message', 'Product Succesfully Added!');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/product');
            }else
            {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('admin/product');
            }
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productDelete = Product::find($id);
        $unlinkurl = $productDelete->product_image_url;
        unlink('resources/uploads/avatars/'.$unlinkurl);
        if (Product::destroy($id)) {
            Session::flash('message', 'Product Deleted !!');
            Session::flash('alert-class', 'alert-warning');
            return redirect('admin/product');
        }
    }

    public function productStatusToggle(Request $request,$id)
    {
        $user = DB::table('product')->where('id', $id)->first();

        if ($user->product_status =="1") {

            $catStatus = Product::find($id);
            $catStatus->product_status= '0';
            if ($catStatus->save()) {
                Session::flash('message', 'Status Changed');
                Session::flash('alert-class', 'alert-warning');
                return redirect('admin/product');
            }

        }else {
            $catStatus = Product::find($id);
            $catStatus->product_status= '1';
            if ($catStatus->save()) {
                Session::flash('message', 'Status Changed');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/product');
            }
        }

    }



    public function productFeaturedToggle(Request $request,$id)
    {
        $product = DB::table('product')->where('id', $id)->first();

        if ($product->featured =="1") {

            $product = Product::find($id);
            $product->featured= '0';
            if ($product->save()) {
                Session::flash('message', 'Product Removed from Featured');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/product');
            }

        }else {
            $product = Product::find($id);
            $product->featured= '1';
            if ($product->save()) {
                Session::flash('message', 'Product Featured');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/product');
            }
        }

    }
}
