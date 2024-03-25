<?php
 
namespace App\Http\Controllers\Backend;

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

class CourseController extends Controller
{
    public function ShowInstructorCourse()
    {
        // Get the authenticated user's ID
        $id = Auth::user()->id;
    
        // Retrieve courses where the instructor_id matches the authenticated user's ID
        // Order the courses by ID in descending order
        $courses = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();
    
        // Return a view with the retrieved courses
        return view('instructor.course.instructor_course', compact('courses'));
        
    }

    public function AddCourse(){

        $category = Category::latest()->get();
        return view('instructor.course.add_course', compact('category'));

    }

    public function GetSubCategory($category_id){

        $subCategory = SubCategory::where('main_category_id',$category_id)->orderBy('subcategory_name','ASC')->get();

        return json_encode($subCategory);
        
    }

    public function StoreCourse(Request $request){

        /*$request->validate([

            'video' => 'required|mimes:mp4|max:10000',
        ]); */

          $course_name_slug = urlencode($request->course_name);
          $course_name_slug = strtolower(str_replace('+','-',$course_name_slug));
            

            $manager = new ImageManager(Driver::class);

            $image = $manager->read($request->file('course_image'));
            $imgExtension = $request->file('course_image');
        
            $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
            $image->resize(370,246);
            $image->save(public_path('upload/course/thumbnail/') . $name_gen);
            $save_url = 'upload/course/thumbnail/' . $name_gen;

            $video = $request->file('video');
            $videoName = time(). '.' . $video->getClientOriginalExtension();
            $video->move(public_path('upload/course/video/') , $videoName);
            $save_video = 'upload/course/video/' . $videoName;

        
            if ($request->has('highestrated')) {
                // The checkbox is checked
                $highestratedValue = $request->has('highestrated');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $highestratedValue = 0;
            } 
            
            if ($request->has('bestseller')) {
                // The checkbox is checked
                $bestsellerValue = $request->has('bestseller');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $bestsellerValue = 0;
            }   

            if ($request->has('featured')) {
                // The checkbox is checked
                $featuredValue = $request->has('featured');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $featuredValue = 0;
            }   


        $courese_id = Course::insertGetID([

            'main_category_id' => $request->main_category_id,                                    
            'subcategory_id'   => $request->input('subcategory_id'),                                   
            'instructor_id'    => Auth::user()->id,                                    
            'course_image'     => $save_url,                                   
            'course_tittle'    => $request->course_tittle,                                     
            'course_name'      => $request->course_name,                                     
            'course_name_slug' => $course_name_slug,                                  
                                              
            'description'      => $request->description,                                   
            'video'            => $save_video,                                    
            'level'            => $request->level,                                     
            'duration'         => $request->duration,                                     
            'resources'        => $request->resources,                                     
            'certificate'      => $request->certificate,                                     
                                              
            'selling_price'    => $request->selling_price,                                    
            'discount_price'   => $request->discount_price,                                    
            'prerequisites'    => $request->prerequisites,                                       
            'bestseller'       => $bestsellerValue,                                     
            'featured'         => $featuredValue,                                 
            'highestrated'     => $highestratedValue,       
                                          
            'status'           => 1,       
            'created_at'       => Carbon::now(),                                           
            
        ]);

        $goal = Count($request->course_goals);
        if($goal != NULL){

            for($i=0; $i<$goal-1; $i++){

                $course_goal = new Course_Goal();
                $course_goal->course_id =  $courese_id;
                $course_goal->goal_name = $request->course_goals[$i];
                $course_goal->save();

            }

        }


        $notification = array(
    
            'message' => 'New Course Added Sucessfully',
            'alert-type' => 'success'

        );

        return redirect()->route('show.instructor.course')->with($notification);

    }

    public function EditCourse($id){

       

            $course = Course::find($id);
            $course_goal = Course_goal::where('course_id',$id)->latest()->get();
            $category = Category::latest()->get();
            $Subcategory = SubCategory::latest()->get();
            
            return view('instructor.course.edit_course',compact('course','category','Subcategory','course_goal'));
    
    }

