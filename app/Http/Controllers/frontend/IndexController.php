<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_Goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Illuminate\Http\Request;
use App\Http\Controllers\view;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{ 
    
    public function CourseDetails($id,$slug){

        $course = Course::find($id);
        if (!$course) {
            abort(404); // Redirect to 404 page
        }
        $goals = Course_goal::where('course_id',$id)->orderBy('id','DESC')->get();

        $ins_id = $course->instructor_id; 
        $instructorCourses = Course::where('instructor_id',$ins_id)->orderBy('id','DESC')->get();

        $categories = Category::latest()->get();

        $cat_id = $course->main_category_id;
        $relatedCourses = Course::where('main_category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.course.course_details',compact('course','goals','instructorCourses','categories','relatedCourses','cat_id'));

    } 

    public function CategoryAll(){

        $courses = Course::orderBy('created_at', 'desc')->paginate(8);
        $allCourses = Course::all();
        $totalCourses = Course::count();
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('frontend.category.category_show_all',compact('courses','categories','totalCourses','allCourses'));
    }

    public function CategoryCourse($id, $slug){

        $courses = Course::where('main_category_id',$id)->where('status','1')->paginate(8);
        $allCourses = Course::all();
        $totalCourses = Course::count();
        $category = Category::where('id',$id)->first();
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('frontend.category.category_all',compact('courses','category','categories','allCourses','totalCourses'));
    }

    public function SubCategoryCourse($id, $slug){

        $courses = Course::where('subcategory_id',$id)->where('status','1')->paginate(8);
        $subcategory = SubCategory::where('id',$id)->first();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::orderBy('subcategory_name','asc')->get();
        $allCourses = Course::all();
        return view('frontend.category.subcategory_all',compact('courses','subcategory','categories','subcategories','allCourses')); 
    }
 
    public function InstructorDetails($id){

        $instructor = User::find($id);
        $courses = Course::where('instructor_id',$id)->paginate(3);
        //$courseData = Course::where('instructor_id',$id)->get();
        $instructorCourses = Course::where('instructor_id',$id)->orderBy('id','DESC')->paginate(3);
        return view('frontend.instructor.instructor_details',compact('instructor','courses','instructorCourses'));
    }

}
