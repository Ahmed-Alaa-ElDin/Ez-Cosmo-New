@extends('layouts.master')

@section('categories')
    active
@endsection

@section('all-categories')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class="mt-2">
            All Categories
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.categories.create') }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-plus fa-xs absolute top-3 left-3"></i> Create New Category</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <livewire:admin.category-data-table />
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{-- Deleted Form Success Toaster --}}
    window.livewire.on('success', data => {
        toastr.success(data['message']);
    });

    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif
@endsection
