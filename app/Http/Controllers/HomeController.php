<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {

        $user  = Auth::user()->usertype;
 
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                return view('user.index');
            } elseif ($usertype == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }

    // public function user_dashboard(){
         
    //      return view('user.index');
    //  }
}
