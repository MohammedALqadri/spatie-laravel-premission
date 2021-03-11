<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('cms.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_name'=>'required|unique:categories,category_name',
            'status' => 'required|in:on,off'

        ]);
        $category = new Category();
        $category->category_name = $request->get('category_name');
        $category->status = $request->get('status') == "on" ? "Visible" : "Hidden";
        $isSaved = $category->save();
        if ($isSaved) {
            session()->flash('status', true);
            session()->flash('message', 'Category Created Successfully');
        } else {
            session()->flash('status', false);
            session()->flash('message', 'Failed to create category!s');
        }
        return redirect()->route('cms.category.index');

    }
    public function ajaxStore(Request $request)
    {
        //


        $category = new Category();
        $category->category_name = $request->categoryname;
        $category->status = $request->status == "on" ? "Visible" : "Hidden";
        $isSaved = $category->save();
        if ($isSaved) {
            session()->flash('status', true);
            session()->flash('message', 'Category Created Successfully');
        } else {
            session()->flash('status', false);
            session()->flash('message', 'Failed to create category!s');
        }
        return response()->json($category);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('cms.category.edit', ['category' => $category]);
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
        //
        $request->request->add(['id',$id]);
        $request->validate([
            'category_name'=>'required',
            'status' => 'in:on,off'

        ]);
        $category =Category::find($id);
        $category->category_name = $request->get('category_name');
        $category->status = $request->get('status') == "on" ? "Visible" : "Hidden";
        $isSaved = $category->save();
        if ($isSaved) {
            session()->flash('status', true);
            session()->flash('message', 'Category Created Successfully');
        } else {
            session()->flash('status', false);
            session()->flash('message', 'Failed to create category!s');
        }
        return redirect()->route('cms.category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Category::destroy($id);

        if ($isDeleted) {
            return redirect()->route('cms.category.index');
        }
    }
}
