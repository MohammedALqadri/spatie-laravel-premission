<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs = Blog::with(['category','admin'])->get();



        return view('cms.blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('cms.blog.create', [
            'categories' => $categories

        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id|integer',

            'title' => 'required|string|min:4|max:30',
            'short_description' => 'required|string|min:20|max:100',
            'full_description' => 'required|string|min:40',
            'image' => 'required',
            'status' => 'required|in:on,off'
        ]);

        $blogImage = $request->file('image');

        $timeNow = Carbon::now();

        $time = $timeNow->minute . '_' . $timeNow->second;
        $name = $time . '_' . $request->get('title') . '_' . $blogImage->getClientOriginalName();

        $blogImage->move('images/blogs/', $name);

        $blog = new Blog();
        $blog->title = $request->get('title');
        $blog->short_description = $request->get('short_description');
        $blog->full_description = $request->get('full_description');
        $blog->status = $request->get('status') == 'on' ? 'Visible' : 'Hidden';
        $blog->category_id = $request->get('category_id');
        $blog->admin_id = Auth::user()->id;
        $blog->visit_count= 0 ;
        $blog->blog_image = $name;
        $isSaved = $blog->save();
        if ($isSaved) {
            return redirect()->route('cms.blog.index');
        } else {

        }
    }

    /**
     * Display the specified resource.
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        $blog = Blog::find($id);
        return view('cms.blog.edit', ['blog' => $blog, 'category' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->request->add(['id' => $id]);
        $request->validate([
            'id' => 'required|exists:blogs,id|integer',
            'category_id' => 'required|exists:categories,id|integer',
            'title' => 'required|string|min:10|max:50',
            'short_description' => 'required|string|min:20|max:150',
            'full_description' => 'required|string|min:40',

            'status' => 'in:on,off'
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->get('title');
        $blog->short_description = $request->get('short_description');
        $blog->full_description = $request->get('full_description');
        $blog->status = $request->get('status') == 'on' ? 'Visible' : 'Hidden';
        $blog->category_id = $request->get('category_id');

        $isSaved = $blog->save();
        if ($isSaved) {
            return redirect()->route('cms.blog.index');
        } else {

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id)
    {
        //
        $isDeleted = Blog::destroy($id);
        if ($isDeleted) {
            return redirect()->route('cms.blog.index');
        } else {

        }
    }


}
