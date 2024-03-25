<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;
use Intervention\Image\Facades\Image;
use App\Models\SiteSetting;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{

    /* ---------SMTP Setting----------- */
    public function SmtpSetting(){

        $smpt = SmtpSetting::find(1);
        return view('admin.backend.setting.smpt_update',compact('smpt'));

    }// End Method 

    public function SmtpUpdate(Request $request){

        $smtp_id = $request->id;

        
         // Check if SMTP settings exist
    $smtpSetting = SmtpSetting::find($smtp_id);
    if (!$smtpSetting) {
        // If SMTP settings do not exist, create them
        SmtpSetting::create([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);
    } else {
        // If SMTP settings exist, update them
        $smtpSetting->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);
    }
    
        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }

    /* ---------SMTP Setting----------- */

    /* ----------------------Site Setting ---------------------- */

    public function SiteSetting(){

        $site = SiteSetting::find(1);
        return view('admin.backend.site.site_update',compact('site'));

    }

    public function UpdateSite(Request $request){

        $site_id = $request->id;

        if ($request->file('logo')) {

            $manager = new ImageManager(Driver::class);

            $image = $manager->read($request->file('logo'));
            $imgExtension = $request->file('logo');
        
            $name_gen = hexdec(uniqid()). '.' . $imgExtension->getClientOriginalExtension();
            $image->resize(120,60);
            $image->save(public_path('upload/logo/') . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;


            $siteSettingsCount = SiteSetting::count();


    if ($siteSettingsCount > 0) {
        SiteSetting::find($site_id)->update([
            'phone' => $request->phone, 
            'email' => $request->email, 
            'address' => $request->address, 
            'facebook' => $request->facebook, 
            'twitter' => $request->twitter, 
            'copyright' => $request->copyright,  
            'logo' => $save_url,        

        ]);
    } else {
        SiteSetting::firstOrCreate(['id' => $site_id], [
            'phone' => $request->phone, 
            'email' => $request->email, 
            'address' => $request->address, 
            'facebook' => $request->facebook, 
            'twitter' => $request->twitter, 
            'copyright' => $request->copyright,  
            'logo' => $save_url
            ]);
    }


            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);  

        } else {

            SiteSetting::find($site_id)->update([
                'phone' => $request->phone, 
                'email' => $request->email, 
                'address' => $request->address, 
                'facebook' => $request->facebook, 
                'twitter' => $request->twitter, 
                'copyright' => $request->copyright,  

            ]);

            $notification = array(
                'message' => 'Site Setting Updated without image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);  

        } // end else 

    }

    /* ----------------------Site Setting ---------------------- */


}
