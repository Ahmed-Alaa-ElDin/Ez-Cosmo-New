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

@section('products')
    active
@endsection

@section('add-product')
    active
@endsection

@section('content')
<div class="content-wrapper mt-12">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Product
            <small>Create</small>
        </h1>
    </section>
    <!-- Main content -->
    @livewire('user.add-new-product-request')
</div>
@endsection

@section('script')
    var options = [];


    {{-- $('#brand').on('change', function () {
        @this.set('brand_id',1);
    }) --}}
    @if (old('indication'))
        var select = [];
        @foreach (old('indication') as $indication)
            select.push({{ $indication }});
        @endforeach
        $('.multiSelect').val(select).change();
    @endif

    {{-- ajax get line --}}
    {{-- var choose = '<option value="">Choose Line</option>';
    $('#brand').on('change', function () {
    if ($(this).val() != ""){
    $.ajax({
    url: '/admin/products/' + $(this).val() + '/lines',
    method: 'POST',
    data: {
    '_token' : '{{ csrf_token() }}'
    },
    success: function (res) {
    $('#line').empty();
    $('#line').append(choose);
    for (var i = 0 ; i < res.length ; i++) { let option=res[i].name; let option_id=res[i].id; $('#line').append(` <option
        value="${option_id}">${option}</option>
        `);
        }
        },
        })
        } else {
        $('#line').empty();
        $('#line').append(choose);
        }
        }) --}}

        @if (old('brand'))
            $.ajax({
            url: '/admin/products/{{ old('brand') }}/lines',
            method: 'POST',
            data: {
            '_token' : '{{ csrf_token() }}'
            },
            success: function (res) {
            $('#line').empty();
            $('#line').append(choose);
            for (var i = 0 ; i < res.length ; i++) { let option=res[i].name; let option_id=res[i].id;
                $('#line').append(`<option value="${option_id}">${option}</option>`);
                }
                $('#line').val({{ old('line') }}).change();

                },
                })
        @endif

        {{-- image preview --}}
        $('#images').on('change', function () {
        $('#imagesLable').empty();
        for (var i = 0; i < this.files.length; i++) { $('#imagesLable').append(`<span
            class='bg-primary px-2 py-1 rounded-full text-sm shadow-sm text-white mr-2'>${this.files[i].name.slice(0,5) +
            '...'}</span>`);
            if (this.files.length > 4 && i == 3 ){
            $('#imagesLable').append(`<span>...</span>`);
            break;
            }
            }
            })
            $('#saveIngredientButton').on('click', function () {
            $.ajax({
            url: '{{ route('admin.ingredients.add.ajax') }}',
            method: 'POST',
            data: {
            '_token' : '{{ csrf_token() }}',
            'name' : $('#ingredientName').val()
            },
            success: function(res){
            if(res.name){
            $('#ingredientName').removeClass('border-gray-300').addClass('border-red-300');
            $('#ingredientNameError').removeClass('hidden').text(res.name);
            } else if (res.success) {
            $('#ingredientName').removeClass('border-red-300').addClass('border-gray-300').val('');
            $('#ingredientNameError').addClass('hidden');
            $('#cancelIngredientButton').click();
            toastr.success(res.success);
            }
            }
            })
            })

            $('#cancelIngredientButton').on('click', function () {
                $('#ingredientName').removeClass('border-red-300').addClass('border-gray-300').val('');
                $('#ingredientNameError').addClass('hidden');
            });

            $('#ingredientsList').on('click', '.removeIngredient', function () {
                $(this).parents('.singleIngredient').remove();
            });

            $('#addProductIngredient').on('click', function() {
            $('#ingredientsList').append(` <div class="row singleIngredient">
                <div class="col-lg-3">
                    <div class="flex">
                        <select name="ingredient[name][]"
                            class="form-control focus:border-blue-200 focus:ring-blue-200 rounded pr-5 ingredientNameSelect">
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        maxlength="50" name="ingredient[concentration][]" placeholder="Concentration">
                </div>
                <div class="col-lg-6 form-group">
                    <input type="text"
                        class="form-control focus:border-blue-200 focus:ring-blue-200 border-gray-300 rounded"
                        maxlength="255" name="ingredient[role][]" placeholder="Role">
                </div>
                <div class="col-lg-1 form-group flex content-evenly">
                    <button type="button" class="btn btn-danger btn-sm my-auto font-bold removeIngredient">&times;</button>
                </div>
            </div>
            `);

            $.ajax({
                method: 'GET',
                url: '{{ route('admin.ingredients.get.ajax') }}',
                success: function(res) {
                    options = [{
                        id: '',
                        text: 'Choose Ingredient'
                    }];
                    for (let i = 0; i < res.Ingredients.length; i++) { 
                        options.push({ 
                            id: res.Ingredients[i].id, 
                            text: res.Ingredients[i].name 
                        }); 
                    } 
                    $('.ingredientNameSelect').last().select2({ 
                        theme: 'bootstrap4' ,
                        dropdownAutoWidth: true, 
                        data: options 
                    }) 
                } 
            }) 
        }) 
    @endsection
