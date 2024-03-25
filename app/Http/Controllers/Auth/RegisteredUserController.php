<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.dashboard.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function RegisterUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 1,
            'created_at' => Carbon::Now(),
        ]);

        if ($user) {
            // Creation was successful
            // You can perform further actions here
            $notification = array(

                'message' => 'Register Succesfully',
                'alert-type' => 'success'
    
            );

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('index')->with($notification);

        } else {

            $notification = array(

                'message' => 'Register Failed',
                'alert-type' => 'error'
    
            );

            return back()->with($notification);
        }
    }
}
