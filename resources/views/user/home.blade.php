@extends('layouts.master')

@section('style')
    {{-- Slick --}}
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick-theme.css') }}">

    <style>
        .details-button {
            position: absolute;
            bottom: 10px;
            left: 25%;
            width: 50%;
        }

        .slick-dots {
            bottom: auto;
        }

        *:focus {
            outline: 0 !important;
        }

        .slick-track {
            display: flex !important;
        }

        .slick-slide {
            height: inherit !important;
        }

        .slick-arrow::after,
        .slick-arrow::before {
            color: black;
        }

        .slick-prev {
            left: 2px;
        }

        .slick-next {
            right: 2px;
        }

        .slick-dots li {
            margin: 0 !important;
            width: 15px !important;
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
            text-align: center;
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

    </style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-center h1">
            Home Page
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header bg-warning text-center h4">
                Highly Reviewed Products
            </div>
            <div class="card-body">
                <div id="highlyReviewedProducts" class="products px-4">
                    @foreach ($topRatedProducts as $product)
                        <div class="product mx-2">
                            <div class="card h-100">
                                <img src="{{ asset('images/' . json_decode($product->product->product_photo)[0]) }}"
                                    class="card-img-top" alt="{{ $product->product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title h5 text-center"> {{ $product->product->name }} </h5>
                                    <div class="text-center my-3">
                                        <div class="price text-red-500 font-bold h6 mt-3">
                                            {{ number_format($product->product->price, 2, '.', '\'') }} EGP
                                        </div>
                                        <div class="review mb-5">
                                            <div class='rating-stars'>
                                                <ul class="stars">
                                                    <li class='star selected' title='1' data-value='1'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star @if ($product->avg_score >= 1.5) selected @endif'
                                                        title='2' data-value='2'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star @if ($product->avg_score >= 2.5) selected @endif'
                                                        title='3' data-value='3'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star @if ($product->avg_score >= 3.5) selected @endif'
                                                        title='4' data-value='4'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star @if ($product->avg_score >= 4.5) selected @endif'
                                                        title='5' data-value='5'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                {{ number_format($product->avg_score, 1) }}
                                                ({{ $product->no_reviewers }})
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details-button text-center">
                                        <a href="#" class="btn btn-warning font-bold btn-sm">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

    {{-- Initialize Slider --}}
    $('#highlyReviewedProducts').slick({
    slidesToShow: 5,
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,

    });


    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif

@endsection
