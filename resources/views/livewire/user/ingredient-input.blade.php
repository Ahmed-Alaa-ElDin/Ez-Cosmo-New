<div>
    <div id="ingredientsList">
        @foreach ($selectedIngredients as $index => $item) 
            <div class="row singleIngredient">
                <div class="col-lg-3">
                    <div class="flex">
                        <select
                            class="ingredient form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded pr-5` ingredientNameSelect"
                            data-id='{{ $index }}'>
                            @if (empty($item['name']))
                                    <option value="" selected>Choose Ingredient</option>
                                @else
                                    <option value="">Choose Ingredient</option>
                                @endif
                            @foreach ($ingredients as $ingredient)
                                @if ($item['name'] == $ingredient->id)
                                    <option value="{{ $ingredient->id }}" selected>{{ $ingredient->name }}</option>
                                @else
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        wire:model.lazy="selectedIngredients.{{ $index }}.concentration"
                        placeholder="Concentration" maxlength="50">
                </div>
                <div class="col-lg-6 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        wire:model.lazy="selectedIngredients.{{ $index }}.role" placeholder="Role"
                        maxlength="255">
                </div>
                <div class="col-lg-1 form-group flex content-evenly">
                    <button type="button"
                        class="btn btn-danger btn-sm my-auto font-bold removeIngredient" wire:click.prevent='deleteIngredient({{ $index }})'>&times;</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-around">
        <button type="button" class="btn btn-primary btn-sm font-bold relative pl-4" id="addProductIngredient"
            wire:click.prevent='addIngredient'><i class="fa fa-plus fa-xs absolute top-2 left-2"></i>
            Add Another Ingredient to
            this Product</button>
        <button type="button" class="btn btn-success btn-sm font-bold relative pl-4" data-toggle="modal"
            data-target="#addIngredientModel"><i class="fa fa-plus fa-xs absolute top-2 left-2"></i> Add New Ingredient
            to
            Database</button>
    </div>
</div>

@push('scripts')
    $('body').on('change', ('.ingredient'), function () {
    @this.set('selectedIngredients.' + $(this).attr('data-id') + '.name',$(this).val());
    })
@endpush
