@extends('layouts.userMaster')

@section('advanced-search')
    active
@endsection

@section('search-ingredient')
    active
@endsection

@section('style')

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

        *:focus {
            outline: 0 !important;
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

        @include('includes.user-navigation-menu')

    </div>

    {{-- Main content --}}
    <div class="content-wrapper mt-12">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="text-center h3 mt-2 font-bold">
                Search By Ingredient
            </div>
        </section>
        <!-- Main content -->
        <section class="content">

            {{-- Search Results --}}
            @livewire('advanced-search.search-ingredient')
            {{-- Search Results --}}

        </section>
    </div>

@endsection

@section('script')

    {{-- $('body').on('focus',('#searchInput'),function () {
        $('#choices').fadeIn();
        $('#choices li').first().addClass('hover');
    });

    $('body').on('blur',('#searchInput'),function () {
        $('#choices').fadeOut();
    }); --}}

    {{-- Activating tooltip --}}
    $('[data-toggle="tooltip"]').tooltip()


    {{-- Rating Stars --}}

    $('body').on('mouseover', ('.stars.new li'), function(){

        var onStar = parseInt($(this).data('value'), 10);

        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) { 
                $(this).addClass('hover'); 
            } else { 
                $(this).removeClass('hover'); 
            } 
        }); 
    }).on('mouseout',('.stars.new li'), function(){ 
        $(this).parent().children('li.star').each(function(e){ 
            $(this).removeClass('hover'); 
        }); 
    });
    
    {{-- ----------------------------------------------------------------------------------------------- --}} 
    {{-- ----------------------------------------------------------------------------------------------- --}} 
    
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


    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif

@endsection
