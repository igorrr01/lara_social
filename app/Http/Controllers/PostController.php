<?php
 
namespace App\Http\Controllers;
 
use App\User;
use App\Post;
use App\Like;
use App\Comment;
use ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{

	public function create()
    {
        $posts = Post::all();
        return view('post.create', compact('posts'));
    }

    public function delete ($id)
    {   
        $post = Post::find($id);
        if(Auth::user()->user_status == 5 || Auth::user()->id == $post->user_id){
            Post::destroy($id);
            Storage::delete("$post->photo");
        }
        return redirect('/')->with('success', 'Успешно');
    }

    public function deleteComment ($id)
    {   
        $comment = Comment::find($id);
        if(Auth::user()->user_status == 5 || Auth::user()->id == $comment->user_id){
            Comment::destroy($id);
        }
        return redirect()->back()->with('success', 'Успешно');
    }

    public function store(Request $request)
    {
    	$request->validate([
           'description' => 'required|min:4|max:1000|',
           'photo' => 'image|max:8000',
           'tags' => 'max:25|',

        ]);

    	if($request->hasFile('photo')){
        	$folder = date('Y-m-d');
          //  ImageOptimizer::optimize($request->file('photo'));
        	$photo = $request->file('photo')->store("images/posts/{$folder}");
        }else{
        	session()->flash('error', 'Ошибка при загрузке фото');
			return back();        
		}

        $post = Post::create([
            'user_id' => Auth::user()->id,
        //    'title' => $request->title,
            'description' => $request->description,
            'photo' => $photo,
            'post_time' => time(),
        ]);
             $input = $request->all();
             $tags = explode("#", $input['tags']);
             $post->tag($tags);


        	session()->flash('success', 'Публикация добавлена');
			return back();        
    }

    public function like ($id)
    {
    		// Поиск лайка 
    	 	$find_like = Like::where([
    	 		['user_id', '=', Auth::user()->id],
    			['post_id', '=', $id]
    		])->first();

    	 	// Удаление лайка
    		if($find_like){
				$find_like->delete();
				return back();  
			} 

			// Добавление лайка
    	    $like = Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'like_time' => time(),
        ]);

			return back();     

    }

    public function comment (Request $request)
    {
    	$request->validate([
           'comment' => 'required|min:2|max:250|',
        ]);
    	
    	$comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->id,
            'comment' => $request->comment,
            'comment_time' => time(),
        ]);

       	return back();     

    }

    public function view ($id)
    {
        $posts = Post::with('likes')->whereUserId($id)->get();
        $posts = Post::query()->with('user','likes','comments_post')->find($id);
        return view('post.view', ['posts' => $posts]);
    }

    public function wholike ($id)
    {
        $wholike = Post::query()->with('user','likes')->whereId($id)->get();
     //   dd($posts->likes);
        return view('post.wholike', ['wholike' => $wholike]);
    }
}
