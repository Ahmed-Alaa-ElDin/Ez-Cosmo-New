<div>
    <div class="row singleIngredient">
        <div class="col-lg-3">
            <div class="flex">
                <select name="ingredient[name][]"
                    class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded pr-5` ingredientNameSelect">
                    <option value="">Choose Ingredient</option>
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 form-group">
            <input type="text"
                class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                name="ingredient[concentration][]" placeholder="Concentration" maxlength="50">
        </div>
        <div class="col-lg-6 form-group">
            <input type="text"
                class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                name="ingredient[role][]" placeholder="Role" maxlength="255">
        </div>
        <div class="col-lg-1 form-group flex content-evenly">
            <button type="button" class="btn btn-danger btn-sm my-auto font-bold removeIngredient">&times;</button>
        </div>
    </div>
</div>
