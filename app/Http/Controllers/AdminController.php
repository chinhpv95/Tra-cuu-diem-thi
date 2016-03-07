<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	if (Auth::check()){
    		return view('admin');
    	}
    }

    public function addUser(Request $request){
    	$data = $request->all();
    	$user = new User;
            $user['name'] = $data['username'];
            $user['email'] = $data['email'];
            $user['password'] = bcrypt($data['password']);
            $user['isAdmin'] = $data['role'];
           
         $user->save();
        return redirect()->route('admin');

    }
}
