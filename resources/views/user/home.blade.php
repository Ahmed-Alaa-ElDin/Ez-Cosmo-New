@extends('layouts.userMaster')

@section('style')

    {{-- Slick --}}
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick/slick-theme.css') }}">

    <style>
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



        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .singleDrop {
            border-radius: 5px;
        }

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
            left: -4px;
        }

        .slick-next {
            right: -4px;
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
    {{-- Header & Sidebar --}}
    <div class="">

        @include('includes.user-search-navigation-menu')

    </div>

    {{-- Main content --}}
    <div class="content-wrapper mt-12">


        <!-- Content Header (Page header) -->
        <section class="content-header grid grid-cols-3 justify-items-stretch">
            <div></div>
            <div class="text-center h3 mt-2 font-bold justify-self-center">
                Home Page
            </div>
            @can('product-create-request')
                <div class="justify-self-end self-center">
                    <a href="{{ route('user.products.create') }}" title="Add New Product" class="btn btn-success font-bold">
                        <i class="fas fa-plus fa-fw"></i>
                        Add New Product
                    </a>
                </div>
            @else
                <div></div>
            @endcan
        </section>
        <!-- Main content -->
        <section class="content">

            {{-- Search Results --}}
            @livewire('search.home-search-result')
            {{-- Search Results --}}



        </section>
    </div>

@endsection

@section('script')

    {{-- Filters --}}

    {{-- Activating tooltip --}}
    $('[data-toggle="tooltip"]').tooltip()


    {{-- Watch Brand Change --}}
    $('#brands').on('change', function (e) {
    var brand_id = $('#brands').val();
    if (brand_id != "") {
    $('#lineDiv, #lineHr').fadeIn();
    } else {
    $('#lineDiv, #lineHr').fadeOut();
    }
    });

    {{-- Rating Stars --}}

    $('body').on('mouseover', ('.stars.new li'), function(){

    var onStar = parseInt($(this).data('value'), 10);

    $(this).parent().children('li.star').each(function(e){
    if (e < onStar) { $(this).addClass('hover'); } 
    else { $(this).removeClass('hover'); } }); }).on('mouseout',('.stars.new li'), 
    function(){ $(this).parent().children('li.star').each(function(e){ $(this).removeClass('hover'); }); });
        {{-- ----------------------------------------------------------------------------------------------- --}} 
        {{-- ----------------------------------------------------------------------------------------------- --}} 
        {{-- Initialize Highly Reviewed Products Slider --}} 
        $('#highlyReviewedProducts').slick({
        slidesToShow: 5, dots: true, infinite: false, autoplay: false, autoplaySpeed: 2000, }); {{-- Initialize Highly Reviewed Products Slider --}}
        $('#NewlyAddedProducts').slick({ slidesToShow: 5, dots: true, infinite: false, autoplay: false, autoplaySpeed: 2000,}); 
        {{-- Deleted Product Success Toaster --}} 
        window.livewire.on('success', data=> {
        toastr.success(data['message']);
        });

        {{-- Deleted Review Success Toaster --}}
        window.livewire.on('modalOpen', data => {
        setTimeout(function(){
        $('body').addClass('modal-open');
        }, 500);
        });

    {{-- Open product details modal --}}
    window.livewire.on('modalShow', () => {
        $('#DetailsModal').modal('show');
    });

        @if (session('success'))
            toastr.success('{{ session('success') }}')
        @endif

    @endsection
