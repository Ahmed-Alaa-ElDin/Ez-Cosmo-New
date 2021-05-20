<div>
    <div class="flex justify-center">
        <div>
            <a href="{{ route('admin.products.export') }}" class="btn btn-success btn-sm font-bold"><i class="far fa-file-excel"></i> &nbsp; Excel</a>
        </div>
    </div>
    <div class="flex justify-between my-2">
        <div class="form-inline">
            Show &nbsp;
            <select  wire:model='perPage' class="form-control pr-4 text-sm">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            &nbsp; entries
        </div>
        <div>
            <input wire:model.debounce.300ms="search"  placeholder="Search Products ..." class="form-control" >
        </div>
    </div>
    <table id="products" class="table table-bordered w-100 text-center">
        <thead class="bg-primary text-white align-middle">
            <tr>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('name')">Name &nbsp
                @include('partials._sort_icon', ['field' => 'name'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('form_name')">Form &nbsp
                @include('partials._sort_icon', ['field' => 'form_name'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('volume')">Volume &nbsp
                @include('partials._sort_icon', ['field' => 'volume'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('price')">Price &nbsp
                @include('partials._sort_icon', ['field' => 'price'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('line_name')">Line &nbsp
                @include('partials._sort_icon', ['field' => 'line_name'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('brand_name')">Brand &nbsp
                @include('partials._sort_icon', ['field' => 'brand_name'])</th>
                <th class="align-middle cursor-pointer" wire:click = "sortBy('category_name')">Category &nbsp
                @include('partials._sort_icon', ['field' => 'category_name'])</th>
                <th class="align-middle">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($products as $product)
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
                        <button type="button" class="btn btn-sm btn-primary font-bold detailsButton"
                            data-name='{{ $product->name }}' data-id='{{ $product->id }}'
                            data-toggle="modal" data-target="#DetailsModal"><i class="far fa-eye"></i></button>
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="btn btn-sm btn-info font-bold"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger font-bold deleteButton"
                            data-name='{{ $product->name }}' data-id='{{ $product->id }}'
                            data-toggle="modal" data-target="#DeleteModal"><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light text-primary align-middle">
            <tr>
                <th>Name</th>
                <th>Form</th>
                <th>Volume</th>
                <th>Price</th>
                <th>Line</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>

    <div class="flex justify-between">
        <div>
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
        </div>
        <div>
            {{ $products->links() }}
        </div>

    </div>




</div>
