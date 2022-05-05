<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Post;
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
            'avatar' => $avatar ?? null, //$avatar ? $avatar : null
        ]);

        session()->flash('success', 'Successfull registration');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm()
    {
        return view('login');
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
         if($auser->avatar){
             $vd = Storage::delete("$auser->avatar");
         }

         $auser->avatar = $avatar;
         $auser->save();

         return redirect()->back()->with('success', 'Аватарка успешно загружена!');   
    }

    public function show ($id){

        $posts = Post::query()->with('user','likes','comments')->where('user_id', '=', $id)->orderBy('id', 'desc')->get();
        $post_count = count($posts);
        $user = User::find($id);

         $followers = User::query()->with('followers','followings')->where('id', '=', $id)->withCount('followers')->get();
         $followings = User::query()->with('followers','followings')->where('id', '=', $id)->withCount('followings')->get();
         
         foreach ($followers as $foll) {
           // dd($foll->followers_count);
         }
        return view('profile.page', [
            "user" => $user,
            "posts" => $posts,
            "post_count" => $post_count,
            "followers" => $followers,
            "followings" => $followings,
        ]);
    }

    public function followUser(int $profileId)
    {
    $user = User::find($profileId);
    if(!$user) {
        return redirect()->back()->with('error', 'Ошибка!'); 
    }

    $user->followers()->attach(auth()->user()->id);
     return redirect()->back()->with('success', 'Вы успешно подписались');
    }

    public function unFollowUser(int $profileId)
    {
    $user = User::find($profileId);
    if(! $user) {
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

}