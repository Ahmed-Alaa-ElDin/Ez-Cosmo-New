@extends('layouts.master')

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
            Users From {{ $country->name }}
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.countries.index') }}"
                class="btn btn-primary font-bold inline-block items-center relative block pl-8"><i
                    class="fas fa-backward fa-xs absolute top-3 left-3"></i> Back To Countries</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <livewire:admin.countries-user-data-table :countryID="$country->id" :countryName="$country->name" />
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