    public function UpdateCourse(Request $request){
        $course_name_slug = urlencode($request->course_name);
        $course_name_slug = strtolower(str_replace('+','-',$course_name_slug));
        /*        $request->validate([

            'video' => 'required|mimes:mp4|max:10000',
        ]);
        */
            $save_url = $this->checkEmptyImage($request);
            $save_video = $this->checkEmptyVideo($request);
            

            $cid = $request->id;

            if($save_url != '0'){
                if(file_exists($request->course_image)){
                    unlink($request->course_image);
                }
                Course::find($cid)->update([
                    'course_image'     => $save_url,
                ]);
            }

            if($save_video != '0'){
                Course::find($cid)->update([
                    'video'            => $save_video,
                ]);
            }

            $this->deleteGoal($request);
            $this->updateGoal($request);

            if ($request->has('highestrated')) {
                // The checkbox is checked
                $highestratedValue = $request->has('highestrated');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $highestratedValue = 0;
            } 
            
            if ($request->has('bestseller')) {
                // The checkbox is checked
                $bestsellerValue = $request->has('bestseller');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $bestsellerValue = 0;
            }   

            if ($request->has('featured')) {
                // The checkbox is checked
                $featuredValue = $request->has('featured');
                // You can use or process the $highestratedValue as needed
            } else {
                // The checkbox is not checked
                $featuredValue = 0;
            }   



            Course::find($cid)->update([

            'main_category_id' => $request->main_category_id,                                    
            'subcategory_id'   => $request->input('subcategory_id'),                                   
            'instructor_id'    => Auth::user()->id,                                    
           /*  'course_image'     => $save_url, */                                   
            'course_tittle'    => $request->course_tittle,                                     
            'course_name'      => $request->course_name,                                     
            'course_name_slug' => $course_name_slug,                                  
                                              
            'description'      => $request->description,                                   
            /* 'video'            => $save_video,    */                                 
            'level'            => $request->level,                                     
            'duration'         => $request->duration,                                     
            'resources'        => $request->resources,                                     
            'certificate'      => $request->certificate,                                     
                                              
            'selling_price'    => $request->selling_price,                                    
            'discount_price'   => $request->discount_price,                                    
            'prerequisites'    => $request->prerequisites,                                       
            'bestseller'       => $bestsellerValue,                                     
            'featured'         => $featuredValue,                                 
            'highestrated'     => $highestratedValue,       
                                          
            /* 'status'           => 1, */       
            'updated_at'       => Carbon::now(),                                           
            
        ]);



       
        $notification = array(
    
            'message' => 'Course Detail Updated Sucessfully',
            'alert-type' => 'success'

        );

        return redirect()->route('show.instructor.course')->with($notification);

    }

    public function checkEmptyImage(Request $request){
        if(!empty($request->course_image)){

            $manager = new ImageManager(Driver::class);

            $image = $manager->read($request->file('course_image'));
            $imgExtension = $request->file('course_image');
        
            $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
            $image->resize(370,246);
            $image->save(public_path('upload/course/thumbnail/') . $name_gen);
           return 'upload/course/thumbnail/' . $name_gen;
        } 
        else{

            return '0';

        }
    }

    public function checkEmptyVideo($request){
        if(!empty($request->video)){

            $video = $request->file('video');
            $videoName = time(). '.' . $video->getClientOriginalExtension();
            $video->move(public_path('upload/course/video/') , $videoName);
            return 'upload/course/video/' . $videoName;
          
        } 
        else{

            return '0';

        }
    }

    public function deleteGoal($request){
        
        Course_goal::where('course_id',$request->id)->delete();

    }

    public function deleteGoalById($id){
        
        Course_goal::where('course_id',$id)->delete();

    }

    public function updateGoal($request){

        $goal = Count($request->course_goals);

        if($goal != NULL){

            for($i=0; $i<$goal-1; $i++){

                $course_goal = new Course_Goal();
                $course_goal->course_id =  $request->id;
                $course_goal->goal_name = $request->course_goals[$i];
                $course_goal->save();

            }

        }
    }

    public function DeleteCourse($id){

        $course = Course::find($id);
        unlink($course->course_image);
        unlink($course->video);

        $this->deleteGoalById($course->id);

        Course::find($id)->delete();

        $notification = array(

            'message' => 'Course Delete Sucessfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }

 
    
    /* --------------------------------Coure Section & Lecture Area------------------------------------------------------- */

    public function AddCourseLecture($id){

        $course = Course::find($id);
        $section = CourseSection::where('course_id',$course->id)->get();
        return view('instructor.course.section.show_course_section', compact('course','section'));
        
    }

    public function StoreCourseSection(Request $request){

        $course = Course::find($request->id);
        $section_title = $request->section_title;

        CourseSection::insert([

            'course_id' => $course->id,
            'section_tittle' => $section_title,
            'created_at'       => Carbon::now(),    
        ]);

        $notification = array(

            'message' => 'Course Section Added Sucessfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }

    public function SaveLecture(Request $request){

        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_tittle = $request->lecture_title;
        $lecture->url = $request->lecture_url;
        $lecture->content = $request->content;
        $lecture->save();

        return response()->json(['success' => 'Lecture Saved Successfully']);

    }

    public function EditLecture($id){

        $clecture = CourseLecture::find($id);
        return view('instructor.course.lecture.edit_course_lecture',compact('clecture'));

    }

    public function UpdateCourseLecture(Request $request){
        $lid = $request->id;

        CourseLecture::find($lid)->update([
            'lecture_tittle' => $request->lecture_title,
            'url' => $request->url,
            'content' => $request->content,

        ]);

        $notification = array(
            'message' => 'Course Lecture Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);   

    }

    public function DeleteLecture($id){

        CourseLecture::find($id)->delete();

        $notification = array(
            'message' => 'Course Lecture Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }

    public function DeleteSection($id){

        $section = CourseSection::find($id);

        /// Delete reated lectures 
        $section->lectures()->delete();
        // Delete the section 
        $section->delete();

        $notification = array(
            'message' => 'Course Section Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }

    /* --------------------------------Coure Section & Lecture Area------------------------------------------------------- */
}
