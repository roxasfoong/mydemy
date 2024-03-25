<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_Goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Illuminate\Http\Request;
use App\Http\Controllers\view;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PDO;

class CourseLectures extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $course_id = 0;
        $section_id = 0;
        $lectureSection = 0;
        $trackCourseId = [];

        $courseSections = CourseSection::all();

        foreach($courseSections as $courseSection)
        {
            $course_id = $courseSection->course_id;
            array_push($trackCourseId, $course_id);
            $section_id = $courseSection->id;
            $courseCounts = array_count_values($trackCourseId);

            foreach ($courseCounts as $course_id => $count) {
                $lectureSection = $count;
            }

            switch ($lectureSection){
                case 1:
                    $lectureTitle1 = "Installation and Setup";
                    $lectureTitle2 = "Understanding MVC Architecture";
                    $lectureTitle3 = "Routing Essentials";
                    $lectureTitle4 = "Controller Basics";
                    $lectureTitle5 = "Blade Templating";
                    $lectureTitle6 = "Working with Views";
                    $lectureTitle7 = "Introduction to Eloquent ORM";
                    $lectureTitle8 = "Database Migration and Seeding";
                    $lectureTitle9 = "Form Handling and Validation";
                    $lectureTitle10 = "Error Handling and Logging";
                    break;
                
                case 2:
                    $lectureTitle1 = "Authentication and Authorization";
                    $lectureTitle2 = "Middleware Usage and Creation";
                    $lectureTitle3 = "Advanced Routing Techniques";
                    $lectureTitle4 = "Working with Events and Listeners";
                    $lectureTitle5 = "Implementing Notifications";
                    $lectureTitle6 = "Creating and Managing Jobs";
                    $lectureTitle7 = "Optimizing Database Queries";
                    $lectureTitle8 = "Caching Strategies in Laravel";
                    $lectureTitle9 = "Testing with PHPUnit";
                    $lectureTitle10 = "Building API Endpoints";
                    break;
                
                case 3:
                    $lectureTitle1 = "Using Laravel Mix for Asset Compilation";
                    $lectureTitle2 = "Real-time Communication with WebSockets";
                    $lectureTitle3 = "Implementing Queues and Workers";
                    $lectureTitle4 = "Deploying Laravel Applications";
                    $lectureTitle5 = "Scaling Laravel Applications";
                    $lectureTitle6 = "Working with Package Development";
                    $lectureTitle7 = "Integrating Third-Party Libraries";
                    $lectureTitle8 = "Understanding Laravel's Internals";
                    $lectureTitle9 = "Exploring Laravel Nova";
                    $lectureTitle10 = "Building Robust Application Structures";
                    break;
    
                }

                DB::table('course_lectures')->insert([
                    [
                    'course_id'=>$course_id,
                    'section_id'=>$section_id,
                    'lecture_tittle'=> $lectureTitle1,
                    'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                    'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                    'created_at'=> Carbon::now()
                    ],
                    //Instructor Role
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle2,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
            
                    //User Role
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle3,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle4,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle5,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle6,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle7,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle8,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle9,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    [
                        'course_id'=>$course_id,
                        'section_id'=>$section_id,
                        'lecture_tittle'=> $lectureTitle10,
                        'url'=>'https://www.dailymotion.com/embed/video/x8i1ffw?autoplay=1',
                        'content'=>"Laravel is a powerful PHP framework that streamlines the process of building web applications. Before diving into development, you need to set up your environment to work with Laravel effectively. Here's a step-by-step guide to installing and setting up Laravel",
                        'created_at'=> Carbon::now()
                    ],
                    
                    
            
            
                    ]);
        }


        

       

        
        

    }
}
