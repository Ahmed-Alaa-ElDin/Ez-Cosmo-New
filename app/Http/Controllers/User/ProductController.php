<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\EditedProduct;
use App\Models\Form;
use App\Models\Indication;
use App\Models\Ingredient;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
        dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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

        return view('user.products.edit-request', compact('product', 'oldImages', 'forms', 'categories', 'brands', 'lines', 'indications', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        // dd($request->ingredient);
        // dd($product->ingredients);
        // dd($product->indications->pluck('id')->toArray() != $request->indication);

        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id . '|max:50',
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

        // check old images
        if ($request->oldImages == Null) {
            $images = [];
        } else {
            $images = explode(',', $request->oldImages);
        }

        // check new images
        if ($images == []) {
            if ($request->file('image')) {
                $images = [];
                foreach ($request->file('image') as $image) {
                    $req_image = $image;
                    $image_name = 'product-' . rand() . '.' . $req_image->getClientOriginalExtension();
                    $req_image->move(public_path('images'), $image_name);
                    array_push($images, $image_name);
                }
                $serialized_images = json_encode($images);
            } else {
                $serialized_images = Null;
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
                $serialized_images = json_encode($images);
            }
        }

        // Compare Old vs. New Product Details
        $name = $request->name == $product->name ? Null : $request->name;
        $volume = $request->volume == $product->volume ? Null : $request->volume;
        $units = $request->units == $product->units ? Null : $request->units;
        $price = $request->price == $product->price ? Null : $request->price;
        $advantage = $request->advantage == $product->advantages ? Null : $request->advantage;
        $disadvantage = $request->disadvantage == $product->disadvantages ? Null : $request->disadvantage;
        $note = $request->note == $product->notes ? Null : $request->note;
        $direction = $request->direction == $product->directions_of_use ? Null : $request->direction;
        $code = $request->code == $product->code ? Null : $request->code;
        $form = $request->form == $product->form_id ? Null : $request->form;
        $line = $request->line == $product->line_id ? Null : $request->line;
        $brand = $request->brand == $product->brand_id ? Null : $request->brand;
        $category = $request->category == $product->category_id ? Null : $request->category;

        // Create New Edited Prodct
        $newProduct = EditedProduct::create([
            'name' => $name,
            'volume' => $volume,
            'units' => $units,
            'price' => $price,
            'advantages' => $advantage,
            'disadvantages' => $disadvantage,
            'notes' => $note,
            'directions_of_use' => $direction,
            'product_photo' => $serialized_images,
            'code' => $code,
            'product_id' => $product->id,
            'form_id' => $form,
            'line_id' => $line,
            'brand_id' => $brand,
            'category_id' => $category,
            'created_by' => Auth::user()->id,
            'approved' => 0,
            'request_type' => 1
        ]);

        // Attach Ingredients
        if (isset($request->ingredient['name'])) {
            for ($i = 0; $i < count($request->ingredient['name']); $i++) {
                if ($request->ingredient['name'][$i] != Null) {
                    $ing = Ingredient::findOrFail($request->ingredient['name'][$i]);
                    $newProduct->ingredients()->attach($ing, ['concentration' => $request->ingredient['concentration'][$i], 'role' => $request->ingredient['role'][$i]]);
                }
            }
        }

        // Attach Indications
        if (isset($request->indication)) {
            for ($i = 0; $i < count($request->indication); $i++) {
                $ind = Indication::findOrFail($request->indication[$i]);
                $newProduct->indications()->attach($ind);
            }
        }


        if (session('old_route')) {
            $old_route = session('old_route');
            session()->forget('old_route');
        } else {
            $old_route = route('home');
        }

        return redirect($old_route)->with('success', "'$product->name' Update Request will be Reviewed Soon");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $newProduct = EditedProduct::create([
            'product_id' => $product->id,
            'created_by' => Auth::user()->id,
            'approved' => 0,
            'request_type' => '2'
        ]);

        return redirect()->back()->with('success', "'$product->name' Delete Request will be Reviewed Soon");;
    }


    public function showlines(Request $request, Brand $brand)
    {
        $lines = $brand->lines;

        return $lines;
    }

    public function addAjaxIngredient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:ingredients|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        } else {
            Ingredient::create([
                'name' =>  $request->name,
            ]);
            return response()->json(['success' => "'$request->name' Inserted Successfully"]);
        }
    }

    public function getAjaxIngredient()
    {
        $Ingredients = Ingredient::all();

        return response()->json(['Ingredients' => $Ingredients]);
    }
}
