@extends('layouts.master')

@section('users')
    active
@endsection

@section('all-users')
    active
@endsection

@section('style')
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
            All Users
            <small>View</small>
        </h1>
        @can('user-create')
            <div>
                <a href="{{ route('admin.users.create') }}"
                    class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                        class="fa fa-plus fa-xs absolute top-3 left-3"></i> Create New User</a>
            </div>
        @endcan

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <div id="buttonPlacement" class="mb-3 text-center"></div>
                <div class="table-responsive">
                    <table id="users" class="table table-bordered w-100 text-center">
                        <thead class="bg-primary text-white align-middle">
                            <tr>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Mail</th>
                                <th class="align-middle">Phone</th>
                                <th class="align-middle">Gender</th>
                                <th class="align-middle">Role</th>
                                <th class="align-middle">Visits No.</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle">{{ $user->first_name . ' ' . $user->last_name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->phone }}</td>
                                    <td class="align-middle">{{ $user->gender == '1' ? 'Male' : 'Female' }}</td>
                                    <td class="align-middle">{{ $user->getRoleNames()->first() }}</td>
                                    <td class="align-middle">{{ $user->visit_num }}</td>
                                    <td class="align-middle">
                                        {{-- Show User's Details --}}
                                        @can('user-show-all')
                                            <button type="button" class="btn btn-sm btn-primary font-bold detailsButton"
                                                data-name='{{ $user->name }}' data-id='{{ $user->id }}'
                                                data-toggle="modal" data-target="#DetailsModal"><i
                                                    class="fas fa-user fa-fw"></i></button>
                                        @endcan

                                        {{-- Edit User --}}
                                        @can('user-edit-all')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-sm btn-info font-bold"><i class="fas fa-user-edit fa-fw"></i></a>
                                        @endcan

                                        {{-- Delete User --}}
                                        @can('user-delete-all')
                                            <button type="button" class="btn btn-sm btn-danger font-bold deleteButton"
                                                data-name='{{ $user->first_name . ' ' . $user->last_name }}'
                                                data-id='{{ $user->id }}' data-toggle="modal" data-target="#DeleteModal"><i
                                                    class="fas fa-user-times fa-fw"></i></button>
                                        @endcan

                                        {{-- Edit User Role --}}
                                        @can('user-edit-role')
                                            <a href="{{ route('admin.users.show.roles', $user->id) }}"
                                                class="btn btn-sm btn-warning font-bold"><i class="fas fa-key fa-fw"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light text-primary align-middle">
                            <tr>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Mail</th>
                                <th class="align-middle">Phone</th>
                                <th class="align-middle">Gender</th>
                                <th class="align-middle">Role</th>
                                <th class="align-middle">Visits No.</th>
                                <th class="w-100 align-middle">Actions</th>
                            </tr>
                        </tfoot>
                    </table>
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

    <!-- Details Modal -->
    <div class="modal fade bd-example-modal-xl" id="DetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="datailsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white font-bold">
                    <h5 class="modal-title" id="datailsModalCenterTitle">User's Details</h5>
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
                                    <div class="col-lg-12 text-center h3 mb-3" id="userName">

                                    </div>

                                    {{-- Images --}}
                                    <div class="col-lg-3 px-3 mb-3 border-l-2 border-gray-100">
                                        <div id="userImages" style="height: 100%">

                                        </div>
                                    </div>

                                    {{-- Other Details 1 --}}
                                    <div class="col-lg-9">
                                        <div class="row">

                                            {{-- Country --}}
                                            <div class="col-lg-12 mb-2">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Country</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-900 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userCountry"> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Email --}}
                                            <div class="col-lg-12 mb-2">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-800 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Email</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-800 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userEmail"> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Phone</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userPhone"> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Gender --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Gender</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                        <div class="text-center w-100" id="userGender">

                                                        </div>
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

                                    {{-- Visits Number --}}
                                    <div class="col-lg-6 mb-2">
                                        <div class="bg-indigo-900 text-white rounded-t font-bold py-1">
                                            Visits Number
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-900 py-1" id="userVisitNum">

                                        </div>
                                    </div>

                                    {{-- Verified Mail --}}
                                    <div class="col-lg-6 mb-2 origin">
                                        <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                            Verified Mail
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                            id="userVerifiedMail">

                                        </div>
                                    </div>

                                    {{-- Last Visit Date --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                            Last Visit Date
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-700 py-1" id="userLastVisit">

                                        </div>
                                    </div>

                                    {{-- Created at --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                            Created at
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-600 py-1" id="userCreatedAt">

                                        </div>
                                    </div>

                                    {{-- Last Updated --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                            Last Updated at
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                            id="userLastUpdatedAt">

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

    {{-- Initialize Datatable --}}
    $("#users").DataTable({
    buttons: [{
    extend: 'colvis',
    className: 'bg-info font-bold',
    },
    {
    extend: 'copyHtml5',
    className: 'bg-primary font-bold',
    exportOptions: {
    columns: [0,1,2,3,4]
    }
    },
    {
    extend: 'excelHtml5',
    className: 'bg-success font-bold',
    exportOptions: {
    columns: [0,1,2,3,4]
    }
    },
    {
    extend: 'pdfHtml5',
    className: 'bg-danger font-bold',
    exportOptions: {
    columns: [0,1,2,3,4]
    }
    },
    {
    extend: 'print',
    className: 'bg-dark font-bold',
    exportOptions: {
    columns: [0,1,2,3,4]
    }
    },
    ]
    }).buttons().container().appendTo(document.getElementById("buttonPlacement"));;

    {{-- Click Delete Button --}}
    $('.deleteButton').on('click', function() {
    $('#deletedItemName').text($(this).data('name'));
    $('#deleteForm').attr("action", 'users/' + $(this).data('id'));
    });

    {{-- Click Details Button --}}
    $('.detailsButton').on('click', function () {
    $.ajax({
    url: 'user/' + $(this).attr('data-id'),
    method: 'GET',
    success: function (res) {

    {{-- Get user's Images --}}
    let image = res.user.profile_photo;
    $('#userImages').append(`<div class="single_slide"><img src="/images/${image}" style="margin: auto" draggable="false">
    </div>`);

    {{-- Name --}}
    $('#userName').text(res.user.first_name + " " + res.user.last_name);

    {{-- Country --}}
    $('#userCountry').text(res.user.country.name);

    {{-- Email --}}
    $('#userEmail').text(res.user.email);

    {{-- Phone --}}
    $('#userPhone').text(res.user.phone);

    {{-- Gender --}}
    $('#userGender').text(res.user.gender == 1 ? "Male" : "Female");

    {{-- Visits Number --}}
    $('#userVisitNum').text(res.user.visit_num);

    {{-- Verified Mail --}}
    if (res.user.email_verified_at) {
    $('#userVerifiedMail').text('Yes');
    } else {
    $('#userVerifiedMail').text('No');
    }

    {{-- Last Visit Date --}}
    $('#userLastVisit').text(res.user.last_visit);

    {{-- Created at --}}
    var cT = res.user.created_at.split(/[-.T :]/);
    var createdAt = `${cT[0]}-${cT[1]}-${cT[2]} ${cT[3]}:${cT[4]}:${cT[5]}`;
    console.log(cT);
    $('#userCreatedAt').text(createdAt);

    {{-- Last Updated --}}
    var uT = res.user.updated_at.split(/[-.T :]/);
    var updatedAt = `${uT[0]}-${uT[1]}-${uT[2]} ${uT[3]}:${uT[4]}:${uT[5]}`;

    $('#userLastUpdatedAt').text(updatedAt);

    },

    {{-- Handiling Errors By Reload Page --}}
    error: function () {
    window.location = '{{ route('admin.users.index') }}';
    }

    })

    })

    {{-- Erase Data After Modal Close --}}
    $('#DetailsModal').on('hidden.bs.modal', function() {
    $('#userName, #userImages, #userCountry, #userEmail, #userPhone, #userGender, #userVisitNum, #userVerifiedMail, #userLastVisit, #userCreatedAt, #userLastUpdatedAt').html('');
    $('.origin').removeClass('hide');
    })

    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif

@endsection
