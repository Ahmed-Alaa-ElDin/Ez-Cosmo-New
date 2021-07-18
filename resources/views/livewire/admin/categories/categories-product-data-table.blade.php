<div>

    {{-- Search , Export --}}
    <div class="flex justify-center">
        <div>
            <a href="{{ route('admin.categoriesproduct.exportExcel', $categoryID) }}"
                class="btn btn-success btn-sm font-bold"><i class="fas fa-file-excel"></i> &nbsp; Excel</a>
            <a href="{{ route('admin.categoriesproduct.exportPDF', $categoryID) }}"
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
                        <div class="min-w-max">
                            <button type="button" class="btn btn-sm btn-primary font-bold detailsButton" data-toggle="modal"
                                data-target="#DetailsModal"
                                wire:click="$emit('setProductId', {{ $product->id ?? 0 }})"><i
                                    class="far fa-eye"></i></button>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-info font-bold"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger font-bold deleteButton" data-toggle="modal"
                                data-target="#DeleteModal"><i class="fas fa-trash-alt"
                                wire:click="load({{ $product->id }},'{{ $product->name }}')"></i></button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        There's No Products in <span class='font-bold'>"{{ $formName }}"</span> Form
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
    @livewire('common.product-details', [
    'color' => 'primary',
    'textColor' => 'white'
    ])
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
