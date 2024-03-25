<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\view;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //

    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info'
        );

        return redirect('/login')->with($notification);
    }

    public function AdminLogin(){

    return view('admin.admin_login');

    }

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));


    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){

            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/').$data->photo);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;

        }

        $data->save();

        $notification = array(

            'message' => 'Admin Profile Update Succesfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request){
        $abc = $request->old_password;
        
        $request->validate([

            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);
        
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            // Debugging statements
            //dd('Hash does not match:', $request->old_password, Auth::user()->password);
        
            // Set an error notification and redirect back
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([

            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(

            'message' => 'Password Change Succefully',
            'alert-type' => 'success'

        );

        return back()->with($notification);

    }

    /* -------------------------------Become Instructor Methods------------------------------------------------------ */

    public function BecomeInstructor(){
        return view('frontend.instructor.reg_instructor');
    }

    public function InstructorRegister(Request  $request){

        $request->validate([

            'name'         => ['required','string','max:255'],
            'email'        => ['required','string','unique:users'],
            'new_password' => 'required|confirmed' ,

        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->new_password),
            'role' => 'instructor',
            'status' => '0',
        ]);

        $notification = array(

            'message' => 'Instructor Registered Succefully',
            'alert-type' => 'success'

        );

        return redirect()->route('instructor.login')->with($notification);


    }

    /* -------------------------------Become Instructor Methods------------------------------------------------------ */


    /* -------------------------------Manage Instructor Methods------------------------------------------------------ */

    public function AllInstructor(){

        $allInstructor = User::where('role','instructor')->latest()->get();
        
        // Return a view named 'all_category' in the 'admin.backend.category' namespace,
        // and pass the retrieved categories as data to the view using the 'compact' helper function.
        return view('admin.backend.instructor.show_all_instructor', compact('allInstructor'));

    }

    public function UpdateUserStatus(Request $request)
    {
        // Retrieve user_id and is_checked values from the request
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);
    
        // Find the user in the database based on the user_id
        $user = User::find($userId);
    
        // Check if the user exists
        if ($user) {
            // Update the user's status based on the is_checked value
            $user->status = $isChecked;
            
            // Save the changes to the database
            $user->save();
        }

        $instructor = User::find($userId);

        switch($isChecked){
            case 1 :
                $isChecked = 'Active';
                break;
            
            case 0 :
                $isChecked = 'Inactive';
                break;
        }

    
        // Return a JSON response indicating success
        return response()->json(['message' => "Change $instructor->name's Status to  $isChecked " ]);
    }

    /* -------------------------------Manage Instructor Methods------------------------------------------------------ */

    /* -------------------------------Manage Courses Methods------------------------------------------------------ */

    public function AdminAllCourse(){

        $course = Course::latest()->get();
        return view('admin.backend.courses.all_course',compact('course'));

    }

    public function UpdateCourseStatus(Request $request){

        $courseId = $request->input('course_id');
        $isChecked = $request->input('is_checked',0);

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Course Status Updated Successfully']);

    }

    public function AdminCourseDetails($id){

        $course = Course::find($id);
        return view('admin.backend.courses.course_details',compact('course'));

    }

    /* -------------------------------Manage Courses Methods------------------------------------------------------ */

    
     /* -------------------------------Manage Admin------------------------------------------------------ */

    public function AllAdmin(){

        $alladmin = User::where('role','admin')->get();
        return view('admin.backend.pages.admin.all_admin',compact('alladmin'));

    }

    public function AddAdmin(){

        $roles = Role::all();
        return view('admin.backend.pages.admin.add_admin',compact('roles'));

    }// End Method

    public function StoreAdmin(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = '1';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification); 

    }

    public function EditAdmin($id){

        $user = User::find($id);
        $roles = Role::all();
        return view('admin.backend.pages.admin.edit_admin',compact('user','roles'));

    }// End Method

    public function UpdateAdmin(Request $request,$id){

        $user = User::find($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        $user->role = 'admin';
        $user->status = '1';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification); 

    }

    public function DeleteAdmin($id){

        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }

    /* -------------------------------Manage Admin------------------------------------------------------ */

}
