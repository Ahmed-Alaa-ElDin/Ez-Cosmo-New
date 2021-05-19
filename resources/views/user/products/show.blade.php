@extends('layouts.userMaster')

@section('style')
    {{-- {{dd($user)}} --}}
    <style>
        *:focus {
            outline: 0 !important;
        }

        #DetailsModal .row {
            margin-left: 0;
            margin-right: 0;
        }

    </style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class="mt-2">
            {{ $product->name . '\'s Details' }}
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.users.edit', $product->id) }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-edit fa-xs absolute top-3 left-3"></i> Edit Profile</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    {{-- Images --}}
                    <div class="col-lg-6 px-3 mb-3 border-l-2 border-gray-100 flex justify-center">
                        <div id="userImages" style="height: 100%; width: 20%">
                            <img src="{{ asset('images/') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-white rounded-xl py-3">

                            <div class="row">
                                <div class="col-lg-8 pl-3">
                                    <div class="bg-white rounded-xl py-3">

                                        <div class="row">

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
                                                                <span class="text-center w-100" id="productCategory">
                                                                </span>
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
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productIngredient">

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
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productDirections">

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
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productNotes">

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
                                                                <span class="inline-block w-100 text-left"
                                                                    id="productAdvantages">

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Disadvantages --}}
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
                                                <div class="bg-white rounded-b border-2 border-indigo-900 py-1"
                                                    id="productForm">

                                                </div>
                                            </div>

                                            {{-- Volume --}}
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                                    Vol. | Wt.
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                                    id="productVolume">

                                                </div>
                                            </div>

                                            {{-- Units --}}
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                                    Units
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-700 py-1"
                                                    id="productUnits">

                                                </div>
                                            </div>

                                            {{-- Price --}}
                                            <div class="col-lg-6 mb-2 origin">
                                                <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                                    Price
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-600 py-1"
                                                    id="productPrice">

                                                </div>
                                            </div>

                                            {{-- Code --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                                    Code
                                                </div>
                                                <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                                    id="productCode">

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pr-3 pl-1">
                        <div class="bg-white rounded-xl p-3">
                            <div class="row">

                                {{-- Visits Number --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-900 text-center text-white rounded-t font-bold py-1">
                                        Number of Visits
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-900 py-1"
                                        id="userVisitNum">

                                    </div>
                                </div>

                                {{-- Last Visit Date --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-800 text-center text-white rounded-t font-bold py-1">
                                        Last Visit Date
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-800 py-1"
                                        id="userLastVisit">


                                    </div>
                                </div>


                                {{-- Created at --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-700 text-center text-white rounded-t font-bold py-1">
                                        Created at
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-700 py-1"
                                        id="userCreatedAt">

                                    </div>
                                </div>

                                {{-- Last Updated --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-600 text-center text-white rounded-t font-bold py-1">
                                        Last Updated at
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-600 py-1"
                                        id="userLastUpdatedAt">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-danger font-bold deleteButton" data-toggle="modal"
                            data-target="#DeleteModal">Remove My Account</button>
                    </div>
                </div>

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
    <!-- End Delete Modal -->


@endsection

@section('script')

    {{-- Click Delete Button --}}
    $('.deleteButton').on('click', function() {
    $('#deletedItemName').text($(this).data('name'));
    $('#deleteForm').attr("action", '/users/' + $(this).data('id'));
    });

    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif

@endsection
