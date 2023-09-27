<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function submitForgotPassword(Request $request)
{
    $request->validate([
        'email'=>'required|email|exists:users,email'
    ]);

    $user = User::where('email', $request->email)->first();
    if ($user) {
        # code...
    
    $token = Str::random(64);
    DB::table('password_resets')->insert([
          'email'=>$request->email,
          'token'=>$token,
          'created_at'=>Carbon::now(),
    ]);
    
    $action_link = route('reset.password.form',['token'=>$token,'email'=>$request->email]);
    $body = "We are received a request to reset the password for <b>Your app Name </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

   Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
         $message->from('noreply@example.com','Your App Name');
         $message->to($request->email,'Your name')
                 ->subject('Reset Password');
   });

   return back()->with('success', 'We have e-mailed your password reset link!');
}
// else{
//     return redirect('/forgot-password')->with('error', 'Email not registered!');
// }
}

public function showResetForm(Request $request, $token = null){
    return view('reset')->with(['token'=>$token,'email'=>$request->email]);
}

public function resetPassword(Request $request){
    
    $request->validate([
        'email'=>'required|email|exists:users,email',
        'password'=>'required|min:8|confirmed',
        'password_confirmation'=>'required',
    ]);
    
    $check_token = DB::table('password_resets')->where([
        'email'=>$request->email,
        'token'=>$request->token,
    ])->first();

    if(!$check_token){
        return back()->withInput()->with('error', 'Invalid token');
        
    }else{
        
        User::where('email', $request->email)->update([
            'password'=>Hash::make($request->password)
        ]);

        DB::table('password_resets')->where([
            'email'=>$request->email
        ])->delete();

        return redirect('/login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
    }
}

    public function submitSurvey(Request $request)
    {
        $user = auth()->user();
        $user->survey_completed = true;
        $user->save();
        return redirect('/')->with('success', 'You are now logged in.');
    }

    public function login(Request $request)
    {

        $allowedUserTypes = DB::table('user_types')->pluck('user_type')->toArray();
        $incomingFields = $request->validate([
            'username_login' => 'required',
            'password_login' => 'required',
            'user_type' => Rule::in($allowedUserTypes)
        ]);
        if (auth()->attempt(['username' => $incomingFields['username_login'], 'password' => $incomingFields['password_login']])) {

            $request->session()->regenerate();
            $user = auth()->user();
            event(new Registered($user));

            if ($user->email_verified_at == true) {
                if ($user->user_type == 'alumni') {

                    if ($user->add_info_completed == true) {
                        if ($user->survey_completed == true) {
                            return redirect('/')->with('success', 'Welcome back' . auth()->user()->first_name . '!');
                        } else {
                            return redirect('/survey')->with('info', 'Please complete this survey.');
                        }
                    } else {
                        return redirect('/additional-info')->with('info', 'Please Add Your Information.');
                    }
                    # code...
                } else if ($user->user_type == 'admin') {

                    return redirect('/admin/dashboard')->with('success', "Welcome back " . ucfirst(auth()->user()->username));
                }
            } else {
                return redirect('/email/verify')->with('info', 'Please verify your email.');
            }
        } else {
            return redirect('/login')->with('error', 'failed to log in.');
        }

    }

    public function logout()
    {

        auth()->logout();
        return redirect('/');
    }
}