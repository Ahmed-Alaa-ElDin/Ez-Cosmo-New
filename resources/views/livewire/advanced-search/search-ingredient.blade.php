<div>
    <div class="form-group relative w-50 max-h-36 mx-auto z-10">
        <input type="text" id="searchInput" class="shadow focus:outline-none focus:ring focus:border-red-300 z-20 form-control rounded text-center"
            wire:model.debounce.300ms='ingredientSearch' wire:keydown.escape='resetData'
            wire:keydown.arrow-up="goUp" wire:keydown.arrow-down="goDown"
            wire:keydown.enter="selectIngredient" placeholder="Type the Ingredient Name" autofocus>
        <div class="absolute top-3 right-3 spinner-grow spinner-grow-sm text-danger" wire:loading role="status">
            <span class="sr-only">Loading...</span>
        </div>
        @if ($ingredients)
            <div class="fixed top-0 right-0 left-0 bottom-0" wire:click='resetIngredients'></div>
            <ul id="choices"
                class="z-20 absolute text-center m-auto border-2 w-100 border-red-500 rounded-xl overflow-hidden rounded-t-none cursor-pointer">
                @forelse ($ingredients as $i => $ingredient)
                    <li class="py-2 px-5 hover:bg-red-500 hover:text-white bg-red-100 @if ($highlightedIndex == $i)
                        bg-red-500 text-white
                    @endif"
                        wire:click='setIngredientSearch("{{ $ingredient->name }}")' >
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
                                                <li class='star @if ($product->reviews->avg('pivot.score') >= 0.5) selected @endif'
                                                    data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($product->reviews->avg('pivot.score') >= 1.5) selected @endif'
                                                    data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($product->reviews->avg('pivot.score') >= 2.5) selected @endif'
                                                    data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($product->reviews->avg('pivot.score') >= 3.5) selected @endif'
                                                    data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star @if ($product->reviews->avg('pivot.score') >= 4.5) selected @endif'
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
        <div class="modal fade bd-example-modal-xl" id="DetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="datailsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="datailsModalCenterTitle">Product's Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center bg-gray-200 px-1 py-3">
                    @if ($productDetails)

                        <div class="row">
                            <div class="col-lg-8 pl-3">
                                <div class="bg-white rounded-xl py-3">

                                    <div class="row">
                                        {{-- Name --}}
                                        @if ($productDetails->name)
                                            <div class="col-lg-12 text-center h3 mb-3" id="productName">
                                                {{ $productDetails->name }}
                                            </div>
                                        @endif
                                        {{-- Images --}}
                                        <div class="col-lg-6 px-5 mb-4 border-l-2 border-gray-100">
                                            <div id="carouselExampleFade" class="carousel slide" data-ride="carousel"
                                                data-interval="false">
                                                <ol class="carousel-indicators">
                                                    @if ($productDetails->product_photo)
                                                        @foreach (json_decode($productDetails->product_photo) as $image)
                                                            <li data-target="#carouselExampleFade"
                                                                data-slide-to="{{ $loop->index }}" class="
                                                        @if ($loop->first) active @endif">
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ol>
                                                <div class="carousel-inner">
                                                    @if ($productDetails->product_photo)
                                                        @foreach (json_decode($productDetails->product_photo) as $image)
                                                            <div class="carousel-item @if ($loop->
                                                                first) active @endif">
                                                                <img src="{{ asset('images/' . $image) }}"
                                                                    class="d-block w-100" alt="{{ $image }}">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleFade"
                                                    role="button" data-slide="prev">
                                                    <i class="fas fa-arrow-circle-left text-black"
                                                        aria-hidden="true"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleFade"
                                                    role="button" data-slide="next">
                                                    <i class="fas fa-arrow-circle-right text-black"
                                                        aria-hidden="true"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Other Details 1 --}}
                                        <div class="col-lg-6">
                                            <div class="row">

                                                {{-- Category --}}
                                                <div class="col-lg-12 mb-2">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-5 bg-gray-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100">Category</span>
                                                        </div>
                                                        <div
                                                            class="col-lg-7 bg-white rounded-r border-2 border-gray-900 py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100" id="productCategory">
                                                                {{ $productDetails->category->name }} </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Brand --}}
                                                <div class="col-lg-12 mb-2">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-5 bg-gray-800 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100">Brand</span>
                                                        </div>
                                                        <div
                                                            class="col-lg-7 bg-white rounded-r border-2 border-gray-800 py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100" id="productBrand">
                                                                {{ $productDetails->brand->name }} </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Line --}}
                                                @if ($productDetails->line != '')
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-5 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                                <span class="text-center w-100">Line</span>
                                                            </div>
                                                            <div
                                                                class="col-lg-7 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                                <span class="text-center w-100" id="productLine">
                                                                    {{ $productDetails->line->name }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Indications --}}
                                                @if ($productDetails->indications && !empty($productDetails->indications->toArray()))
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-5 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                                <span class="text-center w-100">Indications</span>
                                                            </div>
                                                            <div
                                                                class="col-lg-7 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                                <ul class="text-left w-100 ml-3" id="productIndication">
                                                                    @foreach ($productDetails->indications as $indication)
                                                                        <li class='indication'>
                                                                            {{ $indication->name }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        {{-- Other Details 1 --}}
                                        <div class="col-lg-12">
                                            <div class="row">

                                                {{-- Ingredients --}}
                                                @if ($productDetails->ingredients && !empty($productDetails->ingredients->toArray()))
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 bg-blue-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                                <div class="self-center text-center w-100">Ingredients
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-9 bg-white rounded-r border-2 border-blue-900 py-1 overflow-hidden flex items-center">
                                                                <span class="inl@ine-block w-100 text-left"
                                                                    id="productIngredient">
                                                                    @foreach ($productDetails->ingredients as $ingredient)
                                                                        <span> {{ $ingredient->name }}
                                                                            <i class="fas fa-question-circle cursor-pointer"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title=' @if ($ingredient->pivot && $ingredient->pivot->concentration != '') {{ $ingredient->pivot->concentration }} @endif @if ($ingredient->pivot && $ingredient->pivot->concentration != '' && $ingredient->pivot->role != '') {{ '|' }} @endif @if ($ingredient->pivot && $ingredient->pivot->role != '') {{ $ingredient->pivot->role }} @endif'>
                                                                            </i>
                                                                        </span>
                                                                        @if ($loop->last)
                                                                            .
                                                                        @else
                                                                            ,
                                                                        @endif
                                                                    @endforeach
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Directions --}}
                                                @if ($productDetails->directions != '')
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 bg-blue-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                                <div class="self-center text-center w-100">Directions
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-9 bg-white rounded-r border-2 border-blue-700 py-1 overflow-hidden flex items-center">
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productDirections">
                                                                    {{ $productDetails->directions }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Notes --}}
                                                @if ($productDetails->notes != '')
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 bg-blue-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                                <div class="self-center text-center w-100">Notes</div>
                                                            </div>
                                                            <div
                                                                class="col-lg-9 bg-white rounded-r border-2 border-blue-600 py-1 overflow-hidden flex items-center">
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productNotes">
                                                                    {{ $productDetails->notes }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Advantages --}}
                                                @if ($productDetails->advantages != '')
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 bg-green-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                                <div class="self-center text-center w-100">Advantages
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-9 bg-white rounded-r border-2 border-green-600 py-1 overflow-hidden flex items-center">
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productAdvantages">
                                                                    {{ $productDetails->advantages }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Disadvantages --}}
                                                @if ($productDetails->disadvantages != '')
                                                    <div class="col-lg-12 mb-2 origin">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 bg-red-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                                <div class="self-center text-center w-100">Disadvantages
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-9 bg-white rounded-r border-2 border-red-600 py-1 overflow-hidden flex items-center">
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productDisadvantages">
                                                                    {{ $productDetails->disadvantages }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Reviews --}}
                                                <div class="col-lg-12 mb-2">
                                                    @livewire('admin.review', ['product_id' => $productDetails->id],key($productDetails->id))
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pr-3 pl-1">
                                <div class="bg-white rounded-xl p-3">
                                    <div class="row">

                                        {{-- Form --}}
                                        <div class="col-lg-6 mb-2">
                                            <div class="bg-indigo-900 text-white rounded-t font-bold py-1">
                                                Form
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-900 py-1"
                                                id="productForm">
                                                {{ $productDetails->form->name }}
                                            </div>
                                        </div>

                                        {{-- Volume --}}
                                        @if ($productDetails->volume != '' && $productDetails->volume > 0)
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                                    Vol. | Wt.
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                                    id="productVolume">
                                                    {{ $productDetails->volume }}
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Units --}}
                                        @if ($productDetails->units != '' && $productDetails->units > 1)
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                                    Units
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-700 py-1"
                                                    id="productUnits">
                                                    {{ $productDetails->units }}
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Price --}}
                                        @if ($productDetails->price != '' && $productDetails->price > 0)
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                                    Price
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-600 py-1"
                                                    id="productPrice">
                                                    {{ $productDetails->price }}
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Code --}}
                                        @if ($productDetails->code != '')
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                                    Code
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                                    id="productCode">
                                                    {{ $productDetails->code }}
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Made In --}}
                                        <div class="col-lg-12 mb-2 origin">
                                            <div class="bg-indigo-400 text-white rounded-t font-bold py-1">
                                                Made In
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-400 py-1"
                                                id="productOrigin">
                                                {{ $productDetails->brand->country->name ?? 'N/A' }}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer flex justify-around w-50 mx-auto">
                    @can('product-edit-request')
                        <a href="{{ route('user.products.edit', $productDetails->id ?? 100000) }}"
                            class="btn btn-success font-bold"><i class="fas fa-edit fa-fw"></i> &nbsp; Request Edit</a>
                    @endcan
                    @can('product-delete-request')
                        <form action="{{ route('user.products.destroy', $productDetails->id ?? 100000) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger font-bold"><i class="far fa-trash-alt fa-fw"></i>
                                &nbsp; Request Delete</button>
                        </form>
                    @endcan
                    @cannot('product-delete-request')
                        <button type="button" class="btn btn-danger font-bold" data-dismiss="modal">Close</button>
                    @endcannot
                </div>
            </div>
        </div>
    </div>
    <!-- End Details Modal -->
</div>
