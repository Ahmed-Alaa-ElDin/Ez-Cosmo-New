<div>
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

    <table id="products" class="table table-bordered w-100 text-center">
        <thead class="bg-primary text-white align-middle">
            <tr>
                <th class="align-middle cursor-pointer" wire:click="sortBy('products.name')">Name &nbsp;
                    @include('partials._sort_icon', ['field' => 'products.name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('edited_products.request_type')">Status
                    &nbsp;
                    @include('partials._sort_icon', ['field' => 'edited_products.request_type'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('users.first_name')">Created By &nbsp;
                    @include('partials._sort_icon', ['field' => 'users.first_name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('edited_products.created_at')">Date &nbsp;
                    @include('partials._sort_icon', ['field' => 'edited_products.created_at'])</th>

                <th class="align-middle">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @forelse ($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->name }}</td>
                    <td
                        class="align-middle font-bold {{ $product->request_type == 1 ? 'text-primary' : 'text-danger' }}">
                        {{ $product->request_type == 1 ? 'Edited' : 'Deleted' }}
                    </td>
                    <td class="align-middle">{{ $product->editor->first_name . ' ' . $product->editor->last_name }}
                    </td>
                    <td class="align-middle">{{ date('Y/m/d', strtotime($product->created_at)) }}</td>
                    <td class="align-middle">
                        <div class="min-w-max">
                            @if ($product->request_type == 1)
                                <a href="{{ route('admin.edited_products.show', $product->id) }}"
                                    class="btn btn-sm btn-info font-bold" title="View Edits"><i class="fas fa-edit"></i></a>
                            @elseif($product->request_type == 2)
                                <button type="button" class="btn btn-sm btn-success font-bold deleteButton"
                                    data-toggle="modal" data-target="#DeleteProduct" title="Confirm Deletion"
                                    wire:click="load('{{ $product->id }}')"><i class="fas fa-check fa-fw"></i></button>
                            @endif
                            <button type="button" class="btn btn-sm btn-danger font-bold deleteButton"
                                data-toggle="modal" data-target="#DeleteEdit" title="Ignore Edits"
                                wire:click="load('{{ $product->id }}')"><i class="fas fa-times fa-fw"></i></button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8"> No <strong>Products for Reviewing</strong> till now</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-light text-primary align-middle">
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>

    <div class="flex justify-between">
        <div>
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
            entries
        </div>
        <div>
            {{ $products->links() }}
        </div>
    </div>

    <!-- Delete Edit -->
    <div class="modal fade" id="DeleteEdit" tabindex="-1" role="dialog" aria-labelledby="deleteEditCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="deleteEditCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Ignore this Edit ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger font-bold" data-dismiss="modal"
                        wire:click='ignoreEdit({{ $product_id }})'>Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Edit -->

        <!-- Delete Product -->
        <div class="modal fade" id="DeleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProductCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="deleteProductCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Delete this Product ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger font-bold" data-dismiss="modal"
                        wire:click='deleteProduct({{ $product_id }})'>Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Product -->

</div>
