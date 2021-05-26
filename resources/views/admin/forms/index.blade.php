@extends('layouts.master')

@section('ingredients')
    active
@endsection

@section('all-forms')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class="mt-2">
            All Forms
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.forms.create') }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-plus fa-xs absolute top-3 left-3"></i> Create New Form</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <div id="buttonPlacement" class="mb-3 text-center"></div>
                <livewire:admin.form-data-table />
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
