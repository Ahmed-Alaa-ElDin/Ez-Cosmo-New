<div>
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form wire:submit.prevent="submitNewProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        {{-- Brand --}}
                        <div class="col-lg-4 form-group my-3">
                            <div class="flex justify-center">
                                <label for="brand" class="min-w-max mr-3 my-auto font-bold">Brand</label>
                                <select
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('brand') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5"
                                    id="brand" wire:model='brand_id' required>
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @if (old('brand') == $brand->id) selected @endif>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand_id')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lines --}}
                        <div class="col-lg-4 form-group my-3">
                            <div class="flex justify-center">
                                <label for="line" class="min-w-max mr-3 my-auto font-bold">Line</label>
                                <select wire:model='line_id'
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 rounded w-75 pr-5 singleSelect"
                                    id="line">
                                    <option value="">Choose Line</option>
                                    @foreach ($lines as $line)
                                        <option value="{{ $line->id }}" @if (old('line') == $line->id) selected @endif>
                                            {{ $line->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div class="col-lg-4 form-group my-3">
                            <div class="flex justify-center">
                                <label for="category" class="min-w-max mr-3 my-auto font-bold">Category</label>
                                <select id="category" wire:model='category_id'
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('category') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5"
                                    required>
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-lg-5 form-group my-3">
                            <div class="flex justify-center">
                                <label for="name" class="min-w-max mr-3 my-auto font-bold">Name</label>
                                <input type="text" wire:model.lazy='name'
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('name') border-red-300 @else border-gray-300 @enderror rounded w-80"
                                    value="{{ old('name') }}" placeholder="Enter Product Name" required
                                    maxlength="50">
                            </div>
                            @error('name')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dosage Form --}}
                        <div class="col-lg-3 form-group my-3">
                            <div class="flex justify-center">
                                <label for="form" class="min-w-max mr-3 my-auto font-bold">Form</label>
                                <select id="form" wire:model='form_id'
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('form') border-red-300 @else border-gray-300 @enderror rounded w-75 pr-5"
                                    required>
                                    <option value="">Choose Pharmaceutical Form</option>
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->id }}" @if (old('form') == $form->id) selected @endif>
                                            {{ $form->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form_id')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Volume --}}
                        <div class="col-lg-4 form-group my-3">
                            <div class="input-group">
                                <label for="validationTooltipUsername" class="min-w-max mr-3 my-auto font-bold">Volume |
                                    Weight</label>
                                <input type="number" step="any" wire:model.lazy='volume'
                                    class="form-control w-25 text-center focus:border-blue-200 focus:ring-blue-200 @error('volume') border-red-300 @else border-gray-300 @enderror"
                                    style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"
                                    value="{{ old('volume') }}" required min="0">
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
                        <div class="col-lg-2 form-group my-3">
                            <div class="flex justify-center">
                                <label for="units" class="min-w-max mr-3 my-auto font-bold">Units</label>
                                <input type="number" step="any"
                                    class="form-control text-center focus:border-blue-200 focus:ring-blue-200 @error('units') border-red-300 @else border-gray-300 @enderror rounded w-75"
                                    wire:model.lazy="units" value="{{ old('units', 1) }}" required min="1">
                            </div>
                            @error('units')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="offset-lg-1 col-lg-3 form-group my-3">
                            <div class="input-group">
                                <label for="validationTooltipUsername"
                                    class="min-w-max mr-3 my-auto font-bold">Price</label>
                                <input type="number" step="any" wire:model.lazy="price"
                                    class="form-control w-25 text-center focus:border-blue-200 focus:ring-blue-200 @error('price') border-red-300 @else border-gray-300 @enderror"
                                    style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"
                                    value="{{ old('price') }}" required min="0">
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
                        <div class="offset-lg-1 col-lg-5 form-group my-3">
                            <div class="flex justify-center">
                                <label for="code" class="min-w-max mr-3 my-auto font-bold">Code</label>
                                <input type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('code') border-red-300 @else border-gray-300 @enderror rounded w-80"
                                    wire:model.lazy="code" value="{{ old('code') }}"
                                    placeholder="Enter Product Code">
                            </div>
                            @error('code')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ingredient --}}
                        <div class="col-lg-12">
                            <div class="bg-gray-100 rounded border-2 px-3 py-3 border-gray-400">
                                <label class="text-center mb-3 font-bold w-100 font-bold">Ingredients</label>
                                @livewire('user.ingredient-input')
                            </div>
                        </div>

                        {{-- Image Preview --}}
                        @if ($product_photo)
                            <div class="col-lg-12">
                                <div class="row my-2">
                                    @foreach ($product_photo as $photo)
                                        <div class="col-lg-2">
                                            <img class="w-100" src="{{ $photo->temporaryUrl() }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button class="btn btn-sm btn-danger" wire:click='resetImages'>Delete Images</button>
                            </div>
                        @endif

                        {{-- Indications --}}
                        <div class="col-lg-6 form-group my-3">
                            <div class="flex justify-center">
                                <label for="indication" class="min-w-max mr-3 my-auto font-bold">Indications
                                </label>
                                <select wire:ignore
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
                        <div class="col-lg-6 form-group my-3">
                            <div class="flex justify-center custom-file">
                                <label for="image" class="min-w-max mr-3 my-auto font-bold">Images </label>
                                <div class="custom-file">
                                    <input type="file" wire:model="product_photo" class="custom-file-input" id="images"
                                        multiple accept="image/*">
                                    <label class="custom-file-label" for="images" id="imagesLable" wire:ignore>Choose
                                        Images...</label>
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

                        {{-- Directions --}}
                        <div class="col-lg-6 form-group my-3">
                            <label for="direction" class="min-w-max mr-3 mb-2 font-bold">Directions of Use</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('direction') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    wire:model.lazy="directions_of_use"
                                    placeholder="Enter Product Directions of use (e.g. 1- Clean the Skin area. 2- Apply ...)">{{ old('direction') }}</textarea>
                            </div>
                            @error('direction')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="col-lg-6 form-group my-3">
                            <label for="note" class="min-w-max mr-3 mb-2 font-bold">Notes</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('note') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    wire:model.lazy="notes"
                                    placeholder="Enter extra notes if present of use (e.g. Don't use with 'Urea' containing products ...)">{{ old('note') }}</textarea>
                            </div>
                            @error('note')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Advantages --}}
                        <div class="col-lg-6 form-group my-3">
                            <label for="advantage" class="min-w-max mr-3 mb-2 font-bold">Product's Advantages</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('advantage') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    wire:model.lazy="advantages"
                                    placeholder="Enter product's advantages (e.g. Suitable for sensitive skin ...)">{{ old('advantage') }}</textarea>
                            </div>
                            @error('advantage')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Disadvantages --}}
                        <div class="col-lg-6 form-group my-3">
                            <label for="disadvantage" class="min-w-max mr-3 mb-2 font-bold">Product's
                                Disadvantages</label>
                            <div class="flex justify-center">
                                <textarea type="text"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('disadvantage') border-red-300 @else border-gray-300 @enderror rounded w-100"
                                    wire:model.lazy="disadvantages"
                                    placeholder="Enter product's disadvantages (e.g. High price ...)">{{ old('disadvantage') }}</textarea>
                            </div>
                            @error('disadvantage')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex offset-lg-3 col-lg-6  mx-auto justify-between my-3">
                            <button class="btn btn-success text-white font-bold" wire:click='submitNewProduct'>Save
                                Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger font-bold">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addIngredientModel" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
        aria-hidden="true" wire:ignore.self>
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
                            <label for="name" class="min-w-max mr-3 self-center my-auto font-bold">Ingredient
                                Name</label>
                            <input type="text" id="ingredientName"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 rounded w-50"
                                wire:model="ingredient_name" value="">
                        </div>
                        @error('ingredient_name')
                            <div id="ingredientNameError" class="text-red-500 text-center mt-2 mb-0 font-bold text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer flex justify-between">
                    <div class="flex w-50  m-auto justify-between my-4">
                        <button class="btn btn-success text-white font-bold" id="saveIngredientButton"
                            data-dismiss="modal" wire:click='submitNewIngredient'>Save
                            Ingredient</button>
                        <button type="button" class="btn btn-danger font-bold" id="cancelIngredientButton"
                            data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    {{-- Added New Ingredient Success Toaster --}}
    window.livewire.on('successIngredientAdd', data => {
    toastr.success('New ingredient added successfully');
    });

    {{-- function to initialize all select 2 --}}
    function select2Init () {
    $('#brand').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    placeholder: 'Choose Brand',
    });

    $('#line').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    placeholder: 'Choose Line',
    });

    $('#category').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    placeholder: 'Choose Category',
    })

    $('#form').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    placeholder: 'Choose Form',
    })

    $('#indication').select2({
    multiple: true,
    placeholder: 'Choose Indications',
    selectionCssClass: 'bg-primary'
    });

    $('.ingredientNameSelect').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    });
    }

    {{-- Initialize select 2 fields on page load --}}
    select2Init();

    {{-- retrigger select2 after change of selection --}}
    Livewire.on('initializeSelect', () => {
    select2Init();
    })

    @stack('scripts')


    {{-- listen to brand select2 --}}
    $('#brand').on('change', function () {
    @this.set('brand_id',$(this).val());
    @this.set('line_id',null);
    })

    {{-- Change Lines List After Brand Change --}}
    Livewire.on('updateLines', Lines => {
    $('#line').select2({
    theme: 'bootstrap4',
    dropdownAutoWidth: true,
    placeholder: 'Choose Line',
    data: Lines
    })
    })

    {{-- listen to line select2 --}}
    $('#line').on('change', function () {
    @this.set('line_id',$(this).val());
    })

    {{-- listen to category select2 --}}
    $('#category').on('change', function () {
    @this.set('category_id',$(this).val());
    })

    {{-- listen to form Select2 --}}
    $('#form').on('change', function () {
    @this.set('form_id',$(this).val());
    })

    {{-- listen to indication Select2 --}}
    $('#indication').on('change', function () {
    @this.set('selectedIndications',$(this).val());
    })

    {{-- image preview --}}
    $('#images').on('change', function () {
    $('#imagesLable').empty();
    for (var i = 0; i < this.files.length; i++) { $('#imagesLable').append(`<span
        class='bg-primary px-2 py-1 rounded-full text-sm shadow-sm text-white mr-2'>${this.files[i].name.slice(0,5) +
        '...'}</span>`);

        if (this.files.length > 4 && i == 3 ){
        $('#imagesLable').append(`<span>...</span>`);
        break;
        }
        }
        })

    @endsection
