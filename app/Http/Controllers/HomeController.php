<?php

namespace App\Http\Controllers;


use User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	 // Обновление времени последнего перехода на сайте
 		if(Auth::user() ){
    	 $user = Auth::user();
         $user->last_move = time();
         $user->save();
     	}
    	return view('index');

    }
}
