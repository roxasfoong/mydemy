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

class CourseSections extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach($courses as $course)
        {
            DB::table('course_sections')->insert([
                [
                'course_id'=>$course->id,
                'section_tittle'=>'Section 1: Foundations of Laravel 10',
                'created_at'=> Carbon::now()
                ],
                [
                'course_id'=>$course->id,
                'section_tittle'=>'Section 2: Intermediate Laravel Concepts',
                'created_at'=> Carbon::now()
                ],
                [
                'course_id'=>$course->id,
                'section_tittle'=>'Section 3: Advanced Laravel Techniques',
                'created_at'=> Carbon::now()
                ],

            ]);
        }

    }
}
