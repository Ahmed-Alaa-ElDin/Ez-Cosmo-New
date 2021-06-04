@extends('layouts.master')

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
        <h1>
            {{$user->first_name . ' ' . $user->last_name . ' Profile'}}
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.users.edit', $user->id) }}"
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
                    <div class="col-lg-12 px-3 mb-3 border-l-2 border-gray-100 flex justify-center">
                        <div id="userImages" style="height: 100%; width: 20%">
                            <img src="{{asset("images/$user->profile_photo")}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-white rounded-xl py-3">

                            <div class="row">

                                {{-- Other Details 1 --}}
                                <div class="col-lg-12">
                                    <div class="row">

                                        {{-- Country --}}
                                        <div class="col-lg-12 mb-2">
                                            <div class="row">
                                                <div
                                                    class="col-lg-3 bg-gray-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100">Country</span>
                                                </div>
                                                <div
                                                    class="col-lg-9 bg-white rounded-r border-2 border-gray-900 py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100" id="userCountry"> {{$user->country->name ?? 'N/A'}} </span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-lg-12 mb-2">
                                            <div class="row">
                                                <div
                                                    class="col-lg-3 bg-gray-800 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100">Email</span>
                                                </div>
                                                <div
                                                    class="col-lg-9 bg-white rounded-r border-2 border-gray-800 py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100" id="userEmail"> {{$user->email}}  {!! $user->email_verified_at ? "<small class='text-green-500 font-bold'>(Verified)</small>" : "<small class='text-red-500 font-bold'>(Not Verified)</small>"!!}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-lg-12 mb-2">
                                            <div class="row">
                                                <div
                                                    class="col-lg-3 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100">Phone</span>
                                                </div>
                                                <div
                                                    class="col-lg-9 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100" id="userPhone"> {{$user->phone}} </span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Gender --}}
                                        <div class="col-lg-12 mb-2">
                                            <div class="row">
                                                <div
                                                    class="col-lg-3 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                    <span class="text-center w-100">Gender</span>
                                                </div>
                                                <div
                                                    class="col-lg-9 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                    <div class="text-center w-100" id="userGender">
                                                        {{$user->gender == 1 ? "Male" : "Female"}}
                                                    </div>
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
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-900 py-1" id="userVisitNum">
                                        {{$user->visit_num}}
                                    </div>
                                </div>

                                {{-- Last Visit Date --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-800 text-center text-white rounded-t font-bold py-1">
                                        Last Visit Date
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-800 py-1" id="userLastVisit">
                                        {{$user->last_visit}}

                                    </div>
                                </div>


                                {{-- Created at --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-700 text-center text-white rounded-t font-bold py-1">
                                        Created at
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-700 py-1" id="userCreatedAt">
                                        {{$user->created_at}}
                                    </div>
                                </div>

                                {{-- Last Updated --}}
                                <div class="col-lg-6 mb-2">
                                    <div class="bg-indigo-600 text-center text-white rounded-t font-bold py-1">
                                        Last Updated at
                                    </div>
                                    <div class="bg-white rounded-b text-center border-2 border-indigo-600 py-1" id="userLastUpdatedAt">
                                        {{$user->updated_at}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-danger font-bold deleteButton"
                        data-toggle="modal" data-target="#DeleteModal">Remove My Account</button>
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
