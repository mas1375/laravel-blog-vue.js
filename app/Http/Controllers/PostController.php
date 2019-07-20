<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['index' , 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::select('select * from posts');

        //eloquent
        $posts = Post::orderBy('created_at' , 'desc')->paginate(10);
        return view('posts/index')->with('posts' , $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:5000'
        ]);
            //handel fiel upload
        if($request->hasFile('cover_image')){

            //Get fiel name  with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name

            $filename = pathinfo($fileNameWithExt , PATHINFO_FILENAME);

            //get just the ext

            $ext = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            $path = $request->file('cover_image')->storeAs('public/cover_images' , $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        //create posts
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success' , 'post created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with('post' , $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error' , 'Unauthorized Page !!');
        }

        return view('posts.edit')->with('post' , $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'title' => 'required',
            'body' => 'required'
        ]);
        if($request->hasFile('cover_image')){

            //Get fiel name  with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name

            $filename = pathinfo($fileNameWithExt , PATHINFO_FILENAME);

            //get just the ext

            $ext = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            $path = $request->file('cover_image')->storeAs('public/cover_images' , $fileNameToStore);

        }



        //create posts
        $data = [];
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success' , 'post edited successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);

       if(auth()->user()->id !== $post->user_id) {
        return redirect('/posts')->with('error' , 'Unauthorized Page !!');
        }

        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images'.$post->cover_image);
        }

       $post->delete();
       return redirect('/posts')->with('error' , 'Post ' . $post->title . ' is Removed !!');
    }
}
