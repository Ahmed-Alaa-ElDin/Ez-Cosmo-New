<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::get();
        
        session(['old_route' => route('admin.forms.index')]);

        return view('admin.forms.index',compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.forms.create');
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
            'name' => 'required|unique:forms|max:50',
        ]);

        Form::create([
            'name' =>  $request->name,
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.forms.index');

        session()->forget('old_route');
        
        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        // session(['old_route' => route('ingredients.show.products', $ingredient->id)]);

        return view('admin.forms.show', compact('form'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        return view('admin.forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|unique:forms,name,'. $form->id .'|max:50',
        ]);

        $form->update([
            'name' =>  $request->name
        ]);
        
        $old_route = session('old_route') ? session('old_route') : route('admin.forms.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        $form->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.forms.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$form->name' Deleted Successfully");
}
}
