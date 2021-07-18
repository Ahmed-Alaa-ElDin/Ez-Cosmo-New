<div>

    {{-- Start Search Card --}}
    <div class="card mb-3" id="searchResults">
        <div class="card-header bg-primary text-white text-center h5 font-bold">
            Search Results
        </div>
        <div class="card-body p-3">
            {{-- pagination Controller --}}
            @if ($productsSearchResults->count() > 0)
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
            @endif
            {{-- pagination Controller --}}

            {{-- Results Box --}}
            <div class="products grid grid-cols-5 gap-4 px-2">
                @forelse ($productsSearchResults as $product)
                    <div class="card h-100">
                        <div class="h-48 flex flex-wrap content-center p-2">
                            <img src="{{ asset('images/' . json_decode($product->product_photo)[0]) }}"
                                class="card-img-top max-h-48 rounded-xl" alt="{{ $product->name }}">
                        </div>
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
                                wire:click="$emit('setProductId', {{ $product->id }})"
                                    class="btn btn-primary font-bold btn-sm w-max">More Details</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center">
                        No results for "<strong>{{ $productName }}</strong>" according to your filters
                    </div>
                @endforelse

            </div>
            {{-- Results Box --}}
        </div>
    </div>
    {{-- End Search Card --}}
    {{-- =================================================================================================== --}}
    {{-- =================================================================================================== --}}
    {{-- =================================================================================================== --}}


    {{-- Highly Reviewed Products --}}
    
    @if ($topRatedProducts)
    <div class="card mb-3">
        <div class="card-header bg-warning text-center h5 font-bold">
            Highly Reviewed Products
        </div>
        <div class="card-body">
            <div id="highlyReviewedProducts" class="products px-4 mb-0" wire:ignore>
                @forelse ($topRatedProducts as $review)
                    <div class="product mx-2">
                        <div class="card h-100">
                            <div class="h-48 flex flex-wrap content-center p-2">
                                <img src="{{ asset('images/' . json_decode($review->product->product_photo)[0]) }}"
                                    class="card-img-top max-h-48 rounded-xl" alt="{{ $review->product->name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title h5 text-center"> {{ $review->product->name }} </h5>
                                <div class="text-center my-3">
                                    <div class="price text-red-500 font-bold h6 mt-3">
                                        {{ number_format($review->product->price, 2, '.', '\'') }} EGP
                                    </div>
                                    <div class="review mb-5">
                                        <div class='rating-stars'>
                                            <ul class="stars">
                                                <li class='star selected' title='1' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($review->avg_score >= 1.5) selected @endif'
                                                    title='2' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($review->avg_score >= 2.5) selected @endif'
                                                    title='3' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($review->avg_score >= 3.5) selected @endif'
                                                    title='4' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($review->avg_score >= 4.5) selected @endif'
                                                    title='5' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            {{ number_format($review->avg_score, 1) }}
                                            ({{ $review->no_reviewers }})
                                        </div>
                                    </div>
                                </div>
                                <div class="details-button text-center">
                                    <a data-toggle="modal" data-target="#DetailsModal"
                                    wire:click="$emit('setProductId', {{ $product->id }})"
                                        class="btn btn-warning font-bold btn-sm w-max">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        There are no reviews yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @endif
    {{-- Highly Reviewed Products --}}

    {{-- =================================================================================================== --}}
    {{-- =================================================================================================== --}}
    {{-- =================================================================================================== --}}

    {{-- Newly Added Products --}}
    @if ($newlyAddedProducts)
        <div class="card">
            <div class="card-header bg-green-400 text-center h5 font-bold">
                Newly Added Products
            </div>
            <div class="card-body">
                @if ($newlyAddedProducts->count())
                    <div id="NewlyAddedProducts" class="products px-4" wire:ignore>
                        @foreach ($newlyAddedProducts as $product)
                            <div class="product mx-2">
                                <div class="card h-100">
                                    <div class="h-48 flex flex-wrap content-center p-2">
                                        <img src="{{ asset('images/' . json_decode($product->product_photo)[0]) }}"
                                            class="card-img-top max-h-48 rounded-xl" alt="{{ $product->name }}">
                                    </div>
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
                                            <a data-toggle="modal" data-target="#DetailsModal"
                                                wire:click="$emit('setProductId', {{ $product->id }})"
                                                class="btn btn-success font-bold btn-sm w-max">More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center">
                        There are no products yet
                    </div>
                @endif
            </div>
        </div>
    @endif
    {{-- Highly Reviewed Products --}}

    <!-- Details Modal -->
    @livewire('common.product-details', [
    'color' => 'primary',
    'textColor' => 'white'
    ])
    <!-- End Details Modal -->

</div>
