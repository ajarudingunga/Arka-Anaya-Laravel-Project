<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\productCategory;
use App\Product;
use Validator;
use Input;
use Session;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $product = DB::table('product')
            ->where('product_category_id', '=', $id)
            ->where('product_status', '=', 1)
            ->paginate(4);

        return view('user.categoryvise',
           [
               'products' => $product,
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

    protected function validator(array $data)
    {

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
            'categoryname' => 'required',
            'categorydesc' => 'required',
        );
        $messages = [
            'categoryname.required' => 'Category Name Required',
            'categorydesc.required' => 'Description Required',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/categories')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $category= new productCategory();
            $category->category_name = $request['categoryname'];
            $category->category_desc = $request['categorydesc'];
            $category->category_active_status= "1";

            if ($category->save())
            {
                Session::flash('message', 'Succesfully Added!');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/categories');
            }else
            {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('admin/categories');
            }
        }
    }
     public function categoryStatusToggle(Request $request,$id)
     {
         $user = DB::table('product_category')->where('id', $id)->first();


         if ($user->category_active_status =="1") {

             $catStatus = productCategory::find($id);
             $catStatus->category_active_status= '0';
             if ($catStatus->save()) {
                 Session::flash('message', 'Status Changed to Disabled');
                 Session::flash('alert-class', 'alert-warning');
                 return redirect('admin/categories');
             }

         }else {

             $catStatus = productCategory::find($id);
             $catStatus->category_active_status= '1';
             if ($catStatus->save()) {
                 Session::flash('message', 'Status Changed to Enable');
                 Session::flash('alert-class', 'alert-success');
                 return redirect('admin/categories');
             }
         }

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function updateShow($id)
    {
        $updateCategory = productCategory::find($id);
        return view('admin.updateCategory',
           [
               '$id' => $id,
           ])->with('updateData', $updateCategory);

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
        $rules = array(
            'categoryname' => 'required',
            'categorydesc' => 'required',
        );
        $messages = [
            'categoryname.required' => 'Category Name Required',
            'categorydesc.required' => 'Description Required',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else
        {
             $catUpdate = productCategory::find($id);
             $catUpdate->category_name = $request['categoryname'];
             $catUpdate->category_desc = $request['categorydesc'];
             if ($catUpdate->save()) {
                 Session::flash('message', 'Data updated');
                 Session::flash('alert-class', 'alert-success');
                 return redirect('admin/categories');
             }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (productCategory::destroy($id)) {
            Session::flash('message', 'Category Deleted !!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/categories');
        }
    }
}
