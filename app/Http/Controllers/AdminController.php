<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('success', 'User successfully deleted');
    }
}