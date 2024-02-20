<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(5);
            return view('blog.index',compact('blogs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
            return view('blog.create')
        ->with('brands',$brands);
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
                'name' => 'required|max:20',
                'company_id' => 'required|integer',
                'price' => 'required|integer',
                'stock' => 'required|integer',
                'comment' => 'required|max:140',
                'img_path' => 'required',
                ]);
            // ディレクトリ名
            $dir = 'img_paths';
            // imageディレクトリに画像を保存
            $path = $request->file('img_path')->store('public/' . $dir);
     
            $blog = new Blog;
                $blog->name = $request->input(["name"]);
                $blog->company_id = $request->input(["company_id"]);
                $blog->price = $request->input(["price"]);
                $blog->stock = $request->input(["stock"]);
                $blog->comment = $request->input(["comment"]);
                $blog->img_path = $path;

                $blog->save();

            return redirect()->route('blogs.index')
            ->with('success','登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
