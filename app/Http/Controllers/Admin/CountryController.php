<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();

        session(['old_route' => route('admin.countries.index')]);

        return view('admin.countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
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
            'name' => 'required|unique:countries|max:50',
        ]);
        $country = Country::create([
            'name' =>  $request->name,
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.countries.index');

        session()->forget('old_route');
        
        return redirect($old_route)->with('success', "'$country->name' Inserted Successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|unique:countries,name,'. $country->id .'|max:50',
        ]);

        $country->update([
            'name' =>  $request->name
        ]);
        
        $old_route = session('old_route') ? session('old_route') : route('admin.countries.index');

        session()->forget('old_route');
        
        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.countries.index');

        session()->forget('old_route');
        
        return redirect($old_route)->with('success', "'$country->name' Deleted Successfully");
    }

    public function showUsers(Request $request,Country $country)
    {
        session(['old_route' => route('admin.countries.show.users', $country->id)]);

        return view('admin.countries.showUsers', compact('country'));
    }

    public function showProducts(Request $request,Country $country)
    {
        session(['old_route' => route('admin.countries.show.products', $country->id)]);

        return view('admin.countries.showProducts', compact('country'));
    }

    public function showBrands(Request $request,Country $country)
    {
        session(['old_route' => route('admin.countries.show.brands', $country->id)]);

        return view('admin.countries.showBrands', compact('country'));
    }
}
