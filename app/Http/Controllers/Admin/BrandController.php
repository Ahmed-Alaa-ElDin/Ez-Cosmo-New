<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Line;
use App\Models\Country;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get();

        session(['old_route' => route('admin.brands.index')]);

        return view('admin.brands.index' , compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('admin.brands.create', compact('countries'));
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
            'name' => 'required|unique:brands|max:50',
        ]);
        $brand = Brand::create([
            'name' =>  $request->name,
            'country_id' => $request->country
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.brands.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$brand->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lines = Line::where('brand_id',$id)->get();
        $brand = Brand::find($id);

        session(['old_route' => route('admin.brands.show', $id)]);
        
        return view('admin.brands.show' , compact('lines','brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        $countries = Country::get();

        return view('admin.brands.edit',compact('brand','countries'));
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

        $request->validate([
            'name' => 'required|unique:brands,name,'. $id .'|max:50',
        ]);

        Brand::find($id)->update([
            'name' =>  $request->name,
            'country_id' => $request->country
        ]);
        
        $old_route = session('old_route') ? session('old_route') : route('admin.brands.index');

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
        $brand = Brand::find($id);
        $brand->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.brands.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$brand->name' Deleted Successfully");
    }
}
