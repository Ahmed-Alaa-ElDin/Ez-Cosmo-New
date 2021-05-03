<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Brand;
use App\Models\Product;


class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lines = line::get();

        session(['old_route' => route('admin.lines.index')]);

        return view('admin.lines.index' , compact('lines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();

        return view('admin.lines.create', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSpecificBrand($brand_id)
    {
        $brands = Brand::get();

        return view('admin.lines.create', compact('brands','brand_id'));
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
            'name' => 'required|unique:lines|max:50',
            'brand' => 'required',
        ],[
            'name.required' => 'Please Enter The Line Name',
            'name.unique' => $request->name . ' is Already Present',
            'name.max' => 'Line Name Must Be Less Than 50 Character',
            'brand.required' => 'Please Choose The Line\'s Brand',
        ]);

        Line::create([
            'name' =>  $request->name,
            'brand_id' =>  $request->brand
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.lines.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $line= Line::find($id);

        return view('admin.lines.show', compact('line'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $line = Line::find($id);
        
        $brands = Brand::get();

        return view('admin.lines.edit', compact('line' , 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $brand = 'all')
    {
        $request->validate([
            'name' => 'required|unique:lines,name,'. $id .'|max:50',
            'brand' => 'required',
        ],[
            'name.required' => 'Please Enter The Line Name',
            'name.unique' => $request->name . ' is Already Present',
            'name.max' => 'Line Name Must Be Less Than 50 Character',
            'brand.required' => 'Please Choose The Line\'s Brand',
        ]);

        Line::find($id)->update([
            'name' =>  $request->name,
            'brand_id' =>  $request->brand
        ]);
        
        $old_route = session('old_route') ? session('old_route') : route('admin.lines.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $line = Line::find($id);
        
        $line->delete();

        return redirect()->back()->with('success', "'$line->name' Deleted Successfully");
    }
}
