@extends('layouts.master')

@section('style')
    {{-- Slick --}}
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick-theme.css') }}">

    <style>
        * {
            box-sizing: border-box 
        }

        .slick-dots {
            bottom: auto;
        }

        *:focus {
            outline: 0 !important;
        }

        .slick-arrow::after,
        .slick-arrow::before {
            color: black
        }

        .slick-slide {
        max-height:150px!important;
        }

        .slick-slide img {
        max-height:150px!important;
        }

        .slick-dots li {
            margin: 0!important;
            width: 15px!important;
        }

        #DetailsModal .row {
            margin-left: 0;
            margin-right: 0;
        }

        .select2-selection__rendered {
            margin-top: 0 !important;
        }

        .select2-selection--multiple {
            border: 1px solid rgba(209, 213, 219) !important;
        }

        .select2-search__field {
            padding-left: 6px !important;
        }

        .select2-selection__choice {
            background-color: #007bff !important;
            border-radius: 15px !important;
            padding: 0 8px !important;
            box-shadow: : 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            border: 1px ​solid #fff !important;
        }

        .select2-selection__choice__remove {
            color: beige !important;
            margin-right: 5px !important;
        }

    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product
            <small>Update</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">

                        {{-- Brand --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="brand" class="min-w-max mr-3 my-auto font-bold">Brand</label>
                                <select name="brand"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('brand') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5 singleSelect"
                                    id="brand" required>
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @if (old('brand',$product->brand_id) == $brand->id) selected @endif>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lines --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="line" class="min-w-max mr-3 my-auto font-bold">Line</label>
                                <select name="line"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 rounded w-75 pr-5 singleSelect"
                                    id="line">
                                    <option value="">Choose Line</option>
                                    @foreach ($lines as $line)
                                        <option value="{{ $line->id }}" @if (old('line',$product->line_id) == $line->id) selected @endif>{{ $line->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="category" class="min-w-max mr-3 my-auto font-bold">Category</label>
                                <select name="category"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('category') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5 singleSelect"
                                    required>
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category',$product->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-lg-5 form-group my-2">
                            <div class="flex justify-center">
                                <label for="name" class="min-w-max mr-3 my-auto font-bold">Name</label>
                                <input type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('name') border-red-300 @else border-gray-300 @enderror rounded w-80"
                                    name="name" value="{{ old('name',$product->name) }}" placeholder="Enter Product Name" required
                                    maxlength="50">
                            </div>
                            @error('name')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dosage Form --}}
                        <div class="col-lg-3 form-group my-2">
                            <div class="flex justify-center">
                                <label for="form" class="min-w-max mr-3 my-auto font-bold">Form</label>
                                <select name="form"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('form') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5 singleSelect"
                                    required>
                                    <option value="">Choose Pharmaceutical Form</option>
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->id }}" @if (old('form',$product->form_id) == $form->id) selected @endif>
                                            {{ $form->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Volume --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="input-group">
                                <label for="validationTooltipUsername" class="min-w-max mr-3 my-auto font-bold">Volume |
                                    Weight</label>
                                <input type="number" step="any" name="volume"
                                    class="form-control w-25 text-center focus:border-blue-200 focus:ring-blue-200 @error('volume') border-red-300 @else border-gray-300 @enderror"
                                    style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"
                                    value="{{ old('volume',$product->volume) }}" required min="0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;"
                                        id="validationTooltipUsernamePrepend">Ml. | Gm.</span>
                                </div>
                            </div>
                            @error('volume')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Units --}}
                        <div class="col-lg-2 form-group my-2">
                            <div class="flex justify-center">
                                <label for="units" class="min-w-max mr-3 my-auto font-bold">Units</label>
                                <input type="number" step="any"
                                    class="form-control text-center focus:border-blue-200 focus:ring-blue-200 @error('units') border-red-300 @else border-gray-300 @enderror rounded w-75"
                                    name="units" value="{{ old('units', $product->units) }}" required min="1">
                            </div>
                            @error('units')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="offset-lg-1 col-lg-3 form-group my-2">
                            <div class="input-group">
                                <label for="validationTooltipUsername"
                                    class="min-w-max mr-3 my-auto font-bold">Price</label>
                                <input type="number" step="any" name="price"
                                    class="form-control w-25 text-center focus:border-blue-200 focus:ring-blue-200 @error('price') border-red-300 @else border-gray-300 @enderror"
                                    style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"
                                    value="{{ old('price', $product->price) }}" required min="0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;"
                                        id="validationTooltipUsernamePrepend">EGP</span>
                                </div>
                            </div>
                            @error('price')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Code --}}
                        <div class="offset-lg-1 col-lg-5 form-group my-2">
                            <div class="flex justify-center">
                                <label for="code" class="min-w-max mr-3 my-auto font-bold">Code</label>
                                <input type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('code') border-red-300 @else border-gray-300 @enderror rounded w-80"
                                    name="code" value="{{ old('code', $product->code) }}" placeholder="Enter Product Code">
                            </div>
                            @error('code')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ingredient --}}
                        <div class="col-lg-12 my-2">
                            <div class="bg-gray-100 rounded border-2 px-3 py-3 border-gray-400">
                                <label class="text-center mb-3 font-bold w-100 font-bold">Ingredients</label>
                                <div id="ingredientsList">

                                    @if ($errors->any())
                                        @for ($i = 0; $i < count(old('ingredient')['name']); $i++)
                                            <div class="row singleIngredient">
                                                <div class="col-lg-3">
                                                    <div class="flex">
                                                        <select name="ingredient[name][]"
                                                            class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded pr-5` ingredientNameSelect">
                                                            <option value="">Choose Ingredient</option>
                                                            @foreach ($ingredients as $ingredient)
                                                                <option value="{{ $ingredient->id }}" @if ($ingredient->id == old('ingredient')['name'][$i]) selected @endif>
                                                                    {{ $ingredient->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input type="text"
                                                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                                                        name="ingredient[concentration][]" placeholder="Concentration"
                                                        value="{{ old('ingredient')['concentration'][$i] }}"
                                                        maxlength="50">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input type="text"
                                                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                                                        name="ingredient[role][]" placeholder="Role"
                                                        value="{{ old('ingredient')['role'][$i] }}" maxlength="255">
                                                </div>
                                                <div class="col-lg-1 form-group flex content-evenly">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm my-auto font-bold removeIngredient">&times;</button>
                                                </div>
                                            </div>
                                        @endfor
                                    @elseif (count($product->ingredients) >= 1)
                                        @foreach ($product->ingredients as $productIngredient)
                                            <div class="row singleIngredient">
                                                <div class="col-lg-3">
                                                    <div class="flex">
                                                        <select name="ingredient[name][]"
                                                            class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded pr-5` ingredientNameSelect">
                                                            <option value="">Choose Ingredient</option>
                                                            @foreach ($ingredients as $ingredient)
                                                                <option value="{{ $ingredient->id }}" @if ($ingredient->id == $productIngredient->id) selected @endif>
                                                                    {{ $ingredient->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 form-group">
                                                    <input type="text"
                                                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                                                        name="ingredient[concentration][]" placeholder="Concentration"
                                                        value="{{ $productIngredient->pivot->concentration }}"
                                                        maxlength="50">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input type="text"
                                                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                                                        name="ingredient[role][]" placeholder="Role"
                                                        value="{{ $productIngredient->pivot->role }}" maxlength="255">
                                                </div>
                                                <div class="col-lg-1 form-group flex content-evenly">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm my-auto font-bold removeIngredient">&times;</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <x-ingredient :ingredients='$ingredients'></x-ingredient>
                                    @endif
                                </div>
                                <div class="flex justify-around">
                                    <button type="button" class="btn btn-primary btn-sm font-bold relative pl-4"
                                    id="addProductIngredient"><i class="fa fa-plus fa-xs absolute top-2 left-2"></i>
                                    Add Another Ingredient to
                                    this Product</button>
                                    <button type="button" class="btn btn-success btn-sm font-bold relative pl-4"
                                    data-toggle="modal" data-target="#addIngredientModel"><i
                                    class="fa fa-plus fa-xs absolute top-2 left-2"></i> Add New Ingredient to
                                    Database</button>
                                </div>
                            </div>
                        </div>

                        {{-- Indications --}}
                        <div class="offset-lg-2 col-lg-8 form-group my-2">
                            <div class="flex justify-center">
                                <label for="indication" class="min-w-max mr-3 my-auto font-bold">Indications</label>
                                <select name="indication[]"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('indication') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5 multiSelect"
                                    id="indication" multiple>
                                    @foreach ($indications as $indication)
                                        <option value="{{ $indication->id }}">{{ $indication->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('indication')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Images --}}
                        @if (count($oldImages) > 0 && $oldImages != ["default_product.png"])                            
                            <div class="offset-lg-2 col-lg-8 form-group mt-3 mb-0">
                                <div id="oldImages" style="height : 150px;">
                                    @foreach ($oldImages as $oldImage)
                                        <img src="{{asset('images/' . $oldImage)}}" alt="{{$oldImage}}" style="height : 100%;">
                                    @endforeach
                                </div>
                            </div>

                        <div class="offset-lg-2 col-lg-8 form-group my-2 hide newImages">
                            <div class="flex justify-center custom-file">
                                <label for="image" class="min-w-max mr-3 my-auto font-bold">Images</label>
                                <div class="custom-file">
                                    <input type="file" name="image[]" class="custom-file-input" id="images" multiple
                                        accept="image/*">
                                    <label class="custom-file-label" for="images" id="imagesLable">Choose Images...</label>
                                </div>
                            </div>

                            @if ($errors->any())
                                @error('image.*')
                                    <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                @else
                                    <div class="text-yellow-500 text-center mt-2 font-bold" id="imageAgain">Please choose images again</div>
                                @enderror
                            @endif
                        </div>

                        <div class="offset-4 col-lg-4 mb-3 mt-2">
                            <div class="flex justify-center">
                                <button type="button" class="btn btn-primary btn-sm font-bold mr-3" id="newImageButton">Add New Images</button>
                                <button type="button" class="btn btn-warning btn-sm font-bold" id="removeOldImagesWarningButton" data-toggle="modal" data-target='#removeOldImagesWarning'>Remove Old Images</button>
                            </div>
                        </div>
                        @else
                        <div class="offset-lg-2 col-lg-8 form-group my-2 newImages">
                            <div class="flex justify-center custom-file">
                                <label for="image" class="min-w-max mr-3 my-auto font-bold">Images</label>
                                <div class="custom-file">
                                    <input type="file" name="image[]" class="custom-file-input" id="images" multiple
                                        accept="image/*">
                                    <label class="custom-file-label" for="images" id="imagesLable">Choose Images...</label>
                                </div>
                            </div>

                            @if ($errors->any())
                                @error('image.*')
                                    <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                @else
                                    <div class="text-yellow-500 text-center mt-2 font-bold">Please choose images again</div>
                                @enderror
                            @endif
                        </div>
                        @endif

                        {{-- Directions --}}
                        <div class="col-lg-6 form-group my-2">
                            <label for="direction" class="min-w-max mr-3 mb-2 font-bold">Directions of Use</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('direction') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    name="direction"
                                    placeholder="Enter Product Directions of use (e.g. 1- Clean the Skin area. 2- Apply ...)">{{ old('direction', $product->directions_of_use) }}</textarea>
                            </div>
                            @error('direction')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="col-lg-6 form-group my-2">
                            <label for="note" class="min-w-max mr-3 mb-2 font-bold">Notes</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('note') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    name="note"
                                    placeholder="Enter extra notes if present of use (e.g. Don't use with 'Urea' containing products ...)">{{ old('note', $product->notes) }}</textarea>
                            </div>
                            @error('note')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Advantages --}}
                        <div class="col-lg-6 form-group my-2">
                            <label for="advantage" class="min-w-max mr-3 mb-2 font-bold">Product's Advantages</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('advantage') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    name="advantage"
                                    placeholder="Enter product's advantages (e.g. Suitable for sensitive skin ...)">{{ old('advantage', $product->advantages) }}</textarea>
                            </div>
                            @error('advantage')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Disadvantages --}}
                        <div class="col-lg-6 form-group my-2">
                            <label for="disadvantage" class="min-w-max mr-3 mb-2 font-bold">Product's Disadvantages</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('disadvantage') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    name="disadvantage"
                                    placeholder="Enter product's disadvantages (e.g. High price ...)">{{ old('disadvantage', $product->disadvantages) }}</textarea>
                            </div>
                            @error('disadvantage')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex offset-lg-3 col-lg-6  mx-auto justify-between my-2">
                            <button class="btn btn-success text-white font-bold">Save Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger font-bold">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Add New Ingredient Modal --}}
    <div class="modal fade" id="addIngredientModel" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white font-bold">
                    <h5 class="modal-title" id="addModalCenterTitle">Add New Ingredient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group  my-4">
                        <div class="flex justify-center">
                            <label for="name" class="min-w-max mr-3 self-center my-auto font-bold">Ingredient Name</label>
                            <input type="text" id="ingredientName"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 rounded w-50" name="name"
                                value="">
                        </div>
                        <div id="ingredientNameError" class="text-red-500 text-center mt-2 font-bold hidden text-sm"></div>
                    </div>
                </div>
                <div class="modal-footer flex justify-between">
                    <div class="flex w-50  m-auto justify-between my-4">
                        <button class="btn btn-success text-white font-bold" id="saveIngredientButton">Save
                            Ingredient</button>
                        <button type="button" class="btn btn-danger font-bold" id="cancelIngredientButton"
                            data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Remove Images Warning --}}
    <div class="modal fade" id="removeOldImagesWarning" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-black font-bold">
                    <h5 class="modal-title" id="addModalCenterTitle">Remove Old Images Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-black">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group my-3 font-bold">
                        Are you sure, you want to remove old product's images ?
                    </div>
                </div>
                <div class="modal-footer flex justify-between">
                    <div class="flex w-50  m-auto justify-between my-4">
                        <button type="button" class="btn btn-danger text-white font-bold" id="removeImagesButton" data-val='{{ $product->id }}'>Yes</button>
                        <button type="button" class="btn btn-secondary font-bold" id="cancelRemoveImagesButton" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    {{-- Initial  --}}
    var options = [];

    {{-- monoselect --}}
    $('.singleSelect').select2({
        theme: 'bootstrap4',
        dropdownAutoWidth: true,
    });
    $('.ingredientNameSelect').select2({
        theme: 'bootstrap4',
        dropdownAutoWidth: true,
    });

    {{-- multiselect -> indications --}}
    $('.multiSelect').select2({
        multiple: true,
        placeholder: 'Choose Indications',
        selectionCssClass: 'bg-primary'
    });

    {{-- old indications if error exist --}}
    @if (old('indication'))
        var select = [];
        @foreach (old('indication') as $indication)
            select.push({{ $indication }});
        @endforeach
        $('.multiSelect').val(select).change();
    {{-- old indications --}}
    @else
        var select = [];
        @foreach ($product->indications as $indication)
            select.push({{ $indication->id }});
        @endforeach
        $('.multiSelect').val(select).change();
    @endif

    {{-- Old Images Slick --}}
    $('#oldImages').slick({
        centerMode: true,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        variableWidth: true,
    });

    {{-- Show input image  --}}
    $('#newImageButton').on('click', function () {
        $('.newImages').removeClass('hide');
        $(this).remove();
    });

    {{-- Remove Old Images --}}
    $('#removeImagesButton').on('click', function () {
        $.ajax({
            url: '/admin/products/' + $(this).attr('data-val') + '/images',
            method: 'DELETE',
            data: {
                '_token' : '{{ csrf_token() }}'
            },
            success: function (res) {
                console.log(res);
                $('#oldImages').slick('unslick').parent().remove();
                $('#removeOldImagesWarningButton').remove();
                $('#cancelRemoveImagesButton').click();
            }
        })

        
    })

    {{-- ajax get line --}}
    var choose = '<option value="">Choose Line</option>';
    $('#brand').on('change', function () {
        if ($(this).val() != ""){
            $.ajax({
                url: '/products/' + $(this).val() + '/lines',
                method: 'POST',
                data: {
                    '_token' : '{{ csrf_token() }}'
                },
                success: function (res) {
                    $('#line').empty();
                    $('#line').append(choose);
                    for (var i = 0 ; i < res.length ; i++) { 
                        let option = res[i].name; 
                        let option_id=res[i].id; 
                        $('#line').append(` <option value="${option_id}">${option}</option> `);
                    }
                },
            })
        } else {
            $('#line').empty();
            $('#line').append(choose);
        }
    })

        @if (old('brand'))
            $.ajax({
            url: '/products/{{ old('brand') }}/lines',
            method: 'POST',
            data: {
            '_token' : '{{ csrf_token() }}'
            },
            success: function (res) {
            $('#line').empty();
            $('#line').append(choose);
            for (var i = 0 ; i < res.length ; i++) { let option=res[i].name; let option_id=res[i].id;
                $('#line').append(`<option value="${option_id}">${option}</option>`);
                }
                $('#line').val({{ old('line') }}).change();

                },
                })
        @endif

        {{-- image preview --}}
        $('#images').on('change', function () {
            $('#imageAgain').addClass('hide');
        $('#imagesLable').empty();
        for (var i = 0; i < this.files.length; i++) { $('#imagesLable').append(`<span
            class='bg-primary px-2 py-1 rounded-full text-sm shadow-sm text-white mr-2'>${this.files[i].name.slice(0,5) +
            '...'}</span>`);
            if (this.files.length > 6 && i == 5 ){
            $('#imagesLable').append(`<span>...</span>`);
            break;
            }
            }
            })
            $('#saveIngredientButton').on('click', function () {
            $.ajax({
            url: '{{ route('admin.ingredients.add.ajax') }}',
            method: 'POST',
            data: {
            '_token' : '{{ csrf_token() }}',
            'name' : $('#ingredientName').val()
            },
            success: function(res){
            if(res.name){
            $('#ingredientName').removeClass('border-gray-300').addClass('border-red-300');
            $('#ingredientNameError').removeClass('hidden').text(res.name);
            } else if (res.success) {
            $('#ingredientName').removeClass('border-red-300').addClass('border-gray-300').val('');
            $('#ingredientNameError').addClass('hidden');
            $('#cancelIngredientButton').click();
            toastr.success(res.success);
            }
            }
            })
            })

            $('#cancelIngredientButton').on('click', function () {
            $('#ingredientName').removeClass('border-red-300').addClass('border-gray-300').val('');
            $('#ingredientNameError').addClass('hidden');
            });

            $('#ingredientsList').on('click', '.removeIngredient', function () {
            $(this).parents('.singleIngredient').remove();
            });

            $('#addProductIngredient').on('click', function() {
            $('#ingredientsList').append(` <div class="row singleIngredient">
                <div class="col-lg-3">
                    <div class="flex">
                        <select name="ingredient[name][]"
                            class="form-control focus:border-blue-200 focus:ring-blue-200 rounded pr-5 ingredientNameSelect">
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        maxlength="50" name="ingredient[concentration][]" placeholder="Concentration">
                </div>
                <div class="col-lg-6 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        maxlength="255" name="ingredient[role][]" placeholder="Role">
                </div>
                <div class="col-lg-1 form-group flex content-evenly">
                    <button type="button" class="btn btn-danger btn-sm my-auto font-bold removeIngredient">&times;</button>
                </div>
            </div>
            `);

            $.ajax({
            method: 'GET',
            url: '{{ route('admin.ingredients.get.ajax') }}',
            success: function(res) {
            options = [{
            id: '',
            text: 'Choose Ingredient'
            }];
            for (let i = 0; i < res.Ingredients.length; i++) { options.push({ id: res.Ingredients[i].id, text:
                res.Ingredients[i].name }); } $('.ingredientNameSelect').last().select2({ theme: 'bootstrap4' ,
            dropdownAutoWidth: true, data: options, tags: true }) } }) }) @endsection
