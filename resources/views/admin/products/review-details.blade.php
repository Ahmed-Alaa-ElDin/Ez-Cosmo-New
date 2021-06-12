@extends('layouts.master')

@section('products')
    active
@endsection

@section('review-products')
    active
@endsection

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

        /* styling comparison table */
        td,
        tr {
            padding: 0 !important;
        }

        td label {
            display: block;
            padding: 0.75rem;
            cursor: pointer;
            width: 100%;
            margin: 0;
        }

        td input {
            display: none !important;
        }

        #imageSelect input[type='checkbox']:checked ~ img {
            border: 3px solid #2ecc71aa;
        }

        #imageSelect input[type='checkbox']:not(:checked) ~ img {
            border: 3px solid #e74c3caa;
        }


    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1 class=" mt-2">
            {{ $product_name }} Edits by {{ $editor_name }}
        </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                @livewire('admin.edited-product-review-data-table', [
                'product_id' => $id
                ])
            </div>
        </div>
    </section>

@endsection

@section('script')

    {{-- Activating tooltip --}}
    $('[data-toggle="tooltip"]').tooltip()

    {{-- set initial color of table cell --}}
    $('td input[type="radio"]:checked').parents('td').attr('class','bg-green-100').siblings('td').attr('class','bg-red-100');
    $('td input[type="checkbox"]:not(:checked)').parents('label').attr('class','bg-red-100');
    $('td input[type="checkbox"]:checked').parents('label').attr('class','bg-green-100');

    {{-- change cell color on radio button select --}}
    window.livewire.on('updated', data => {
    $('td input[type="radio"]:checked').parents('td').attr('class','bg-green-100').siblings('td').attr('class','bg-red-100');
    $('td input[type="checkbox"]').parent().attr('class','bg-red-100');
    $('td input[type="checkbox"]:checked').parent().attr('class','bg-green-100');
    });

    {{-- Deleted Product Success Toaster --}}
    window.livewire.on('success', data => {
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
