<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\Eloquent\Model;

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
     	$posts = Post::query()->with('user','likes','comments')->orderBy('post_time', 'desc')->withCount('likes')->paginate(10);
    	return view('index', ['posts' => $posts]);

    }
}
