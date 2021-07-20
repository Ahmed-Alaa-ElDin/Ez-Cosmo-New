<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditedProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class EditedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.review-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EditedProduct  $editedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(EditedProduct $editedProduct)
    {
        if ($editedProduct->approved == 0) {
            $product_name = $editedProduct->product->name;
            $editor_name = $editedProduct->editor->first_name . " " . $editedProduct->editor->last_name;
            $id = $editedProduct->id;

            return view('admin.products.review-details', compact('id', 'product_name', 'editor_name'));
        } else {
            return redirect(route('admin.edited_products.index'))->with('warning', 'This product has been reviewed by another admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EditedProduct  $editedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if ($product->approved == 0) {
            return view('admin.products.new-review-details', compact('product'));
        } else {
            return redirect(route('admin.edited_products.index'))->with('warning', 'This product has been reviewed by another admin');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EditedProduct  $editedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EditedProduct $editedProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EditedProduct  $editedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(EditedProduct $editedProduct)
    {
        //
    }
}
