<div>
    {{-- Search , Export --}}
    <div class="flex justify-center">
        <div>
            <a href="{{ route('admin.brandsline.exportExcel', $brand ) }}" class="btn btn-success btn-sm font-bold"><i
                    class="fas fa-file-excel"></i> &nbsp; Excel</a>
            <a href="{{ route('admin.brandsline.exportPDF', $brand ) }}" class="btn btn-danger btn-sm font-bold"><i
                    class="fas fa-file-pdf"></i> &nbsp; PDF</a>
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
            <input wire:model.debounce.300ms="search" placeholder="Search Lines ..." class="form-control">
        </div>
    </div>
    {{-- Search , Export --}}


    {{-- Brands'line DataTable --}}
    <table id="lines" class="table table-bordered w-100 text-center">
        <thead class="bg-primary text-white align-middle">
            <tr>
                <th class="align-middle cursor-pointer" wire:click="sortBy('name')">Name &nbsp;
                    @include('partials._sort_icon', ['field' => 'name'])
                </th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('brand_name')">Brand &nbsp;
                    @include('partials._sort_icon', ['field' => 'brand_name'])</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @forelse ($lines as $line)
                <tr>
                    <td class="align-middle">{{ $line->name }}</td>
                    <td class="align-middle">{{ $line->brand->name }}</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.lines.show', $line->id) }}"
                            class="btn btn-sm btn-primary font-bold"><i class="far fa-eye mr-2"></i> Products</a>
                        <a href="{{ route('admin.lines.edit', $line->id) }}" class="btn btn-sm btn-info font-bold"><i
                                class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger font-bold deleteButton" data-toggle="modal"
                            data-target="#DeleteModal" wire:click="load({{ $line->id }},'{{ $line->name }}')"><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"> No Lines in this Brand</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-light text-primary align-middle">
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
    {{-- Brands'line DataTable --}}

    {{-- pagination Controller --}}
    <div class="flex justify-between">
        <div>
            Showing {{ $lines->firstItem() }} to {{ $lines->lastItem() }} of {{ $lines->total() }}
            entries
        </div>
        <div>
            {{ $lines->links() }}
        </div>
    </div>
    {{-- pagination Controller --}}


    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Delete '<span id="deletedItemName" class="font-bold">{{ $line_name }}</span>' ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger font-bold" data-dismiss="modal"
                        wire:click='deleteLine({{ $line_id }})'>Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

</div>
