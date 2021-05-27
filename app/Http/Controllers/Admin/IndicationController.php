<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\Indications\IndicationsExport;
use App\Exports\Admin\Indications\IndicationsProductsExport;
use App\Http\Controllers\Controller;
use App\Models\Indication;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indications = Indication::get();

        session(['old_route' => route('admin.indications.index')]);

        return view('admin.indications.index', compact('indications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.indications.create');
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
            'name' => 'required|unique:indications|max:50',
        ]);
        Indication::create([
            'name' =>  $request->name,
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.indications.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Indication $indication)
    {
        // session(['old_route' => route('ingredients.show.products', $ingredient->id)]);

        return view('admin.indications.show', compact('indication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indication  $indication
     * @return \Illuminate\Http\Response
     */
    public function edit(Indication $indication)
    {
        return view('admin.indications.edit', compact('indication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indication  $indication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indication $indication)
    {
        $validated = $request->validate([
            'name' => 'required|unique:indications,name,' . $indication->id . '|max:50',
        ]);

        $indication->update([
            'name' =>  $request->name
        ]);

        $old_route = session('old_route') ? session('old_route') : route('admin.indications.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indication  $indication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indication $indication)
    {
        $indication->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.indications.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$indication->name' Deleted Successfully");
    }

    // Export Excel File
    public function exportExcel()
    {
        return Excel::download(new IndicationsExport, 'Indications.xlsx');
    }

    // Export PDF File
    public function exportPDF()
    {
        return Excel::download(new IndicationsExport, 'Indications.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    // Export Excel File Product
    public function exportProductExcel($form)
    {
        return Excel::download(new IndicationsProductsExport($form), 'Products.xlsx');
    }

    // Export PDF File Product
    public function exportProductPDF($form)
    {
        return Excel::download(new IndicationsProductsExport($form), 'Products.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
