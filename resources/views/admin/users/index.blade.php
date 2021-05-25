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
        <h1 class="mt-2">
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
                    <livewire:admin.user-data-table />
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    {{-- Deleted User Success Toaster --}}
    window.livewire.on('success', data => {
    toastr.success(data['message']);
    });

    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif

@endsection
