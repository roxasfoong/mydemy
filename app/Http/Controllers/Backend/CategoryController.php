<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\view;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;


class CategoryController extends Controller
{
    /* -------------------------------Main Category Methods------------------------------------------------- */
    public function AllCategory(){
        // Retrieve all categories from the database, ordered by the latest (newest first)
        $category = Category::latest()->get();
    
        // Return a view named 'all_category' in the 'admin.backend.category' namespace,
        // and pass the retrieved categories as data to the view using the 'compact' helper function.
        return view('admin.backend.category.all_category', compact('category'));
    }

    public function AddCategory(){
        return view('admin.backend.category.add_category');
    }

    public function StoreCategory(Request $request){

        $manager = new ImageManager(Driver::class);

        $image = $manager->read($request->file('image'));
        $imgExtension = $request->file('image');
    
        $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
        $image->resize(370,246);
        $image->save(public_path('upload/category/') . $name_gen);
        $save_url = 'upload/category/' . $name_gen;

        Category::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            'image' => $save_url,

        ]);

        $notification = array(

            'message' => 'New Category Added Sucessfully',
            'alert-type' => 'success'

        );

        return redirect()->route('all.category')->with($notification);

    }

    public function EditCategory($id){

        $category = Category::find($id);
        return view('admin.backend.category.edit_category',compact('category'));

    }

    public function UpdateCategory(Request $request){
        
        $cat_id = $request->id;

        if($request->file('image')){

        $manager = new ImageManager(Driver::class);

        $image = $manager->read($request->file('image'));
        $imgExtension = $request->file('image');
    
        $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
        $image->resize(370,246);
        $image->save(public_path('upload/category/') . $name_gen);
        $save_url = 'upload/category/' . $name_gen;

        Category::find($cat_id)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            'image' => $save_url,

        ]);
        $notification = array(

            'message' => 'Category Update with Image Sucessfully',
            'alert-type' => 'success'

        );

        }else{
        Category::find($cat_id)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            

        ]);

        $notification = array(

            'message' => 'Category Name Update Sucessfully',
            'alert-type' => 'success'

        );

        }

        return redirect()->route('all.category')->with($notification);

    }

    public function DeleteCategory($id){

        $category = Category::find($id);
        $image = $category->image;
        unlink($image);

        SubCategory::where('main_category_id', '=', $category->id)->delete();
        Category::find($id)->delete();
        $notification = array(

            'message' => 'Category Delete Sucessfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }

        /* -------------------------------Main Category Methods------------------------------------------------- */

        /* -------------------------------Sub Category Methods------------------------------------------------- */

        public function AllSubCategory(){
            // Retrieve all categories from the database, ordered by the latest (newest first)
            $subcategory = SubCategory::latest()->get();
        
            // Return a view named 'all_category' in the 'admin.backend.category' namespace,
            // and pass the retrieved categories as data to the view using the 'compact' helper function.
            return view('admin.backend.subcategory.all_subcategory', compact('subcategory'));
        }

        public function AddSubCategory(){
            $category = Category::latest()->get();
            return view('admin.backend.subcategory.add_subcategory',compact('category'));
        }

        public function StoreSubCategory(Request $request){

              SubCategory::insert([
                'main_category_id' => $request->main_category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
                    
            ]);
    
            $notification = array(
    
                'message' => 'New Subcategory Added Sucessfully',
                'alert-type' => 'success'
    
            );
    
            return redirect()->route('all.subcategory')->with($notification);

        }

        public function DeleteSubCategory($id){

            $subCategory = SubCategory::find($id);
           
            SubCategory::find($subCategory->id)->delete();
            $notification = array(
    
                'message' => 'Category Delete Sucessfully',
                'alert-type' => 'success'
    
            );
            return redirect()->back()->with($notification);
        }

}
