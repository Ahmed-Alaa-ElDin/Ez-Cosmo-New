<div>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            {{-- Admin Dashboard --}}
            @admin()
            <li class="@yield(" admin-home")">
                <a href="/admin"><i class="fas fa-tachometer-alt fa-fw"></i> <span class="ml-2"> Admin Dashboard
                    </span></a>
            </li>
            @endadmin

            {{-- Search Area --}}
            <li class="active overflow-hidden">
                <div class="w-100">
                    <i class="fas fa-search fa-fw absolute left-4 top-4 text-gray-300"></i>
                    <input type="text" wire:model.debounce.300ms='search' placeholder="Search ..."
                        class="pl-5 bg-gray-900 border-0 h-12 text-gray-300 placeholder-gray-300">
                    <div class="text-center text-gray-200 max-w-md mt-2">
                        <small>You can use <span class="text-blue-400">*</span> or <span class="text-blue-400">%</span>
                            instead of <br> letters if you are uncertain</small>
                    </div>
                </div>

                <div class="bg-gray-900 text-white px-3 py-2 mt-3 font-bold flex justify-between">
                    <span class="self-center">
                        <i class="fas fa-filter fa-fw text-sm"></i> <span class="ml-2 text-sm">Filters</span>
                    </span>
                    <span class="btn btn-danger btn-sm font-bold text-sm" wire:click='clearFilter'>Clear</span>
                </div>
                <div class="">
                    {{-- Choose Category --}}
                    <div class="py-2 pr-2 text-center text-white px-1" wire:ignore>
                        <label class="block font-bold text-sm" for="categories">Category</label>
                        <select id="categories" wire:model='categoryID' class="singleDrop form-control">
                            <option value="" selected>Choose Category</option>
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- Choose Category --}}

                    <hr>

                    {{-- Choose Brand --}}
                    <div class="py-2 pr-2 text-center text-white px-1">
                        <label class="block font-bold text-sm" for="brands">Brand</label>
                        <select id="brands" wire:model='brandID' class="singleDrop form-control">
                            <option value="" selected>Choose Brand</option>
                            @if ($brands)
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- Choose Brand --}}

                    <hr>

                    {{-- Choose Line --}}
                    <div class="py-2 pr-2 text-center text-white px-1" style="display: none" id="lineDiv"
                        wire:ignore.self>
                        <label class="block font-bold text-sm" for="lines">Line</label>
                        <select id="lines" wire:model='lineID' class="singleDrop form-control text-center">
                            <option class="text-center" value="" selected>Choose Line</option>
                            @if ($lines)
                                @foreach ($lines as $line)
                                    <option value="{{ $line->id }}">{{ $line->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- Choose Line --}}

                    <hr style="display: none" id="lineHr" wire:ignore>

                    {{-- Choose Form --}}
                    <div class="py-2 pr-2 text-center text-white px-1">
                        <label class="block font-bold text-sm" for="forms">Form</label>
                        <select id="forms" wire:model='formID' class="singleDrop form-control">
                            <option value="" selected>Choose Form</option>
                            @if ($forms)
                                @foreach ($forms as $form)
                                    <option value="{{ $form->id }}">{{ $form->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- Choose Form --}}

                    <hr>

                    {{-- Choose price --}}
                    <div class="py-2 pr-2 text-center text-white px-1" wire:ignore.self>
                        <label class="block font-bold text-sm mb-0" for="prices">Price</label>
                        <div class="flex justify-between">
                            <div>
                                <label for="priceFrom" class="text-sm mb-0">From</label>
                                <input type="number" min="{{ $priceFrom }}" max="{{ $priceTo }}"
                                    wire:model.lazy="priceFrom" class="form-control w-20 text-center rounded">
                            </div>
                            <div>
                                <label for="priceTo" class="text-sm mb-0">To</label>
                                <input type="number" min="{{ $priceFrom }}" max="{{ $priceTo }}"
                                    wire:model.lazy="priceTo" class="form-control w-20 text-center rounded">
                            </div>
                        </div>
                    </div>
                    {{-- Choose price --}}

                    <hr>

                    {{-- Choose Rate --}}
                    <div class="py-2 pr-2 text-center text-white px-1">
                        <label class="block font-bold text-sm" for="prices">Rating</label>
                        <div class="align-left">
                            <label class="inline-block form-check">
                                <input type="radio" wire:model="rating" value='4' class="form-check-input"> &nbsp;
                                <div class='rating-stars inline-block'>
                                    <ul class="stars">
                                        <li class='star selected' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <span class="text-sm text-blue-400">&nbsp;&amp; Up</span>
                                <span class="text-sm font-bold">&nbsp;({{ $rating4 }})</span>
                            </label>
                        </div>

                        <div>
                            <label class="inline-block form-check">
                                <input type="radio" wire:model="rating" value='3' class="form-check-input"> &nbsp;
                                <div class='rating-stars inline-block'>
                                    <ul class="stars">
                                        <li class='star selected' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <span class="text-sm text-blue-400">&nbsp;&amp; Up</span>
                                <span class="text-sm font-bold">&nbsp;({{ $rating3 }})</span>
                            </label>
                        </div>

                        <div>
                            <label class="inline-block form-check">
                                <input type="radio" wire:model="rating" value='2' class="form-check-input"> &nbsp;
                                <div class='rating-stars inline-block'>
                                    <ul class="stars">
                                        <li class='star selected' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star selected' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <span class="text-sm text-blue-400">&nbsp;&amp; Up</span>
                                <span class="text-sm font-bold">&nbsp;({{ $rating2 }})</span>
                            </label>
                        </div>

                        <div>
                            <label class="inline-block form-check">
                                <input type="radio" wire:model="rating" value='1' class="form-check-input"> &nbsp;
                                <div class='rating-stars inline-block'>
                                    <ul class="stars">
                                        <li class='star selected' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <span class="text-sm text-blue-400">&nbsp;&amp; Up</span>
                                <span class="text-sm font-bold">&nbsp;({{ $rating1 }})</span>
                            </label>
                        </div>

                        <div>
                            <label class="inline-block form-check">
                                <input type="radio" wire:model="rating" value='0' class="form-check-input"> &nbsp;
                                <div class='rating-stars inline-block'>
                                    <ul class="stars">
                                        <li class='star' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <span class="text-sm text-blue-400">&nbsp;&amp; Up</span>
                                <span class="text-sm font-bold">&nbsp;({{ $rating0 }})</span>
                            </label>
                        </div>

                    </div>
                    {{-- Choose Rate --}}

                </div>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fab fa-searchengin fa-fw"></i><span class="ml-2">Advanced Search</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield("search-ingredient")"><a href="{{ route('admin.brands.index') }}"><i
                        class="fas fa-pills fa-fw"></i> <span class="ml-2"> Search by Ingredient </span></a></li>
                    <li class="@yield("search-indication")"><a href="{{ route('admin.brands.create') }}"><i
                        class="fas fa-stethoscope fa-fw"></i> <span class="ml-2"> Search by Indication </span></a></li>
                    <li class="@yield("search-country")"><a href="{{ route('admin.brands.create') }}"><i
                        class="fas fa-globe-europe fa-fw"></i> <span class="ml-2"> Search by Country </span></a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->


</div>
