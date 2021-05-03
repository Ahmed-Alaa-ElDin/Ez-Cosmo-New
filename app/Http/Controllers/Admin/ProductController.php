<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Form;
use App\Models\Indication;
use App\Models\Ingredient;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        session(['old_route' => route('admin.products.index')]);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forms = Form::get();
        $brands = Brand::get();
        $categories = Category::get();
        $indications = Indication::get();
        $ingredients = Ingredient::get();

        return view('admin.products.create', compact('forms', 'categories', 'brands', 'indications', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate Product's Data
        $request->validate([
            'name' => 'required|unique:products|max:50',
            'brand' => 'required',
            'category' => 'required',
            'form' => 'required',
            'volume' => 'required|numeric|min:0',
            'units' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'image.*' => 'image',
            '*.concentration' => 'max:50',
            '*.role' => 'max:255',
        ], [
            'image.*.image' => 'Images should have jpg, jpeg or png'
        ]);

        // Save Image
        if ($request->image) {
            $images = [];
            foreach ($request->file('image') as $image) {
                $req_image = $image;
                $image_name = rand() . '.' . $req_image->getClientOriginalExtension();
                $req_image->move(public_path('images'), $image_name);
                array_push($images, $image_name);
            }
            $serialized_images = json_encode($images);

        } else {
            $serialized_images = '["default_product.png"]';
        }

        // Save Product
        $product = Product::create([
            'name' =>  $request->name,
            'volume' =>  $request->volume,
            'units' =>  $request->units,
            'price' =>  $request->price,
            'advantages' =>  $request->advantage,
            'disadvantages' =>  $request->disadvantage,
            'notes' =>  $request->note,
            'directions_of_use' =>  $request->direction,
            'code' =>  $request->code,
            'brand_id' =>  $request->brand,
            'form_id' =>  $request->form,
            'line_id' =>  $request->line,
            'category_id' =>  $request->category,
            'product_photo' => $serialized_images
        ]);

        // Attach Ingredients
        if (isset($request->ingredient['name'])) {
            for ($i = 0; $i < count($request->ingredient['name']); $i++) {
                $ing = Ingredient::find($request->ingredient['name'][$i]);
                $product->ingredients()->attach($ing, ['concentration' => $request->ingredient['concentration'][$i], 'role' => $request->ingredient['role'][$i]]);
            }
        }

        // Attach Indications
        if (isset($request->indication)) {
            for ($i = 0; $i < count($request->indication); $i++) {
                $ind = Indication::find($request->indication[$i]);
                $product->indications()->attach($ind);
            }
        }

        $old_route = session('old_route') ? session('old_route') : route('admin.products.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$request->name' Inserted Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category','brand','line','form','indications','ingredients','reviews')->find($id);

        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $oldImages = json_decode($product->product_photo);
        $forms = Form::get();
        $brands = Brand::get();
        $lines = Line::where('brand_id', $product->brand_id)->get();
        $categories = Category::get();
        $indications = Indication::get();
        $ingredients = Ingredient::get();

        return view('admin.products.edit', compact('product', 'oldImages', 'forms', 'categories', 'brands', 'lines', 'indications', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|unique:products,name,'. $product->id .'|max:50',
            'brand' => 'required',
            'category' => 'required',
            'form' => 'required',
            'volume' => 'required|numeric|min:0',
            'units' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'image.*' => 'image',
            '*.concentration' => 'max:50',
            '*.role' => 'max:255',
        ], [
            'image.*.image' => 'Images should have jpg, jpeg or png'
        ]);

        // Save New Images

        $images = [];

        $oldImages = json_decode($product->product_photo);

        if ($oldImages != ["default_product.png"]) {

            $images = $oldImages;

            if ($request->file('image')) {

                foreach ($request->file('image') as $image) {
                    $req_image = $image;
                    $image_name = rand() . '.' . $req_image->getClientOriginalExtension();
                    $req_image->move(public_path('images'), $image_name);
                    array_push($images, $image_name);
                }
                $serialized_images = json_encode($images);

            } else {

                $serialized_images = json_encode($images);
            
            } 

        } else {

            if ($request->file('image')) {

                foreach ($request->file('image') as $image) {
                    $req_image = $image;
                    $image_name = 'product-' . rand() . '.' . $req_image->getClientOriginalExtension();
                    $req_image->move(public_path('images'), $image_name);
                    array_push($images, $image_name);
                }
                $serialized_images = json_encode($images);

            } else {

                $serialized_images = '["default_product.png"]';
            
            } 

        }

        $product->update([
            'name' =>  $request->name,
            'volume' =>  $request->volume,
            'units' =>  $request->units,
            'price' =>  $request->price,
            'advantages' =>  $request->advantage,
            'disadvantages' =>  $request->disadvantage,
            'notes' =>  $request->note,
            'directions_of_use' =>  $request->direction,
            'code' =>  $request->code,
            'brand_id' =>  $request->brand,
            'form_id' =>  $request->form,
            'line_id' =>  $request->line,
            'category_id' =>  $request->category,
            'product_photo' => $serialized_images
        ]);

        // Attach Ingredients
        $product->ingredients()->detach();
        if (isset($request->ingredient['name'])) {
            for ($i = 0; $i < count($request->ingredient['name']); $i++) {
                $ing = Ingredient::find($request->ingredient['name'][$i]);
                $product->ingredients()->attach($ing, ['concentration' => $request->ingredient['concentration'][$i], 'role' => $request->ingredient['role'][$i]]);
            }
        }

        // Attach Indications
        $product->indications()->detach();
        if (isset($request->indication)) {
            for ($i = 0; $i < count($request->indication); $i++) {
                $ind = Indication::find($request->indication[$i]);
                $product->indications()->attach($ind);
            }
        }

        $old_route = session('old_route') ? session('old_route') : route('admin.products.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$request->name' Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $old_route = session('old_route') ? session('old_route') : route('admin.products.index');

        session()->forget('old_route'); 

        return redirect($old_route)->with('success', "'$product->name' Deleted Successfully");
    }

    public function showlines(Request $request, Brand $brand)
    {
        $lines = $brand->lines;

        return $lines;
    }

    public function removeOldImg(Product $product, Request $request)
    {
        $product->update([
            'product_photo' =>  '["default_product.png"]'
        ]);

        return response()->json([
            'success' => "Old Images Removed Successfully",
        ]);
    }
}
