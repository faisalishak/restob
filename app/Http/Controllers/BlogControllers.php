<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blog;
use App\Tumbnail;
use DB;
use Response;

class BlogControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        //$blogs = Blog::all(); //show all data from blog table

        // $blogs = Blog::join('tumbnail','tumbnail.id');    
       
        //$blogs = Tumbnail::join('blog_post','blog_post.id', 'tumbnail.id')->get();    //one to many
        
        $blogs = DB::table('blog_post')->paginate(3);//pagination using query

        //$blogs = Blog::paginate(5); //pagination using elloquent

	   //return Response::json($blogs); //show data to our view 
        
       return view('blog.index')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return new  view 
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create validation
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        return redirect('blog')->with('message', 'data has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        //display article in single page
        if(!$blog){
            abort(404);
        }

        return view('blog.detail')->with('blog', $blog);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        //display article in single page
        if(!$blog){
            abort(404);
        }

        return view('blog.edit')->with('blog', $blog);
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
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        return redirect('blog')->with('message', 'data has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect('blog')->with('message', 'data has been deleted');
    }
}
