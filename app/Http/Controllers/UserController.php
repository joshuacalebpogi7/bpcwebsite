<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function submitForgotPassword(User $user, Request $request)
    {
        $incomingFields = $request->validate([
            'forgot_email' => ['email', 'required']
        ]);
        if (auth()->attempt(['email' => $incomingFields['forgot_email']])) {

        } else {
            return redirect('/login')->with('error', 'failed to log in.');
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