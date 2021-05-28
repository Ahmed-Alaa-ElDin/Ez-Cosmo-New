@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class="mt-2">
            Brands Made In {{ $country->name }}
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
                <livewire:admin.countries-brand-data-table :countryID="$country->id" :countryName="$country->name" />
            </div>
        </div>
    </section>

@endsection

@section('script')

    {{-- Deleted Product Success Toaster --}}
    window.livewire.on('success', data => {
        toastr.success(data['message']);
    });

    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif
@endsection
