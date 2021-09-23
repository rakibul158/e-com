<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        Session::put('page','categories');
        $categories = Category::get();
        return view('admin.category.index')
            ->with('categories',$categories);
    }

    public function updateCategoryStatus(Request $request)
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
            Category::where('id',$data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function addEditCategory(Request $request, $id=null)
    {
        if($id == '')
        {
            $title = "Add Category";
            $category = new Category;
        } else{
            $title = "Edit Category";
        }
        if($request->isMethod('POST'))
        {
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
            ];
            $customMessage = [
                'category_name.required' => 'Category Name is required.',
                'category_name.regex' => 'Valid Name is required.',
                'section_id.required' => 'Sections is required.',
                'url.required' => 'Category Url is required.'
            ];
            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/admin/category_image/' . $imageName;
                    Image::make($image_tmp)->resize(400, 400)->save($imagePath);
                    $category->category_image = $imageName;
                }
            }

            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            if(empty($data['meta_title']))
            {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description']))
            {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keyword']))
            {
                $data['meta_keyword'] = "";
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keyword = $data['meta_keyword'];
            $category->status = 1;
            $category->save();
            Session::flash('success_message','Category Added Successfully!');
            return redirect()->route('category.index');
        }

        $sections = Sections::where('status',1)->get();
        return view('admin.category.add_edit')
            ->with('title',$title)
            ->with('sections',$sections);
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $categories = Category::with('subCategories')->where(['section_id'=> $data['section_id'],'parent_id'=>0, 'status'=>1])->get();
            $categories = json_decode(json_encode($categories),true);
           // echo "<pre>"; print_r($categories); die;

            return view('admin.category.append_category_level')
                ->with('categories',$categories);

        }
    }
}
