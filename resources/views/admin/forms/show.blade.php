@extends('layouts.master')

@section('style')
<style>
    *:focus {
        outline: 0 !important;
    }

    .carousel-control-next {
        right: -35px;
    }

    .carousel-control-prev {
        left: -35px;
    }

    .carousel-indicators {
        bottom: -10px;
    }

    ol.carousel-indicators li,
    ol.carousel-indicators li.active {
        height: 7px;
        width: 7px;
        margin: 0 5px;
        border-radius: 50%;
        border: 0;
        background: #c2c2c2;
    }

    ol.carousel-indicators li.active {
        background: #000;
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
        margin: 50px 0;
        padding: 10px 10px;
        border: 1px solid #eee;
        background: #f9f9f9;
    }

    .success-box img {
        margin-right: 10px;
        display: inline-block;
        vertical-align: top;
    }

    .success-box>div {
        vertical-align: top;
        display: inline-block;
        color: #888;
    }



    /* Rating Star Widgets Style */
    .rating-stars ul {
        text-align: left;
        list-style-type: none;
        padding: 0;

        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
        display: inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
        font-size: 0.8em;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    .rating-stars ul.new>li.star>i.fa {
        font-size: 1.2em;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
        color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
        color: #FF912C;
    }

</style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class="mt-2">
            Products in a {{ $form->name }} form
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.forms.index') }}"
                class="btn btn-primary font-bold inline-block items-center relative block pl-8"><i
                    class="fas fa-backward fa-xs absolute top-3 left-3"></i> Back To Forms</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <livewire:admin.forms-product-data-table :formID="$form->id" :formName="$form->name" />
            </div>
        </div>
    </section>

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
                                                        <ul class="text-left w-100" id="productIndication">

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
@endsection

@section('script')

    {{-- Activating tooltip --}}
    $('[data-toggle="tooltip"]').tooltip()


    {{-- Rating Stars --}}

    $('body').on('mouseover', ('.stars.new li'), function(){

        var onStar = parseInt($(this).data('value'), 10);

        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) { $(this).addClass('hover'); 
            } else {
                $(this).removeClass('hover'); 
            } 
        }); 
    }).on('mouseout',('.stars.new li'), function(){ 
        $(this).parent().children('li.star').each(function(e){ 
            $(this).removeClass('hover'); 
        }); 
    });
        
        {{-- Deleted Product Success Toaster --}} 
    
        window.livewire.on('success', data=> {
        toastr.success(data['message']);
        });

        {{-- Deleted Review Success Toaster --}}
        window.livewire.on('modalOpen', data => {
        setTimeout(function(){
        $('body').addClass('modal-open');
        }, 500);
        });

        @if (session('success'))
            toastr.success('{{ session('success') }}')
        @endif


    @endsection

