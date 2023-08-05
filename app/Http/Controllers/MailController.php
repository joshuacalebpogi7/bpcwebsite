<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    //
    public function sendAccDetails(User $user)
    {
        $data = [
            "title" => "Your college alumni account details",
            "body" => "username: " . $user->username . "password: " . $user->password
        ];
        // MailNotify class that is extend from Mailable class.
        try {
            Mail::to($user->email)->send(new MailNotify($data));
            return response()->json(['Great! Successfully send in your mail']);
        } catch (Exception $e) {
            return response()->json(['Sorry! Please try again latter']);
        }
    }
}