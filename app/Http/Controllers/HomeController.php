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
        $time = time() - 3600*24;
        $posts = Post::query()->with('user','likes','comments')->where('post_time', '>', $time)->withCount('likes')->withCount('comments')->orderBy(\DB::raw('comments_count + likes_count'), 'desc')->paginate(10);
        //dd($posts);
        return view('index', ['posts' => $posts]);
    }

    public function news(Request $request)
    {
         // Обновление времени последнего перехода на сайте
        if(Auth::user() ){
         $user = Auth::user();
         $user->last_move = time();
         $user->save();
        }
        $posts = Post::query()->with('user','likes','comments')->orderBy('post_time', 'desc')->withCount('likes')->paginate(10);
        return view('news', ['posts' => $posts]);

    }        

    public function fnews(Request $request)
    {
         // Обновление времени последнего перехода на сайте
        if(Auth::user() ){
         $user = Auth::user();
         $user->last_move = time();
         $user->save();
        }

            $userIds = $user->followings()->pluck('leader_id');
            $userIds[] = $user->id;
            //dd($userIds);

        $posts = Post::query()->whereIn('user_id', $userIds)->with('user','likes','comments')->orderBy('post_time', 'desc')->withCount('likes')->paginate(10);
        return view('fnews', ['posts' => $posts]);

    }

    public function tags ($tag)
    {
        $posts = Post::withAnyTag($tag)->paginate(10); // eager load
        return view('tags', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }
}
