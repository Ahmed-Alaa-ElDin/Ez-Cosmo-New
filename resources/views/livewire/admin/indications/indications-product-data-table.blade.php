<div>

    {{-- Search , Export --}}
    <div class="flex justify-center">
        <div>
            <a href="{{ route('admin.indicationsproduct.exportExcel', $indicationID) }}"
                class="btn btn-success btn-sm font-bold"><i class="fas fa-file-excel"></i> &nbsp; Excel</a>
            <a href="{{ route('admin.indicationsproduct.exportPDF', $indicationID) }}"
                class="btn btn-danger btn-sm font-bold"><i class="fas fa-file-pdf"></i> &nbsp; PDF</a>
        </div>
    </div>
    <div class="flex justify-between my-2">
        <div class="form-inline">
            Show &nbsp;
            <select wire:model='perPage' class="form-control pr-4 text-sm">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            &nbsp; entries
        </div>
        <div>
            <input wire:model.debounce.300ms="search" placeholder="Search Products ..." class="form-control">
        </div>
    </div>
    {{-- Search , Export --}}

    <table class="table table-bordered w-100 text-center">
        <thead class="bg-primary text-white align-middle">
            <tr>
                <th class="align-middle cursor-pointer" wire:click="sortBy('name')">Name &nbsp;
                    @include('partials._sort_icon', ['field' => 'name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('form_name')">Form &nbsp;
                    @include('partials._sort_icon', ['field' => 'form_name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('volume')">Volume &nbsp;
                    @include('partials._sort_icon', ['field' => 'volume'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('price')">Price &nbsp;
                    @include('partials._sort_icon', ['field' => 'price'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('line_name')">Line &nbsp;
                    @include('partials._sort_icon', ['field' => 'line_name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('brand_name')">Brand &nbsp;
                    @include('partials._sort_icon', ['field' => 'brand_name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('category_name')">Category &nbsp;
                    @include('partials._sort_icon', ['field' => 'category_name'])</th>
                <th class="align-middle">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @forelse ($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->name }}</td>
                    <td class="align-middle">{{ $product->form->name }}</td>
                    <td class="align-middle">{{ $product->volume }}</td>
                    <td class="align-middle">{{ number_format($product->price, 2) }}</td>
                    <td class="align-middle">{{ $product->line ? $product->line->name : 'N/A' }}</td>
                    <td class="align-middle">
                        {{ $product->line ? $product->line->brand->name : $product->brand->name }}</td>
                    <td class="align-middle">{{ $product->category->name }}</td>
                    <td class="align-middle">
                        <button type="button" class="btn btn-sm btn-primary font-bold detailsButton" data-toggle="modal"
                            data-target="#DetailsModal"
                            wire:click="load({{ $product->id }},'{{ $product->name }}')"><i
                                class="far fa-eye"></i></button>
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="btn btn-sm btn-info font-bold"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger font-bold deleteButton" data-toggle="modal"
                            data-target="#DeleteModal"><i class="fas fa-trash-alt"
                                wire:click="load({{ $product->id }},'{{ $product->name }}')"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        There's No Products Contain <span class='font-bold'>" {{ $indicationName }} "</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-light text-primary align-middle">
            <tr>
                <th class="align-middle">Name</th>
                <th class="align-middle">Form</th>
                <th class="align-middle">Volume</th>
                <th class="align-middle">Price</th>
                <th class="align-middle">Line</th>
                <th class="align-middle">Brand</th>
                <th class="align-middle">Category</th>
                <th class="align-middle">Actions</th>
            </tr>
        </tfoot>
    </table>

    {{-- pagination Controller --}}
    <div class="flex justify-between">
        <div>
            Showing {{ $products->firstItem() ?? '0' }} to {{ $products->lastItem() }} of
            {{ $products->total() }}
            entries
        </div>
        <div>
            {{ $products->links() }}
        </div>
    </div>
    {{-- pagination Controller --}}

    <!-- Details Modal -->
    <div class="modal fade bd-example-modal-xl" id="DetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="datailsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white font-bold">
                    <h5 class="modal-title" id="datailsModalCenterTitle">Product's Details</h5>
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
                                                @if ($images)
                                                    @foreach (json_decode($images) as $image)
                                                        <li data-target="#carouselExampleFade"
                                                            data-slide-to="{{ $loop->index }}" class="
                                                        @if ($loop->first) active @endif">
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ol>
                                            <div class="carousel-inner">
                                                @if ($images)
                                                    @foreach (json_decode($images) as $image)
                                                        <div class="carousel-item @if ($loop->
                                                            first) active @endif">
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
                                            @if ($line != '')
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
                                                                    <li class='indication'> {{ $indication->name }}
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
                                            @if ($indications && !empty($indications->toArray()))
                                                <div class="col-lg-12 mb-2 origin">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-3 bg-blue-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                            <div class="self-center text-center w-100">Ingredients</div>
                                                        </div>
                                                        <div
                                                            class="col-lg-9 bg-white rounded-r border-2 border-blue-900 py-1 overflow-hidden flex items-center">
                                                            <span class="inl@ine-block w-100 text-left"
                                                                id="productIngredient">
                                                                @foreach ($indications as $indication)
                                                                    <span> {{ $indication->name }}
                                                                        <i class="fas fa-question-circle cursor-pointer"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title=' @if ($indication->pivot && $indication->pivot->concentration != '') {{ $indication->pivot->concentration }} @endif @if ($indication->pivot && $indication->pivot->concentration != '' && $indication->pivot->role != '') {{ '|' }} @endif @if ($indication->pivot && $indication->pivot->role != '') {{ $indication->pivot->role }} @endif'>
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
                                            @if ($directions != '')
                                                <div class="col-lg-12 mb-2 origin">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-3 bg-blue-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                            <div class="self-center text-center w-100">Directions</div>
                                                        </div>
                                                        <div
                                                            class="col-lg-9 bg-white rounded-r border-2 border-blue-700 py-1 overflow-hidden flex items-center">
                                                            <span class="inline-block w-100 text-left"
                                                                id="productDirections">
                                                                {{ $directions }}
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
                                                            <div class="self-center text-center w-100">Advantages</div>
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
                                            <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                                Vol. | Wt.
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                                id="productVolume">
                                                {{ $volume }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Units --}}
                                    @if ($units != '' && $units > 1)
                                        <div class="col-lg-6 mb-2 origin">
                                            <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                                Units
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-700 py-1"
                                                id="productUnits">
                                                {{ $units }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Price --}}
                                    @if ($price != '' && $price > 0)
                                        <div class="col-lg-6 mb-2 origin">
                                            <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                                Price
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-600 py-1"
                                                id="productPrice">
                                                {{ $price }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Code --}}
                                    @if ($code != '')
                                        <div class="col-lg-12 mb-2 origin">
                                            <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                                Code
                                            </div>
                                            <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                                id="productCode">
                                                {{ $code }}
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
                                            {{ $origin }}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex justify-center">
                    <button type="button" class="btn btn-danger font-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Details Modal --}}

    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="deleteModalCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Delete '<span id="deletedItemName"
                        class="font-bold">{{ $product_name }}</span>' ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger font-bold" data-dismiss="modal"
                        wire:click='deleteProduct({{ $product_id }})'>Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

</div>
