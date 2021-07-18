<div>
    <!-- Details Modal -->
    <div class="modal fade bd-example-modal-xl" id="DetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="datailsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning font-bold">
                    <h5 class="modal-title text-black" id="datailsModalCenterTitle">Product's Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center bg-gray-200 px-1 py-3">
                    <div class="row">
                        <div class="col-lg-8 pl-3">
                            <div class="bg-white rounded-xl py-3">

                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-lg-12 text-center h3 mb-3" id="productName">
                                        {{ $name }}
                                    </div>
                                    {{-- Images --}}
                                    <div class="col-lg-6 px-5 mb-4 border-l-2 border-gray-100">
                                        <div id="carouselExampleFade" class="carousel slide" data-ride="carousel"
                                            data-interval="false">
                                            <ol class="carousel-indicators">
                                                @if ($product_photo)
                                                    @foreach (json_decode($product_photo) as $image)
                                                        <li data-target="#carouselExampleFade"
                                                            data-slide-to="{{ $loop->index }}" class="
                                                @if ($loop->first) active @endif">
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ol>
                                            <div class="carousel-inner">
                                                @if ($product_photo)
                                                    @foreach (json_decode($product_photo) as $image)
                                                        <div class="carousel-item @if ($loop->first) active @endif">
                                                            <img src="{{ asset('images/' . $image) }}"
                                                                class="d-block w-100" alt="{{ $image }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                                data-slide="prev">
                                                <i class="fas fa-arrow-circle-left text-black" aria-hidden="true"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                                data-slide="next">
                                                <i class="fas fa-arrow-circle-right text-black" aria-hidden="true"></i>
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
                                                            {{ $category }} </span>
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
                                                            {{ $brand }} </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Line --}}
                                            @if ($line != null)
                                                <div class="col-lg-12 mb-2 origin">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-5 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100">Line</span>
                                                        </div>
                                                        <div
                                                            class="col-lg-7 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100" id="productLine">
                                                                {{ $line }} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Indications --}}
                                            @if ($indications && !empty($indications->toArray()))
                                                <div class="col-lg-12 mb-2 origin">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-5 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                            <span class="text-center w-100">Indications</span>
                                                        </div>
                                                        <div
                                                            class="col-lg-7 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                            <ul class="text-left w-100 ml-3" id="productIndication">
                                                                @foreach ($indications as $indication)
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
                                            @if ($ingredients && !empty($ingredients->toArray()))
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
                                                                @foreach ($ingredients as $ingredient)
                                                                    <span> {{ $ingredient->name }}
                                                                        <i class="fas fa-question-circle cursor-pointer"
                                                                            data-toggle="tooltip" data-placement="top"
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
                                            @if ($directions_of_use != null)
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
                                                                {{ $directions_of_use }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Notes --}}
                                            @if ($notes != '')
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
                                                                {{ $notes }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Advantages --}}
                                            @if ($advantages != '')
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
                                                                {{ $advantages }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Disadvantages --}}
                                            @if ($disadvantages != '')
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
                                                                {{ $disadvantages }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Reviews --}}
                                            <div class="col-lg-12 mb-2">
                                                @livewire('admin.review', ['product_id' =>
                                                $product_id],key($product_id))
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
                                            {{ $form }}
                                        </div>
                                    </div>

                                    {{-- Volume --}}
                                    @if ($volume != '' && $volume > 0)
                                        <div class="col-lg-6 mb-2 origin">
                                            <div class="bg-indigo-900 text-white rounded-t font-bold py-1">
                                                Vol. | Wt.
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-900 py-1"
                                                id="productVolume">
                                                {{ $volume }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Units --}}
                                    @if ($units != '' && $units > 1)
                                        <div class="col-lg-6 mb-2 origin">
                                            <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                                Units
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                                id="productUnits">
                                                {{ $units }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Price --}}
                                    @if ($price != '' && $price > 0)
                                        <div class="col-lg-6 mb-2 origin">
                                            <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                                Price
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                                id="productPrice">
                                                {{ $price }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Code --}}
                                    @if ($code != '')
                                        <div class="col-lg-12 mb-2 origin">
                                            <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                                Code
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-700 py-1"
                                                id="productCode">
                                                {{ $code }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Made In --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                            Made In
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-600 py-1"
                                            id="productOrigin">
                                            {{ $country ?? 'N/A' }}
                                        </div>
                                    </div>

                                    {{-- Created By --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                            Created By
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                            id="createdBy">
                                            {{ $editor }}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex justify-around w-50 mx-auto">
                    @can('product-edit-request')
                        <a href="{{ route('user.products.edit', $product_id ?? 100000) }}"
                            class="btn btn-success font-bold"><i class="fas fa-edit fa-fw"></i> &nbsp; Request Edit</a>
                    @endcan
                    @can('product-delete-request')
                        <form action="{{ route('user.products.destroy', $product_id ?? 100000) }}" method="POST">
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
