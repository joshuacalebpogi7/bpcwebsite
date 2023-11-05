<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\CoursesImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //
    public function importCourses(Request $request) 
    {   
        $file = $request->file('excel_file');

        $this->validate($request, [
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new CoursesImport, $file);
            return redirect('/admin/courses')->with('success', 'All good!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect('/admin/courses')->with('error', 'Failed to import file!');
        }

    }
    public function import(Request $request) 
    {   
        $file = $request->file('excel_file');

        $this->validate($request, [
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new UsersImport, $file);
            return redirect('/admin/users')->with('success', 'All good!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect('/admin/users')->with('error', 'Failed to import file!');
        }

    }
    public function deleteUser(User $user)
    {
        $userAlumniDeleted = $user->where('user_type', 'alumni')->delete();
        $userDeleted = $user->delete();
        if ($userAlumniDeleted) {
            return redirect('/admin/users')->with('success', 'User successfully deleted!');
        }
        elseif($userDeleted){
            return redirect('/admin/admins')->with('success', 'User successfully deleted!');
        }
        else{
            return redirect('/admin/users')->with('error', 'User deletion failed!');
        }
        
    }
}