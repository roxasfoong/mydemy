<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Cache; 
use Carbon\Carbon;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (Auth::check()) {
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
         }
   

        // Get the role of the authenticated user from the request
        $userRole = $request->user()->role;
        $instructorStatus = $request->user()->status;
    
        // Check if the user role is 'user' and the requested role is not 'user'
        if ($userRole === 'user' && $role !== 'user') {
            // If so, redirect the user to the general dashboard
            return redirect('dashboard');
        } 
        // Check if the user role is 'admin' and the requested role is 'user'
        elseif ($userRole === 'admin' && $role === 'user') {
            // If so, redirect the admin to the admin dashboard
            return redirect('/admin/dashboard');
        } 
        // Check if the user role is 'instructor' and the requested role is 'user'
        elseif ($userRole === 'instructor' && $role === 'user') {
            // If so, redirect the instructor to the instructor dashboard
            return redirect('/instructor/dashboard');
        }
        // Check if the user role is 'admin' and the requested role is 'instructor'
        elseif ($userRole === 'admin' && $role === 'instructor') {
            // If so, redirect the admin to the admin dashboard
            return redirect('/admin/dashboard');
        } 
        // Check if the user role is 'instructor' and the requested role is 'admin'
        elseif ($userRole === 'instructor' && $role === 'admin') {
            // If so, redirect the instructor to the instructor dashboard
            return redirect('/instructor/dashboard');
        }elseif($userRole === 'instructor' && $instructorStatus == '0' ){
            $notification = array(
                'message' => 'Your instructor status is still inactive',
                'alert-type' => 'error',
            );
            return redirect('/')->with($notification);
        }
    
        // If none of the above conditions are met, allow the request to proceed
        return $next($request);
    }
}
