<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $categories = Category::get();

        session(['old_route' => route('admin.categories.index')]);
        
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name' => 'required|unique:categories|max:50',
        ]);
        
        Category::create([
            'name' =>  $request->name,
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.categories.index');

        session()->forget('old_route'); 
        
        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        session(['old_route' => route('admin.categories.show', $category->id)]);

        return view('admin.categories.showProducts',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,'. $category->id .'|max:50',
        ]);

        $category->update([
            'name' =>  $request->name
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.categories.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.categories.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$category->name' Deleted Successfully");
    }
    
}
