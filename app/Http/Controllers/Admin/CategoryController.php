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
        $categories = Category::with(['section','parentCategory'])->get();
//        $categories = json_decode(json_encode($categories));
//        echo "<pre>"; print_r($categories); die;
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
            $submit = "Add Category";
            $category = new Category;
            $categoryData = [];
            $getCategory = [];
            $message = "Category Added Successfully!";
        } else{
            $title = "Edit Category";
            $submit = "Update";
            $categoryData = Category::where('id',$id)->first();
            $categoryData = json_decode(json_encode($categoryData),true);
           // echo "<pre>"; print_r($categoryData); die;
            $getCategory = Category::with('subCategories')->where(['parent_id'=>0, 'section_id'=>$categoryData['section_id']])->get();
            $getCategory = json_decode(json_encode($getCategory),true);
            // echo "<pre>"; print_r($getCategory); die;
            $category = Category::find($id);
            $message = "Category Updated Successfully!";
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
                    Image::make($image_tmp)->save($imagePath);
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
            Session::flash('success_message',$message);
            return redirect()->route('category.index');
        }

        $sections = Sections::where('status',1)->get();
        return view('admin.category.add_edit')
            ->with('title',$title)
            ->with('submit',$submit)
            ->with('sections',$sections)
            ->with('categoryData',$categoryData)
            ->with('getCategory',$getCategory)
            ;
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $getCategory = Category::with('subCategories')->where(['section_id'=> $data['section_id'],'parent_id'=>0, 'status'=>1])->get();
            $getCategory = json_decode(json_encode($getCategory),true);
           // echo "<pre>"; print_r($categories); die;

            return view('admin.category.append_category_level')
                ->with('getCategory',$getCategory);

        }
    }

    public function deleteCategoryImage($id)
    {
        $categoryImage = Category::select('category_image')->where('id',$id)->first();

        $category_image_path = 'images/admin/category_image/';

        if(file_exists($category_image_path.$categoryImage->category_image))
        {
            unlink($category_image_path.$categoryImage->category_image);
        }
        Category::where('id',$id)->update(['category_image' => '']);
        return redirect()->back()->with('success_message','Category Image has been deleted Successfully! ');
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Category has been deleted Successfully! ');
    }
}
