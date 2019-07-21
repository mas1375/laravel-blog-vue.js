<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\Post as PostResources;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);

        return PostResources::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->isMethod('put') ? Post::findOrFail($request->post_id) : new Post;

        $post = $request->except('cover_image');

        if($request->hasFile('cover_image')){

            //Get fiel name  with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get just file name
            $filename = pathinfo($fileNameWithExt , PATHINFO_FILENAME);

            //get just the ext
            $ext = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            $path = $request->file('cover_image')->storeAs('public/cover_images' , $fileNameToStore);

            $post->cover_image = $fileNameToStore;
         }else{
            $fileNameToStore = 'noimage.jpg';
         }

        if($post->save()){
            return new PostResources($post);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        return  new PostResources($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->delete()){
            return new PostResources($post);
        }
    }
}
