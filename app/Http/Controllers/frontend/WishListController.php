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
use App\Models\WishList;

class WishListController extends Controller
{
    public function AddToWishList(Request $request, $course_id){
       
        if (Auth::check()) {
           $exists = Wishlist::where('user_id',Auth::id())->where('course_id',$course_id)->first();
           
           if (!$exists) {
            Wishlist::insert([
                'user_id' => Auth::id(),
                'course_id' => $course_id,
                'created_at' => Carbon::now(),
            ]);
            $wishQty = Wishlist::where('user_id', Auth::id())->count();
            return response()->json(['success' => 'Successfully Added on your Wishlist', 'wishQty' => $wishQty]);
           }else {
            return response()->json(['error' => 'This Product Has Already on your withlist']);
           }

        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        } 

    } 

    public function AllWishlist(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.wishlist.all_wishlist',compact('profileData'));
    }

    public function GetWishlistCourse(){

       
        $userID = Auth::user()->id;
        $wishQty = Wishlist::where('user_id', $userID)->count();
       
        // Retrieve wishlist items associated with the authenticated user
        $wishlist = Wishlist::with('course') // Eager load the 'course' relationship to avoid N+1 queries
        ->where('user_id', $userID) // Filter by the authenticated user's ID
        ->latest() // Order the wishlist items by the most recently added
        ->get(); // Retrieve the wishlist items
    
        // Return a JSON response containing the wishlist items
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

    public function RemoveWishlist($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Course Remove']);

    }
}
