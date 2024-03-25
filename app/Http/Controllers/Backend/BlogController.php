<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function AllBlogCategory(){

        $category = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category',compact('category'));
    
    }

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);
        $notification = array(
            'message' => 'BlogCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }

    public function UpdateBlogCategory(Request $request){
        $cat_id = $request->cat_id;
    
        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);
    
        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    
    
       }// End Method 
    
       public function DeleteBlogCategory($id){
    
        BlogCategory::find($id)->delete();
    
        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AddBlogPost(){

        $blogcat = BlogCategory::latest()->get();
        return view('admin.backend.post.add_post',compact('blogcat'));
    
    }

    public function BlogPost(){
        $post = BlogPost::latest()->get();
        return view('admin.backend.post.all_post',compact('post'));
       }

    public function StoreBlogPost(Request $request){

        $manager = new ImageManager(Driver::class);

        $image = $manager->read($request->file('post_image'));
        $imgExtension = $request->file('post_image');
    
        $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
        $image->resize(370,246);
        $image->save(public_path('upload/post/') . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,  
            'created_at' => Carbon::now(),      
    
        ]);
    
        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);  
    
    }

    public function EditBlogPost($id){

        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::find($id);
        return view('admin.backend.post.edit_post',compact('post','blogcat'));
    
       }
    
    
       public function UpdateBlogPost(Request $request){
    
        $post_id = $request->id;
    
        if ($request->file('post_image')) {
    
            $manager = new ImageManager(Driver::class);

            $image = $manager->read($request->file('post_image'));
            $imgExtension = $request->file('post_image');
        
            $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
            $image->resize(370,246);
            $image->save(public_path('upload/post/') . $name_gen);
            $save_url = 'upload/post/' . $name_gen;
    
            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,  
                'created_at' => Carbon::now(),      
    
            ]);
    
            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post')->with($notification);  
    
        } else {
    
            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags, 
                'created_at' => Carbon::now(),      
    
            ]);
    
            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post')->with($notification);  
    
        } // end else 
    
    }

    public function DeleteBlogPost($id){
        $item = BlogPost::find($id);
        $img = $item->post_image;
        unlink($img);
    
        BlogPost::find($id)->delete();
    
            $notification = array(
                'message' => 'Blog Post Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }
    
    public function BlogDetails($slug){

        $blog = BlogPost::where('post_slug',$slug)->first();
        $tags = $blog->post_tags;
        $tags_all = explode(',',$tags);
        $bcategory = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(6)->get();
        return view('frontend.blog.blog_details',compact('blog','tags_all','bcategory','post'));
    
    }

    public function BlogCatList($id){

        $blog = BlogPost::where('blogcat_id',$id)->paginate(8);
        $blogCatPage = BlogPost::where('blogcat_id',$id)->paginate(8);
        $totalBlogCatPage = BlogPost::where('blogcat_id',$id)->count();
        $breadcat = BlogCategory::where('id',$id)->first();
        $bcategory = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(6)->get();
        return view('frontend.blog.blog_cat_list',compact('blog','breadcat','bcategory','post','totalBlogCatPage','blogCatPage'));
    
    }

    public function BlogList(){

        /* $blog = BlogPost::latest()->get(); */
        $blog = BlogPost::latest()->paginate(8);
        $bcategory = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(6)->get();
        return view('frontend.blog.blog_list',compact('blog','bcategory','post'));
    
    
    }

    public function BlogTagList($tag){
        $blog = BlogPost::where('post_tags', 'LIKE', "%$tag%")->paginate(8);
        $totalBlogCatPage = BlogPost::where('post_tags', 'LIKE', "%$tag%")->count();
        $blogCatPage = BlogPost::where('post_tags', 'LIKE', "%$tag%")->paginate(8);
        $bcategory = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(6)->get();
        return view('frontend.blog.blog_tag_list',compact('blog','bcategory','post','totalBlogCatPage','tag','blogCatPage'));
    }

}
