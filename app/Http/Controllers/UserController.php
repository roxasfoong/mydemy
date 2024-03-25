<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function Index(){

        return view('frontend.index');

    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profit',compact('profileData'));

    }

    public function UserUpdateProfile(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){

            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/').$data->photo);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;

        }

        $data->save();

        $notification = array(

            'message' => 'User Profile Update Succesfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }

    public function UserLogout(Request $request)
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

    public function UserChangePassword(){
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.change_password',compact('profileData'));
    }

    public function UserUpdatePassword(Request $request){
               
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

    public function LiveChat(){ 
        return view('frontend.dashboard.live_chat'); 
    } // End Method 

    public function LiveNodeChat(){
        $currentUser = auth()->user();
        return view('frontend.dashboard.live_node_chat',compact('currentUser')); 
    }

}
