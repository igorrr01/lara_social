<?php

namespace App\Providers;

use View;
use Auth;
use App\User;
use App\Post;
use App\ChMessage;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            date_default_timezone_set('Europe/Kiev');
            // Список количества пользователей онлайн
            view()->composer('*', function ($user){
            if(Auth::user()){

            if(Auth::user()->user_status == '0'){
                echo'Вы заблокированы за нарушение правил ресурса!';exit;
            }

            $users_online = User::orderBy('last_move', 'desc')->where('last_move', '>', time()-7200)->limit(10)->get();
            // Счетчик непрочитанных сообщений
            $unread_messages = DB::table('ch_messages')->where('to_id', Auth::id())->where('seen', 0)->count();
            // Счетчик онлайна
            $users_online_count = DB::table('users')->where('last_move', '>', time()-7200)->count();
            // Последний переход по сайту
            $last_move = Auth::user()->last_move;
            // Счетчики подписчиков
            $followers_notify = DB::table('followers')->where('leader_id', Auth::id())->where('created_at', '>', Carbon::createFromTimestamp(Auth::user()->notify_time))->get();
            // Счетчик лайков
            $new_likes = Post::with(['likes' => function($query) { $query->whereUserId(Auth::id()); },
                'likes' => function($query) { 
                    $query->where('user_id', '!=', Auth::id())->where('created_at', '>', Carbon::createFromTimestamp(Auth::user()->notify_time)); }])
            ->whereUserId(Auth::id())
            ->withCount('likes')->get();

            $user_like_count = Post::with('likes')->whereUserId(Auth::id())->get()->sum(function($post) {
                return $post->likes->count();
            });

            $user_comment_count = Post::with('comments')->whereUserId(Auth::id())->get()->sum(function($post) {
                return $post->comments->count();
            });   

/*            $top_like_count = User::query()->with('likes','comments','posts')->withCount('likes')->withCount('comments')->orderBy(\DB::raw('comments_count + likes_count'), 'desc')->get()->sum(function($post) {
            return ($post->likes->count() + $post->comments->count());
            }); */


            if($user_like_count >= 1){
            $ll = 1;
            foreach ($new_likes as $dd) {
                 if($ll < 1 ) $ll = 1;
                 $ll = $dd->likes->count()+$ll;
            }
            $ll = $ll-1;
            }else{
                $ll = 0;
            }

            // Счетчик комментариев
            $new_comments = Post::with(['comments' => function($query) { $query->whereUserId(Auth::id()); },
                'comments' => function($query) { 
                    $query->where('user_id', '!=', Auth::id())->where('created_at', '>', Carbon::createFromTimestamp(Auth::user()->notify_time)); }])
            ->whereUserId(Auth::id())
            ->withCount('comments')->get();

            $user_comments_count = Post::with('comments')->whereUserId(Auth::id())->get()->sum(function($post) {
                return $post->comments->count();
            });   

            if($user_comments_count >= 1){
            $llc = 1;
            foreach ($new_comments as $dd) {
                 if($llc < 1 ) $llc = 1;
                 $llc = $dd->comments->count()+$llc;
            }
            $llc = $llc-1;
            }else{
                $llc = 0;
            }

            //Общий счетчик
            $followers_count = count($followers_notify);

            $notify_count = count($followers_notify);
            $notify_count = $notify_count + $ll + $llc;

            $all_user_count = $user_like_count + $user_comment_count;
            //dd($all_user_count);
            $user->with([
                'users_online' => $users_online,
                'unread_messages' => $unread_messages,
                'users_online_count' => $users_online_count,
                'notify_count' => $notify_count,
                'followers_count' => $followers_count,
                'like_count' => $ll,
                'comment_count' => $llc,
                'all_user_count' => $all_user_count,
            ]);
        }
    });

    }
}
