<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Pokemon;
use App\User;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        $currentUser = Auth::user();
        return view('home',compact(['currentUser','users']));
    }

    public function search(Request $request)
    {
        if($request->name)
        {
            $name = $request->name;
            return redirect(url('/search',$name));
        }
        else{
            return redirect(url('home'));
        }
    }


}
