<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function CreateCategory(Request $request){
        $category = Category::orderBy('name', 'ASC')->get();
        if($request->isMethod('post')){
            $data = $request->all();
            $category = new Category;
            $category->parent_id = $data['parent_cat'];
            $category->name = $data['cat_name'];
            $category->description = $data['cat_desc'];
            $category->url = $data['cat_url'];
            $category->status = $data['cat_status'];

            if($request->hasFile('inputImage')){
                $file = $request->file('inputImage');
                $basename = basename($file);
                $img_name = $basename.time().'.'.$file->getClientOriginalExtension();
                $file->move('public/images/categories/', $img_name);
                $category->image = $img_name;
            }

            $category->save();
            return redirect('/admin/create_category')->with('flash_message_success', 'Category Created Successfully!');
        }
        return view('admin.create_category')->with('category', $category);
    }

    public function viewCategories(){
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.view_categories')->with('categories', $categories);
    }

    public function editCategory(Request $req, $id = null){
        $category = Category::where(['id'=>$id])->get();
        $categories = Category::orderBy('id','ASC')->get();
        $catArray = [];
        if($categories != null){
            foreach($categories as $cat){
            $catArray[] = $cat->name;
            $catArray[] = $cat->id;
                $subcats = Category::orderBy('id','ASC')->where('parent_id', $cat->id )->get();
                if($subcats != null){
                    foreach($subcats as $subcat){
                        $catArray[] = $cat->name.">".$subcat->name;
                        $catArray[] = $subcat->id;
                    }
                }
            }
        }
        if($req->isMethod('post')){
            $data = $req->all();
            Category::where(['id'=>$id])->update(['name'=>$data['cat_name'],'description'=>$data['cat_desc'],'parent_id'=>$data['parent_cat'],'status'=>$data['cat_status'],'url'=>$data['cat_url'],]);
            /* if($req->hasFile('inputImage')){
                $prev_img = $category->image;
                $image_path = 'public/images/categories/'.$prev_img;  
                if(file_exists($image_path)) {
                    @unlink($image_path);
                }
                $file = $req->file('inputImage');
                $basename = basename($file);
                $img_name = $basename.time().'.'.$file->getClientOriginalExtension();
                $file->move('public/images/categories/', $img_name);
                $category->image = $img_name;
                
            } */
            // $category->save();
            return redirect('/admin/view_categories')->with('flash_message_success', 'Category Updated Successfully!');
        }
        return view('admin.edit_category')->with('catArray', $catArray)->with('category', $category)->with('id', $id);
    }

    public function deleteCategory($id)
    {
        $delete = Category::where('id', $id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "Category deleted successfully!";
        } else {
            $success = true;
            $message = "Category not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }


}
