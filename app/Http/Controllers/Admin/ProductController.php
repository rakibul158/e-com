<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('page','products');
        $products = Product::with([
            'category'=> function($query){$query->select('id','category_name');},
            'section' => function($query){$query->select('id','name');}
        ])->get();
//        $products = json_decode(json_encode($products),true);
//        echo "<pre>"; print_r($products); die;

        return view('admin.product.index')
            ->with('products',$products)
            ;
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            }else {
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct ($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Product has been deleted Successfully! ');
    }

    public function addEditProduct(Request $request,$id = null)
    {
        if($id == "")
        {
            $title = "Add Product";
            $submit = "Add Product";
        }else {
            $title = "Edit Product";
            $submit = "Edit Product";
        }

        return view('admin.product.add_edit')
            ->with('title', $title)
            ->with('submit', $submit)
            ;
    }

}
