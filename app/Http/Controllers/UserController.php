<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|min:4|max:25|',
            'email' => 'required|email|unique:users|min:4|max:50|',
            'password' => 'required|confirmed|min:6|max:50|',
            'avatar' => 'nullable|image',
        ]);

        if($request->hasFile('avatar')){
            $folder = date('Y-m-d');
        $avatar = $request->file('avatar')->store("images/{$folder}");
         }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' =>'user.png',
        ]);

        session()->flash('success', 'Successfull registration');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm()
    {
        $time = time() - 3600*24;
        $posts = Post::query()->with('user','likes','comments')->where('post_time', '>', $time)->withCount('likes')->withCount('comments')->orderBy(\DB::raw('comments_count + likes_count'), 'desc')->paginate(10);
        return view('login', ['posts' => $posts]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->home();
        }

        return redirect()->back()->with('error', 'Неверный email или пароль!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function avatar()
    {
        return view('profile.avatar');
    }

    public function avatarUpload(Request $request)
    {
        // Валидация фото
        $request->validate([
            'avatar' => 'image|max:2048',
        ]);

        // Сохранение фото в папку на сервере
        if($request->hasFile('avatar')){
            $folder = date('Y-m-d');
         $avatar = $request->file('avatar')->store("images/avatars/{$folder}");
        }

        // Удаление предыдущего фото с сервере
         $auser = Auth::user();
         if($auser->avatar != 'user.png'){
            if($auser->avatar){
             $vd = Storage::delete("$auser->avatar");
            }            
         }

         $auser->avatar = $avatar;
         $auser->save();
         return redirect()->back()->with('success', 'Аватарка успешно загружена!');   
    }

    public function show ($id){

        $posts = Post::query()->with('user','likes','comments')->where('user_id', '=', $id)->withCount('likes')->orderBy('id', 'desc')->get();
        $post_count = count($posts);
        $user = User::find($id);

        $followers = User::query()->with('followers','followings')->where('id', '=', $id)->withCount('followers')->get();
        $followings = User::query()->with('followers','followings')->where('id', '=', $id)->withCount('followings')->get();

        $check = DB::table('followers')->where('follower_id', Auth::id())->where('leader_id', $id)->count();

        $user_like_count = Post::with('likes')->where('user_id', '=', $id)->get()->sum(function($post) {
                return $post->likes->count();
            });

        $user_comments_count = Post::with('comments')->where('user_id', '=', $id)->get()->sum(function($post) {
                return $post->comments->count();
            });

        
            $top_like_count2 = User::query()->with('likes','comments','posts.likes')->withCount('likes')->withCount('comments')->withCount('posts')->orderBy('likes_count', 'desc')->get();

            $c = 1;

            foreach ($top_like_count2 as $aa) {

               foreach ($aa->posts as $aab) {
                   $cc = $aab->likes->count(); 
                   $c = $c + $cc ; 
               }
                $c = $c;
             }

            $b = 1;
            foreach ($top_like_count2 as $bb) {

               foreach ($bb->posts as $bbb) {
                   $bb = $bbb->comments->count(); 
                   $b = $b + $bb ;            
               }

                $b = $b;
             }

             $c = $c+$b;

        $user_all_count = $user_like_count + $user_comments_count;

         $user = User::find($id);
         $user->rating = round($user_all_count*100/$c, 1);
         $user->save();

       // dd($user_all_count);
        return view('profile.page', [
            "user" => $user,
            "posts" => $posts,
            "post_count" => $post_count,
            "followers" => $followers,
            "followings" => $followings,
            "user_like_count" => $user_like_count,
            "user_all_count" => $user_all_count,
            "top_like_count" => $c,
            "check" => $check,
        ]);
    }

    public function followUser(int $profileId)
    { 
    $user = User::find($profileId);
    $check = DB::table('followers')->where('follower_id', Auth::id())->where('leader_id', $profileId)->count();
    if(!$user || $profileId == Auth::id() || $check >= 1) {
        return redirect()->back()->with('error', 'Ошибка!'); 
    }

    $user->followers()->attach(auth()->user()->id);
     return redirect()->back()->with('success', 'Вы успешно подписались');
    }

    public function unFollowUser(int $profileId)
    {
    $user = User::find($profileId);
    if(!$user || $profileId == Auth::id()) {
        return redirect()->back()->with('error', 'Ошибка'); 
    }

    $user->followers()->detach(auth()->user()->id);
        return redirect()->back()->with('success', 'Вы успешно отписались!');
    }

    public function followings(int $userId)
    {
    $user = User::find($userId);
    $followers = $user->followers;
    $followings = $user->followings;
        return view('profile.followings', compact('user', 'followers' , 'followings'));
    }

    public function followers(int $userId)
    {
    $user = User::find($userId);
    $followers = $user->followers;
    $followings = $user->followings;
        return view('profile.followers', compact('user', 'followers' , 'followings'));
    }

    public function onlinelist ()
    {
        return view('onlinelist');
    }  

    public function userslist ()
    {

    $users = User::query()->orderBy('rating', 'desc')->limit(100)->get(); 


 //dd($users);

           /* $users_rat2 = User::query()->with('likes','comments','posts')->withCount('likes')->withCount('comments')->orderBy(\DB::raw('comments_count + likes_count'), 'desc')->get()->count('likes_count'); 

            $users_rat = User::query()->with('likes','comments','posts')->withCount('likes')->withCount('comments')->orderBy(\DB::raw('comments_count + likes_count'), 'desc')->limit(100)->get();*/

        //   dd($users_rat2);
        return view('userslist', compact('users'));
    }

    public function notify ()
    {
        $user = Auth::user();
        $user->notify_time = time();
        $user->save();
        $foll = User::query()->with('followers')->where('id', '=', Auth::id())->get();
        $like = Post::query()->with('user','likes','comments')->where('user_id', '=', Auth::id())->orderBy('id', 'desc')->get();
        return view('notify', [
            "foll" => $foll,
            "like" => $like,
        ]);
    }

    public function settings ()
    {
        return view('profile.settings');
    }

      public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Ваш текущий пароль не совпадает с паролем, который вы предоставили. Пожалуйста, попробуйте еще раз.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Новый пароль не может совпадать с вашим текущим паролем. Выберите другой пароль.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Пароль успешно изменен !");

    }


        public function changeAbout(Request $request){

        $validatedData = $request->validate([
            'firstname' => 'required|string|min:4|max:20',
            'lastname' => 'required|string|min:4|max:20',
            'about' => 'nullable|string|min:4|max:200',
        ]);

         $chuser = Auth::user();
         $chuser->firstname = $request->firstname;
         $chuser->lastname = $request->lastname;
         $chuser->about = $request->about;
         $chuser->save();

        return redirect()->back()->with("success","Данные изменены!");

    }

    public function search(Request $request)
    {
        $user = User::where('name', $request->get('name'))->first();
        if(!$user){
            return redirect()->back()->with('error', 'Пользователь не найден!'); 
        }
        return redirect()->route('show_user', $user->id);
    }

    public function block ($id)
    {
        if(Auth::user()->user_status == 5){
         $block = User::find($id);
         $block->user_status = '0';
         $block->save();
        }
        return redirect()->back()->with('success', 'Успешно');
    }

    public function blocked ()
    {
        return view('layouts.blocked');
    }

}