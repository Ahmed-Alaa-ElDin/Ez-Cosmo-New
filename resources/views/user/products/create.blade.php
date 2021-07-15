@extends('layouts.userMaster')

@section('style')
    <style>
        .select2-selection__rendered {
            margin-top: 0 !important;
        }

        .select2-selection--multiple {
            border: 1px solid rgba(209, 213, 219) !important;
        }

        .select2-search__field {
            padding-left: 6px !important;
        }

        .select2-selection__choice {
            background-color: #007bff !important;
            border-radius: 15px !important;
            padding: 0 8px !important;
            box-shadow: : 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            border: 1px ​solid #fff !important;
        }

        .select2-selection__choice__remove {
            color: beige !important;
            margin-right: 5px !important;
        }

    </style>
@endsection


@section('content')
    {{-- Header & Sidebar --}}
    <div class="">

        @include('includes.user-navigation-menu')

    </div>

    {{-- Main content --}}
    <div class="content-wrapper mt-12">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                New Product
                <small>Create</small>
            </h1>
        </section>

        {{-- Create Form --}}
        @livewire('user.add-new-product-request')
        {{-- Create Form --}}
    
    </div>

@endsection