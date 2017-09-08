<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function login(){
    	if(Auth::attempt(['username'=> $_POST['user'],'password'=> $_POST['password']])){
    		
    		return redirect('/dashboard');
    	}
    }
}

