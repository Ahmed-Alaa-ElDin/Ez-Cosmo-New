<div>
    <div class="form-group relative w-50 max-h-36 mx-auto z-10">
        <input type="text" id="searchInput"
            class="shadow focus:outline-none focus:ring focus:border-red-300 z-20 form-control rounded text-center"
            wire:model.debounce.300ms='ingredientSearch' wire:keydown.escape='resetData' wire:keydown.arrow-up="goUp"
            wire:keydown.arrow-down="goDown" wire:keydown.enter="selectIngredient"
            placeholder="Type the Ingredient Name" autofocus>
        <div class="absolute top-3 right-3 spinner-grow spinner-grow-sm text-danger" wire:loading role="status">
            <span class="sr-only">Loading...</span>
        </div>
        @if ($ingredients)
            <div class="fixed top-0 right-0 left-0 bottom-0" wire:click='resetIngredients'></div>
            <ul id="choices"
                class="z-20 absolute text-center m-auto border-2 w-100 border-red-500 rounded-xl overflow-hidden rounded-t-none cursor-pointer">
                @forelse ($ingredients as $i => $ingredient)
                    <li class="py-2 px-5 hover:bg-red-500 hover:text-white bg-red-100 @if ($highlightedIndex==$i) bg-red-500 text-white @endif"
                        wire:click='setIngredientSearch("{{ $ingredient->name }}")'>
                        {{ $ingredient->name }}</li>
                @empty
                    <li class="py-2 px-5 bg-red-100">
                        No Results For "{{ $ingredientSearch }}"</li>
                @endforelse
            </ul>
        @endif
    </div>

    {{-- Start Search Card --}}
    <div class="card shadow mb-3" id="searchResults">
        <div class="card-header bg-danger text-white text-center h5 font-bold">
            Search Results
        </div>
        <div class="card-body p-3">
            {{-- pagination Controller --}}
            @if ($products->count() > 0)
                <div class="flex justify-between mb-3 px-2">
                    <div class="self-center">
                        Showing {{ $products->firstItem() ?? 0 }} to
                        {{ $products->lastItem() }} of
                        {{ $products->total() }}
                        entries
                    </div>
                    <div class="align-center">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
            {{-- pagination Controller --}}

            {{-- Results Box --}}
            <div class="products grid grid-cols-5 gap-4 px-2">
                @forelse ($products as $product)
                    <div class="card h-100">
                        <img src="{{ asset('images/' . json_decode($product->product_photo)[0]) }}"
                            class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title h5 text-center"> {{ $product->name }} </h5>
                            <div class="text-center my-3">
                                <div class="price text-red-500 font-bold h6 mt-3">
                                    {{ number_format($product->price, 2, '.', '\'') }} EGP
                                </div>
                                <div class="review mb-5">
                                    <div class='rating-stars'>
                                        <ul class="stars">
                                            <li class='star @if ($product->reviews->avg('pivot.score')>= 0.5) selected @endif'
                                                data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star @if ($product->reviews->avg('pivot.score')>= 1.5) selected @endif'
                                                data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star @if ($product->reviews->avg('pivot.score')>= 2.5) selected @endif'
                                                data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star @if ($product->reviews->avg('pivot.score')>= 3.5) selected @endif'
                                                data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star @if ($product->reviews->avg('pivot.score')>= 4.5) selected @endif'
                                                data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        {{ number_format($product->reviews->avg('pivot.score'), 1) ?? 0 }}
                                        ({{ $product->reviews->count() ?? 0 }})
                                    </div>
                                </div>
                            </div>
                            <div class="details-button text-center">
                                <button type="button" 
                                wire:click="$emit('setProductId', {{ $product->id ?? 0 }})"
                                    class="btn btn-danger font-bold btn-sm w-max">More Details</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center">
                        No results for "<strong>{{ $ingredientSearch }}</strong>"
                    </div>
                @endforelse

            </div>
            {{-- Results Box --}}
        </div>
    </div>
    {{-- End Search Card --}}


    <!-- Details Modal -->
    @livewire('common.product-details', [
        'color' => 'danger',
        'textColor' => 'white'
    ])
    <!-- End Details Modal -->
</div>
