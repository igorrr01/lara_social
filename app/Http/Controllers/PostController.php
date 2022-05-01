<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Post;

class PostController extends Controller
{

	public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
           'title' => 'required|min:4|max:100|',
           'description' => 'required|min:4|max:1000|',
           'photo' => 'image|max:2048',
        ]);

    	if($request->hasFile('photo')){
        	$folder = date('Y-m-d');
        	$photo = $request->file('photo')->store("images/posts/{$folder}");
        }else{
        	session()->flash('error', 'Ошибка при загрузке фото');
			return back();        
		}

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photo,
            'post_time' => time(),
        ]);

        	session()->flash('success', 'Публикация добавлена');
			return back();        
    }
    
}
