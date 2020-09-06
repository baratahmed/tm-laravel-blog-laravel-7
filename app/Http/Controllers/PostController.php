<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use Session;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function index()
    {
         //$posts =  DB::select('SELECT * FROM posts');   
        //$posts = Post::all();
        //$posts = Post::orderBy('id','desc')->get();
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('posts.index',[
            'posts' => $posts,
        ]);
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
       $this->validate($request,[
           'title' => 'required',
           'body' => 'required',
           'cover_image' => 'image|nullable|max:1999',
       ]);

       //Handle File Upload
       if ($request->hasFile('cover_image')) {
           //Get filename with Extension
           $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
           //Get just filename
           $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
           //Get just ext
           $extention = $request->file('cover_image')->getClientOriginalExtension();
           //Filename to store
           $fileNameToStore = $filename.'_'.time().'.'.$extention;
           //Upload Image
           return $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

       } else {
           $fileNameToStore = 'noimage.jpg'; 
       }
       

       $post  = new Post();
       $post->title = $request->title;
       $post->body = $request->body;

       //$post->user_id = auth()->user()->id;       
       $post->user_id = Auth::id();
       $post->cover_image = $fileNameToStore;
       $post->save();
       Session::flash('success','Post Added Successfully');
       return redirect('/posts');        
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

         return view('posts.show', [
             'post' => $post,
         ]);
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

        if(auth()->user()->id !== $post->user_id){
            Session::flash('error', 'Unauthorized Page');
            return redirect()->route('posts.index');

        }

        return view('posts.edit',[
            'post' => $post,
        ]);
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
        //return 'Done';
        
       $this->validate($request,[
        'title' => 'required',
        'body' => 'required',
    ]);

        //Handle File Upload
        if ($request->hasFile('cover_image')) {
            //Get filename with Extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
 
        }

    $post  = Post::find($id);
    $post->title = $request->title;
    $post->body = $request->body;
    //$post->user_id = auth()->user()->id;       
    //$post->user_id = Auth::id();
    if ($request->hasFile('cover_image')) {
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->cover_image = $fileNameToStore;
    }
    $post->save();
    Session::flash('success','Post Updated Successfully');
    return redirect('/posts');     
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
        
        if(auth()->user()->id !== $post->user_id){
            Session::flash('error', 'Unauthorized Page');
            return redirect()->route('posts.index');
        }
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        Session::flash('success','Post Deleted Successfully');
        return redirect('/posts');  

    }
}
