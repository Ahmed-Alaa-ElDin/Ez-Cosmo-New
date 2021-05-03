<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::get();
        
        session(['old_route' => route('admin.ingredients.index')]);

        return view('admin.ingredients.index',compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredients.create');
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
            'name' => 'required|unique:ingredients|max:50',
        ]);
        Ingredient::create([
            'name' =>  $request->name,
        ]);
        
        $old_route = session('old_route') ? session('old_route') : route('admin.ingredients.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        // session(['old_route' => route('ingredients.show.products', $ingredient->id)]);

        return view('admin.ingredients.show', compact('ingredient'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|unique:ingredients,name,'. $ingredient->id .'|max:50',
        ]);

        $ingredient->update([
            'name' =>  $request->name
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.ingredients.index');

        session()->forget('old_route');
        
        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->back()->with('success', "'$ingredient->name' Deleted Successfully");
    }

    public function addAjaxIngredient(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:ingredients|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        } else {
            Ingredient::create([
                'name' =>  $request->name,
            ]);
            return response()->json(['success'=>"'$request->name' Inserted Successfully"]);
        }
    }

    public function getAjaxIngredient()
    {
        $Ingredients = Ingredient::all();

        return response()->json(['Ingredients'=>$Ingredients]);
    }
}
