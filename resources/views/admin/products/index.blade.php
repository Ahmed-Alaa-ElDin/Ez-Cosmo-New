@extends('layouts.master')

@section('products')
    active
@endsection

@section('all-products')
    active
@endsection

@section('style')
    {{-- Slick --}}
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick-theme.css') }}">
    <style>
        .slick-dots {
            bottom: auto;
        }

        *:focus {
            outline: 0 !important;
        }

        .slick-arrow::after,
        .slick-arrow::before {
            color: black
        }

        .slick-dots li {
            margin: 0!important;
            width: 15px!important;
        }

        #DetailsModal .row {
            margin-left: 0;
            margin-right: 0;
        }

        #productIndication li {
            list-style: square;
        }

        /* Rating */
        .success-box {
            margin:50px 0;
            padding:10px 10px;
            border:1px solid #eee;
            background:#f9f9f9;
        }

        .success-box img {
            margin-right:10px;
            display:inline-block;
            vertical-align:top;
        }

        .success-box > div {
            vertical-align:top;
            display:inline-block;
            color:#888;
        }



        /* Rating Star Widgets Style */
        .rating-stars ul {
            text-align: left;
            list-style-type:none;
            padding:0;
            
            -moz-user-select:none;
            -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
            display:inline-block;
        
        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size:0.8em; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
        }

        .rating-stars ul.new > li.star > i.fa {
            font-size:1.2em; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
            .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C;
        }

    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1>
            All Products
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.products.create') }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-plus fa-xs absolute top-3 left-3"></i> Create New Product</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <div id="buttonPlacement" class="mb-3 text-center"></div>
                <table id="products" class="table table-bordered w-100 text-center">
                    <thead class="bg-primary text-white align-middle">
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
                                        data-toggle="modal" data-target="#DeleteModal"><i class="fas fa-trash-alt"></i></button>
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
            </div>
        </div>

    </section>

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
                    Are You Sure, You Want To Delete '<span id="deletedItemName" class="font-bold"></span>' ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger font-bold">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

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

                                    </div>

                                    {{-- Images --}}
                                    <div class="col-lg-6 px-5 mb-3 border-l-2 border-gray-100">
                                        <div id="productImages" style="height: 100%">

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
                                                        <span class="text-center w-100" id="productCategory"> </span>
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
                                                        <span class="text-center w-100" id="productBrand"> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Line --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Line</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="productLine"> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Indications --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Indications</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                        <ul class="text-left w-100 ml-3" id="productIndication">

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Other Details 1 --}}
                                    <div class="col-lg-12">
                                        <div class="row">


                                            {{-- Ingredients --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 bg-blue-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                        <div class="self-center text-center w-100">Ingredients</div>
                                                    </div>
                                                    <div
                                                        class="col-lg-9 bg-white rounded-r border-2 border-blue-900 py-1 overflow-hidden flex items-center">
                                                        <span class="inline-block w-100 text-left" id="productIngredient">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Directions --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 bg-blue-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                        <div class="self-center text-center w-100">Directions</div>
                                                    </div>
                                                    <div
                                                        class="col-lg-9 bg-white rounded-r border-2 border-blue-700 py-1 overflow-hidden flex items-center">
                                                        <span class="inline-block w-100 text-left" id="productDirections">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Notes --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 bg-blue-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                        <div class="self-center text-center w-100">Notes</div>
                                                    </div>
                                                    <div
                                                        class="col-lg-9 bg-white rounded-r border-2 border-blue-600 py-1 overflow-hidden flex items-center">
                                                        <span class="inline-block w-100 text-left" id="productNotes">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Advantages --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 bg-green-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                        <div class="self-center text-center w-100">Advantages</div>
                                                    </div>
                                                    <div
                                                        class="col-lg-9 bg-white rounded-r border-2 border-green-600 py-1 overflow-hidden flex items-center">
                                                        <span class="inline-block w-100 text-left" id="productAdvantages">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Disadvantages --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 bg-red-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-stretch">
                                                        <div class="self-center text-center w-100">Disadvantages</div>
                                                    </div>
                                                    <div
                                                        class="col-lg-9 bg-white rounded-r border-2 border-red-600 py-1 overflow-hidden flex items-center">
                                                        <span class="inline-block w-100 text-left"
                                                            id="productDisadvantages">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Reviews --}}
                                            <div class="col-lg-12 mb-2">
                                                <x-review>
                                                </x-review>
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
                                        <div class="bg-white rounded-b border-2 border-indigo-900 py-1" id="productForm">

                                        </div>
                                    </div>

                                    {{-- Volume --}}
                                    <div class="col-lg-6 mb-2 origin">
                                        <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                            Vol. | Wt.
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-800 py-1" id="productVolume">

                                        </div>
                                    </div>

                                    {{-- Units --}}
                                    <div class="col-lg-6 mb-2 origin">
                                        <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                            Units
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-700 py-1" id="productUnits">

                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-lg-6 mb-2 origin">
                                        <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                            Price
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-600 py-1" id="productPrice">

                                        </div>
                                    </div>

                                    {{-- Code --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                            Code
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-500 py-1" id="productCode">

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
    <!-- End Details Modal -->



@endsection

@section('script')

    var userId = {{auth()->user()->id}};
    console.log(userId); 


    $('[data-toggle="tooltip"]').tooltip()


    {{-- Initialize Slider --}}
    $('#productImages').slick();        

    {{-- Initialize Datatable --}}
    $("#products").DataTable({
        buttons: [{
            extend: 'colvis',
            className: 'bg-info font-bold',
        },
        {
            extend: 'copyHtml5',
            className: 'bg-primary font-bold',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
        },
        {
            extend: 'excelHtml5',
            className: 'bg-success font-bold',
            exportOptions: {
            columns: [0,1,2,3,4,5,6]
        }
        },
        {
            extend: 'pdfHtml5',
            className: 'bg-danger font-bold',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
        },
        {
            extend: 'print',
            className: 'bg-dark font-bold',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
        },
        ]
    }).buttons().container().appendTo(document.getElementById("buttonPlacement"));;

    {{-- Click Delete Button --}}
    $('.deleteButton').on('click', function() {
        $('#deletedItemName').text($(this).data('name'));
        $('#deleteForm').attr("action", '/admin/products/' + $(this).data('id'));
    });

    {{-- Click Details Button --}}
    $('.detailsButton').on('click', function () {

        $('#submitReview').attr('data-id', $(this).attr('data-id'));
        $('#addReview').removeClass('hide');

        $.ajax({
            url: 'products/' + $(this).attr('data-id'),
            method: 'GET',
            success: function (res) {

                {{-- console.log(res.product); --}}

                {{-- Remove old Slider --}}
                $('#productImages').slick("unslick");
                $('.single_slide').remove();
                
                {{-- Get Product's Images --}}
                let images = $.parseJSON(res.product.product_photo);
                
                {{-- Assign Images in Slider --}}
                for (let i = 0; i < images.length; i++) { 
                    $('#productImages').append(`<div class="single_slide"><img src="/images/${images[i]}" style="margin: auto" draggable="false"></div>`);
                }

                {{-- Reinitialize Slider --}}
                setTimeout(()=>{
                    $('#productImages').slick({
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    })
                },100)        

                {{-- Name --}}
                $('#productName').text(res.product.name);

                {{-- Category --}}
                $('#productCategory').text(res.product.category.name);

                {{-- Brand --}}
                $('#productBrand').text(res.product.brand.name);

                {{-- Line --}}
                if (res.product.line != null) {
                    $('#productLine').text(res.product.line.name);
                } else {
                    $('#productLine').parents('.origin').addClass('hide');
                };

                {{-- Indications --}}
                if (res.product.indications.length != 0) {
                    for (let i = 0; i < res.product.indications.length ; i++){ 
                        $('#productIndication').append( `<li class='indication'> ${res.product.indications[i].name} </li>`)
                    }
                } else {
                    $('#productIndication').parents('.origin').addClass('hide');
                }

                {{-- Ingredients --}}
                if (res.product.ingredients.length != 0) {
                    for (let i = 0; i < res.product.ingredients.length ; i++){ 
                        $('#productIngredient').append(`
                        <span>${res.product.ingredients[i].name} <i class="fas fa-question-circle cursor-pointer"  data-toggle="tooltip" data-placement="top" title="${res.product.ingredients[i].pivot.concentration ? res.product.ingredients[i].pivot.concentration + ' | ' : ''}  ${res.product.ingredients[i].pivot.role ? res.product.ingredients[i].pivot.role : 'N/A'}"></i></span>
                        `)
                        if (i < res.product.ingredients.length-1) {
                            $('#productIngredient').append(`
                                <span>, </span>
                            `)
                        } else {
                            $('#productIngredient').append(`
                                <span>.</span>
                            `)
                        }
                    }
                    $('[data-toggle="tooltip"]').tooltip();
                    
                } else {
                    $('#productIngredient').parents('.origin').addClass('hide');
                }

                {{-- Directions --}}
                if (res.product.directions_of_use != null) {
                    $('#productDirections').text(res.product.directions_of_use);
                } else {
                    $('#productDirections').parents('.origin').addClass('hide');
                };

                {{-- Notes --}}
                if (res.product.notes != null) {
                    $('#productNotes').text(res.product.notes);
                } else {
                    $('#productNotes').parents('.origin').addClass('hide');
                };

                {{-- Advantages --}}
                if (res.product.advantages != null) {
                    $('#productAdvantages').text(res.product.advantages);
                } else {
                    $('#productAdvantages').parents('.origin').addClass('hide');
                };

                {{-- Disadvantages --}}
                if (res.product.disadvantages != null) {
                    $('#productDisadvantages').text(res.product.disadvantages);
                } else {
                    $('#productDisadvantages').parents('.origin').addClass('hide');
                };

                {{-- Form --}}
                $('#productForm').text(res.product.form.name);

                {{-- Volume --}}
                if (res.product.volume > 0) {
                    $('#productVolume').text(res.product.volume + ' Ml. | Gm.');
                } else {
                    $('#productVolume').parents('.origin').addClass('hide');
                }

                {{-- Units --}}
                if (res.product.units > 1) {
                    $('#productUnits').text(res.product.units);
                } else {
                    $('#productUnits').parents('.origin').addClass('hide');
                }

                {{-- Price --}}
                if (res.product.price > 0) {
                    $('#productPrice').text(res.product.price + ' EGP');
                } else {
                    $('#productPrice').parents('.origin').addClass('hide');
                }

                {{-- Code --}}
                if (res.product.code != null) {
                    $('#productCode').text(res.product.code);
                } else {
                    $('#productCode').parents('.origin').addClass('hide');
                }

                {{-- Review --}}
                if (res.product.reviews.length >= 0) {
                    let reviewsNum = res.product.reviews.length;
                    
                    if (reviewsNum <= 1) {
                        $('#reviewCount').html('<span id="reviewsNum">' + reviewsNum + '</span>' + ' Review');
                    } else {
                        $('#reviewCount').html('<span id="reviewsNum">' + reviewsNum + '</span>' + ' Reviews');
                    };
                    
                    console.log(res.product.reviews);
                    for (let i = 0 ; i < res.product.reviews.length; i++) {
                        let name = res.product.reviews[i].first_name + " " + res.product.reviews[i].last_name;
                        let review = res.product.reviews[i].pivot.review != null ? res.product.reviews[i].pivot.review : "";
                        let score = res.product.reviews[i].pivot.score;
                        let created_at = moment(res.product.reviews[i].pivot.created_at).fromNow();
                        let reviewId = res.product.reviews[i].pivot.id;
                        let deleteReview = userId == res.product.reviews[i].id ? '<button class="btn btn-danger btn-sm font-bold text-sm ml-3 deleteReviewButton" title="Delete Review" data-id=' + reviewId + '><i class="fas fa-minus fa-fw"></i></button>' : ``;
                        console.log(reviewId);
                        
                        switch(score) {
                            case 1:
                                var starsColor = `
                                    <li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>`
                                break;
                            case 2:
                                var starsColor = 
                                    `<li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>`
                                break;
                            case 3:
                                var starsColor =
                                    `<li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>`
                                break;
                            case 4:
                                var starsColor =
                                    `<li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>`
                                break;
                            case 5:
                                var starsColor =
                                    `<li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star selected' title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>`
                                break;
                        }
                        
                        $('#reviews').prepend(`
                            <hr>
                            <div class="p-2 reviewParent">
                                <div class="flex justify-between">
                                    <div class="userName font-bold">
                                        ` + name + `
                                    </div>
                                    <div class="reviewDate text-gray-400 font-bold text-sm">
                                        ` + created_at + deleteReview + `
                                    </div>
                                </div>
                                <div class='rating-stars text-center'>
                                    <ul class="stars">
                                        ` + starsColor + `
                                    </ul>
                                </div>
                                <div class="reviewText my-2">
                                    ` + review + `
                                </div>
                            </div>
                        `)
                    }
                } else {
                    $('#reviewCount').html('<span id="reviewsNum">' + 0 + '</span>' + ' Review');
                }

            },

            {{-- Handiling Errors By Reload Page --}}
            error: function () {
                window.location = '{{route('admin.products.index')}}';
            }

        })

    })

    {{-- Erase Data After Modal Close  --}}
    $('#DetailsModal').on('hidden.bs.modal', function() {
        $('#productName, #productCategory, #productBrand, #productLine, #productIndication, #productIngredient, #productDirections, #productNotes, #productAdvantages, #productDisadvantages, #productForm, #productVolume, #productUnits, #productPrice, #productCode, #reviews').html('');
        $('.origin').removeClass('hide');
    })

    {{-- Rating Stars --}}
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('.stars.new li').on('mouseover', function(){
      var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
     
      // Now highlight all the stars that's not after the current hovered star
      $(this).parent().children('li.star').each(function(e){
        if (e < onStar) {
          $(this).addClass('hover');
        }
        else {
          $(this).removeClass('hover');
        }
      });
      
    }).on('mouseout', function(){
      $(this).parent().children('li.star').each(function(e){
        $(this).removeClass('hover');
      });
    });
    
    
    /* 2. Action to perform on click */
    $('.stars.new li').on('click', function(){
      var onStar = parseInt($(this).data('value'), 10); // The star currently selected
      var stars = $(this).parent().children('li.star');
      
      for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
      }
      
      for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
      }
            
    });

    {{-- Add New Review --}}
    $('#addReview').on('click', function(){
        $('.NewReviewDiv').removeClass('hide');
        $(this).addClass('hide');
    });

    $('#submitReview').on('click', function(){
        let score = $(this).parents('.NewReviewDiv').find('.star.selected').length;
        let review = $(this).siblings('input').val();
        let user_id = {{Auth::id()}};
        let product_id = $(this).attr('data-id');

        if ($(this).parents('.NewReviewDiv').find('.star.selected').length > 0) {
            $.ajax({
                url : '{{route('admin.reviews.store')}}',
                method : 'POST',
                data : {
                    '_token' :'{{csrf_token()}}',
                    'user_id' : user_id,
                    'product_id' : product_id,
                    'score' : score,
                    'review' : review 
                },
                success: function (res) {
                    toastr.success(res.success);

                    $('#submitReview').parents('.NewReviewDiv').find('.star.selected').removeClass('selected');
                    $('#submitReview').parents('.NewReviewDiv').find('.star').css('-webkit-text-stroke','0');
                    $('#submitReview').siblings('input').val('');
                    $('#reviewWarning').addClass('hide');
                    $('.NewReviewDiv').addClass('hide');
                    if ($('#reviewsNum').text() > 1) {
                        $('#reviewCount').html('<span id="reviewsNum">' + (parseInt($('#reviewsNum').text()) + 1) + '</span>' + ' Reviews');
                    } else {
                        $('#reviewCount').html('<span id="reviewsNum">' + (parseInt($('#reviewsNum').text()) + 1) + '</span>' + ' Review');
                    };
                    console.log(res.id);

                    switch(score) {
                        case 1:
                            var starsColor = `
                                <li class='star selected' title='1' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='2' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='3' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='4' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='5' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>`
                            break;
                        case 2:
                            var starsColor = 
                                `<li class='star selected' title='1' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='2' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='3' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='4' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='5' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>`
                            break;
                        case 3:
                            var starsColor =
                                `<li class='star selected' title='1' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='2' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='3' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='4' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='5' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>`
                            break;
                        case 4:
                            var starsColor =
                                `<li class='star selected' title='1' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='2' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='3' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='4' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='5' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>`
                            break;
                        case 5:
                            var starsColor =
                                `<li class='star selected' title='1' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='2' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='3' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='4' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' title='5' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>`
                            break;
                    }
                    
                    $('#reviews').prepend(`
                        <hr>
                        <div class="p-2 reviewParent">
                            <div class="flex justify-between">
                                <div class="userName font-bold">
                                    ` + '{{Auth::user()->first_name}}' + `
                                </div>
                                <div class="reviewDate text-gray-400 font-bold text-sm">
                                    ` + moment('{{now()}}').fromNow() + `
                                    <button class="btn btn-danger btn-sm font-bold text-sm ml-3 deleteReviewButton" title="Delete Review" data-id=` + res.id + `><i class="fas fa-minus fa-fw"></i></button>
                                </div>
                            </div>
                            <div class='rating-stars text-center'>
                                <ul class="stars">
                                    ` + starsColor + `
                                </ul>
                            </div>
                            <div class="reviewText my-2">
                                ` + review + `
                            </div>
                        </div>
                    `)

                }
            });
        } else {
            $(this).parents('.NewReviewDiv').find('.star').css('-webkit-text-stroke','1px red');
            $('#reviewWarning').removeClass('hide');
        };

    });

    {{-- Remove Review --}}
    $('body').on('click','.deleteReviewButton', function () {
        let thisButton = $(this);
        $.ajax({
            url : '{{route('admin.reviews.delete')}}',
            method : 'DELETE',
            data : {
                '_token' :'{{csrf_token()}}',
                'review_id' : $(this).attr('data-id'),
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.success);
                    thisButton.parents('.reviewParent').remove();
                    if ($('#reviewsNum').text() > 2) {
                        $('#reviewCount').html('<span id="reviewsNum">' + ($('#reviewsNum').text() - 1) + '</span>' + ' Reviews');
                    } else {
                        $('#reviewCount').html('<span id="reviewsNum">' + ($('#reviewsNum').text() - 1) + '</span>' + ' Review');
                    };
                }
            }
        })

    })
    
    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif

@endsection
