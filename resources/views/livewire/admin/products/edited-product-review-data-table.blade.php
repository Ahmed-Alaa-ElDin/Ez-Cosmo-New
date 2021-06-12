<div>
    <table class="table table-bordered w-100 text-center align-middle">
        <thead class="bg-green-500 text-white align-middle">
            <tr>
                <th></th>
                <th>Old</th>
                <th>New</th>
            </tr>
        </thead>

        <tbody class="align-middle">
            {{-- begin::Product Name --}}
            @if (isset($editedProduct->name))
                <tr>
                    <th class="bg-green-500 text-white">Name</th>
                    <td><label for="oldName"><input type="radio" wire:model="name" value="{{ $oldProduct->name }}"
                                id="oldName"> &nbsp;
                            {{ $oldProduct->name ?? 'No Old Name' }}</label></td>
                    <td><label for="newName"><input type="radio" wire:model="name" value="{{ $editedProduct->name }}"
                                id="newName"> &nbsp;
                            {{ $editedProduct->name ?? 'No New Name' }}</label></td>
                </tr>
            @endif
            {{-- end::Product Name --}}

            {{-- begin::Product Category --}}
            @if (isset($editedProduct->category_id))
                <tr>
                    <th class="bg-green-500 text-white">Category</th>
                    <td><label for="oldCategoryId"><input type="radio" wire:model="category_id"
                                value="{{ $oldProduct->category_id }}" id="oldCategoryId"> &nbsp;
                            {{ $oldProduct->category->name ?? 'No Old Category' }}</label></td>
                    <td><label for="newCategoryId"><input type="radio" wire:model="category_id"
                                value="{{ $editedProduct->category_id }}" id="newCategoryId"> &nbsp;
                            {{ $editedProduct->category->name ?? 'No New Category Selected' }}</label></td>
                </tr>
            @endif
            {{-- end::Product Category --}}

            {{-- begin::Product Brand --}}
            @if (isset($editedProduct->brand_id))
                <tr>
                    <th class="bg-green-500 text-white">Brand</th>
                    <td><label for="oldBrandId"><input type="radio" wire:model="brand_id"
                                value="{{ $oldProduct->brand_id }}" id="oldBrandId"> &nbsp;
                            {{ $oldProduct->brand->name ?? 'No Old Brand' }}</label></td>
                    <td><label for="newBrandId"><input type="radio" wire:model="brand_id"
                                value="{{ $editedProduct->brand_id }}" id="newBrandId"> &nbsp;
                            {{ $editedProduct->brand->name ?? 'No New Brand Selected' }}</label></td>
                </tr>
            @endif
            {{-- end::Product Brand --}}

            {{-- begin::Product Line --}}
            @if (isset($editedProduct->line_id))
                <tr>
                    <th class="bg-green-500 text-white">Line</th>
                    <td><label for="oldLineId"><input type="radio" wire:model="line_id"
                                value="{{ $oldProduct->line_id }}" id="oldLineId"> &nbsp;
                            {{ $oldProduct->line->name ?? 'No Old Line' }}</label></td>
                    <td><label for="newLineId"><input type="radio" wire:model="line_id"
                                value="{{ $editedProduct->line_id }}" id="newLineId"> &nbsp;
                            {{ $editedProduct->line->name ?? 'No New Line Selected' }}</label></td>
                </tr>
            @endif
            {{-- end::Product Line --}}

            {{-- begin::Product Indications --}}
            @if (isset($editedProduct->indications) && !($editedProduct->indications->isEmpty() && $indications->isEmpty()) && !($editedProduct->indications->pluck('id')->toArray() == $indications->pluck('id')->toArray()))
                <tr>
                    <th class="bg-green-500 align-middle text-white">Indications</th>

                    <td class="bg-green-100 align-middle">
                        @forelse ($indications as $indication)
                            <label>
                                <input type="checkbox" wire:model="selectedIndications"
                                    value="{{ $indication->id }}">
                                &nbsp; {{ $indication->name }}
                            </label>
                        @empty
                            <label class="bg-red-100 cursor-default"> No Old Indications </label>
                        @endforelse
                    </td>
                    <td class="bg-green-100 align-middle">
                        @forelse ($editedProduct->indications as $indication)
                            <label>
                                <input type="checkbox" wire:model="selectedIndications"
                                    value="{{ $indication->id }}">
                                &nbsp; {{ $indication->name }}
                            </label>
                        @empty
                            <label class="bg-red-100 cursor-default"> No New Indications </label>
                        @endforelse
                    </td>
                </tr>
            @endif
            {{-- end::Product Indications --}}

            {{-- begin::Product Ingredients --}}
            @if (isset($editedProduct->ingredients) 
            // check if both are empty
            && !($editedProduct->ingredients->isEmpty() && $ingredients->isEmpty()) 
            // check if no edits
            && !($differentIngredients))
                <tr>
                    <th class="bg-green-500 text-white align-middle">Ingredients</th>

                    <td class="bg-green-100 align-middle">
                        @forelse ($oldProduct->ingredients as $ingredient)
                            <label>
                                <input type="checkbox" wire:model="selectedIngredients"
                                    value="{{ $ingredient->id }}">
                                &nbsp;
                                {{ $ingredient ? $ingredient->name . ' | ' . $ingredient->pivot->concentration . ' | ' . $ingredient->pivot->role : '' }}
                            </label>
                        @empty
                            <label class="bg-red-100 cursor-default"> No Old Ingredients </label>
                        @endforelse
                    </td>
                    <td class="bg-green-100 align-middle">
                        @forelse ($editedProduct->ingredients as $ingredient)
                            <label>
                                <input type="checkbox" wire:model="selectedIngredients"
                                    value="{{ $ingredient->id }}">
                                &nbsp;
                                {{ $ingredient ? $ingredient->name . ' | ' . $ingredient->pivot->concentration . ' | ' . $ingredient->pivot->role : '' }}
                            </label>
                        @empty
                            <label class="bg-red-100 cursor-default"> No New Ingredients </label>
                        @endforelse
                    </td>
                </tr>
            @endif
            {{-- end::Product Ingredients --}}

            {{-- begin::Product Form --}}
            @if (isset($editedProduct->form_id))
                <tr>
                    <th class="bg-green-500 text-white">Form</th>
                    <td><label for="oldFormId"><input type="radio" wire:model="form_id"
                                value="{{ $oldProduct->form_id }}" id="oldFormId"> &nbsp;
                            {{ $oldProduct->form->name ?? 'No Old Form' }}</label></td>
                    <td><label for="newFormId"><input type="radio" wire:model="form_id"
                                value="{{ $editedProduct->form_id }}" id="newFormId"> &nbsp;
                            {{ $editedProduct->form->name }}</label></td>
                </tr>
            @endif
            {{-- end::Product Form --}}

            {{-- begin::Product Volume --}}
            @if (isset($editedProduct->volume))
                <tr>
                    <th class="bg-green-500 text-white">Volume</th>
                    <td><label for="oldVolume"><input type="radio" wire:model="volume"
                                value="{{ $oldProduct->volume }}" id="oldVolume"> &nbsp;
                            {!! $oldProduct->volume ? $oldProduct->volume . ' Ml. <small>or</small> Gm.' : 'No Old Volume Specified' !!}
                        </label></td>
                    <td><label for="newVolume"><input type="radio" wire:model="volume"
                                value="{{ $editedProduct->volume }}" id="newVolume"> &nbsp;
                            {!! $editedProduct->volume ? $editedProduct->volume . ' Ml. <small>or</small> Gm.' : 'No New Volume Specified' !!}
                </tr>
            @endif
            {{-- end::Product Volume --}}

            {{-- begin::Units --}}
            @if (isset($editedProduct->units))
                <tr>
                    <th class="bg-green-500 text-white">Units</th>
                    <td><label for="oldUnits"><input type="radio" wire:model="units" value="{{ $oldProduct->units }}"
                                id="oldUnits"> &nbsp;
                            {{ $oldProduct->units ?? 'No Old Units' }}</label></td>
                    <td><label for="newUnits"><input type="radio" wire:model="units"
                                value="{{ $editedProduct->units }}" id="newUnits"> &nbsp;
                            {{ $editedProduct->units }}</label></td>
                </tr>
            @endif
            {{-- end::Units --}}

            {{-- begin::Product Price --}}
            @if (isset($editedProduct->price))
                <tr>
                    <th class="bg-green-500 text-white">Price</th>
                    <td><label for="oldPrice"><input type="radio" wire:model="price" value="{{ $oldProduct->price }}"
                                id="oldPrice"> &nbsp;
                            {{ $oldProduct->price ? $oldProduct->price . ' EGP' : 'No Old Price' }}</label></td>
                    <td><label for="newPrice"><input type="radio" wire:model="price"
                                value="{{ $editedProduct->price }}" id="newPrice"> &nbsp;
                            {{ $editedProduct->price . ' EGP' }}</label></td>
                </tr>
            @endif
            {{-- end::Product Price --}}

            {{-- begin::Product Code --}}
            @if (isset($editedProduct->code))
                <tr>
                    <th class="bg-green-500 text-white">Code</th>
                    <td><label for="oldCode"><input type="radio" wire:model="code" value="{{ $oldProduct->code }}"
                                id="oldCode"> &nbsp;
                            {{ $oldProduct->code ?? 'No Old Code' }}</label></td>
                    <td><label for="newCode"><input type="radio" wire:model="code" value="{{ $editedProduct->code }}"
                                id="newCode"> &nbsp;
                            {{ $editedProduct->code }}</label></td>
                </tr>
            @endif
            {{-- end::Product Code --}}

            {{-- begin::Product Product Photo --}}
            {{-- {{ dd($oldProduct->product_photo == '["default_product.png"]' ) }} --}}
            @if ($editedProduct->product_photo != $oldProduct->product_photo && !($editedProduct->product_photo == null && $oldProduct->product_photo == '["default_product.png"]' ))
                <tr id="imageSelect">
                    <th class="bg-green-500 text-white align-middle">Product Photo </th>
                    <td class="bg-green-100 align-middle">
                        @forelse (json_decode($oldProduct->product_photo) as $photo)
                            <label>
                                <input type="checkbox" wire:model="selectedPhotos" value="{{ $photo }}">
                                <img class="block m-auto max-h-44 rounded-xl" src="{{ asset('images/' . $photo) }}"
                                    alt="{{ $photo }}">
                            </label>
                        @empty
                            <div>No Old Images</div>
                        @endforelse
                    </td>
                    <td class="bg-green-100 align-middle">
                        @if (isset($editedProduct->product_photo))
                            @forelse (json_decode($editedProduct->product_photo) as $photo)
                                <label>
                                    <input type="checkbox" wire:model="selectedPhotos" value="{{ $photo }}">
                                    <img class="block m-auto max-h-44 rounded-xl"
                                        src="{{ asset('images/' . $photo) }}" alt="{{ $photo }}">
                                </label>
                            @empty
                                <div>Old Images Deleted</div>
                            @endforelse
                        @else
                            <div>Old Images Deleted</div>
                        @endif
                </tr>
            @endif
            {{-- end::Product Product Photo --}}

            {{-- begin::Product Directions of Use --}}
            @if (isset($editedProduct->directions_of_use))
                <tr>
                    <th class="bg-green-500 text-white">Directions of Use</th>
                    <td><label for="oldDirectionsOfUse"><input type="radio" wire:model="directions_of_use"
                                value="{{ $oldProduct->directions_of_use }}" id="oldDirectionsOfUse"> &nbsp;
                            {{ $oldProduct->directions_of_use }}</label></td>
                    <td><label for="newDirectionsOfUse"><input type="radio" wire:model="directions_of_use"
                                value="{{ $editedProduct->directions_of_use }}" id="newDirectionsOfUse"> &nbsp;
                            {{ $editedProduct->directions_of_use }}</label></td>
                </tr>
            @endif
            {{-- end::Product Directions of Use --}}

            {{-- begin::Product Notes --}}
            @if (isset($editedProduct->notes))
                <tr>
                    <th class="bg-green-500 text-white">Notes</th>
                    <td><label for="oldNotes"><input type="radio" wire:model="notes" value="{{ $oldProduct->notes }}"
                                id="oldNotes"> &nbsp;
                            {{ $oldProduct->notes ?? 'No Old Notes' }}</label></td>
                    <td><label for="newNotes"><input type="radio" wire:model="notes"
                                value="{{ $editedProduct->notes }}" id="newNotes"> &nbsp;
                            {{ $editedProduct->notes }}</label></td>
                </tr>
            @endif
            {{-- end::Product Notes --}}

            {{-- begin::Product Advantages --}}
            @if (isset($editedProduct->advantages))
                <tr>
                    <th class="bg-green-500 text-white">Advantages</th>
                    <td><label for="oldAdvantages"><input type="radio" wire:model="advantages"
                                value="{{ $oldProduct->advantages }}" id="oldAdvantages"> &nbsp;
                            {{ $oldProduct->advantages ?? 'No Old Advantages' }}</label></td>
                    <td><label for="newAdvantages"><input type="radio" wire:model="advantages"
                                value="{{ $editedProduct->advantages }}" id="newAdvantages"> &nbsp;
                            {{ $editedProduct->advantages }}</label></td>
                </tr>
            @endif
            {{-- end::Product Advantages --}}

            {{-- begin::Product Disadvantages --}}
            @if (isset($editedProduct->disadvantages))
                <tr>
                    <th class="bg-green-500 text-white">Disadvantages</th>
                    <td><label for="oldDisadvantages"><input type="radio" wire:model="disadvantages"
                                value="{{ $oldProduct->disadvantages }}" id="oldDisadvantages">
                            &nbsp;
                            {{ $oldProduct->disadvantages ?? 'No Old Disadvantages' }}</label></td>
                    <td><label for="newDisadvantages"><input type="radio" wire:model="disadvantages"
                                value="{{ $editedProduct->disadvantages }}" id="newDisadvantages">
                            &nbsp;
                            {{ $editedProduct->disadvantages }}</label></td>
                </tr>
            @endif
            {{-- end::Product Disadvantages --}}
        </tbody>
    </table>

    <div class="flex justify-around">
        <button class="btn btn-success font-bold" wire:click = 'saveEdit'>Save Edits</button>
        <button class="btn btn-danger font-bold" wire:click = 'removeEdit'>Remove Edits</button>
        <a class="btn btn-secondary font-bold" href="{{ route('admin.edited_products.index') }}">Cancel</a>
    </div>
</div>
