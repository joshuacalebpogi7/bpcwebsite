<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function deleteUser(User $user)
    {
        $userDeleted = $user->delete();
        if (!$userDeleted) {
            return redirect('/admin/users')->with('error', 'User deletion failed!');
        }
        return redirect('/admin/users')->with('success', 'User successfully deleted!');
    }
}