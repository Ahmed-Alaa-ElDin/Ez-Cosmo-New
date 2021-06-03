<div>
    <div class="form-group">
        <input type="text" name="" class="form-control rounded w-50 m-auto text-center" placeholder="Type the Ingredient">
    </div>

        {{-- Start Search Card --}}
        <div class="card mb-3" id="searchResults">
            <div class="card-header bg-primary text-white text-center h5 font-bold">
                Search Results
            </div>
            <div class="card-body p-3">
                {{-- pagination Controller --}}
                {{-- @if ($productsSearchResults->count() > 0)
                    <div class="flex justify-between mb-3 px-2">
                        <div class="self-center">
                            Showing {{ $productsSearchResults->firstItem() ?? 0 }} to
                            {{ $productsSearchResults->lastItem() }} of
                            {{ $productsSearchResults->total() }}
                            entries
                        </div>
                        <div class="align-center">
                            {{ $productsSearchResults->links() }}
                        </div>
                    </div>
                @endif --}}
                {{-- pagination Controller --}}

                {{-- Results Box --}}
                {{-- <div class="products grid grid-cols-5 gap-4 px-2">
                    @forelse ($productsSearchResults as $product)
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
                                    <button type="button" data-toggle="modal" data-target="#DetailsModal"
                                        wire:click="productDetails({{ $product->id }})"
                                        class="btn btn-primary font-bold btn-sm w-max">More Details</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-5 text-center">
                            No results for "<strong>{{ $productName }}</strong>" according to your filters
                        </div>
                    @endforelse

                </div> --}}
                {{-- Results Box --}}
            </div>
        </div>
    {{-- End Search Card --}}

</div>
