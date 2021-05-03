@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Brands
            <small>Edit</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{route('admin.brands.update',$brand->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group  my-4">
                        <div class="flex justify-center">
                            <label for="name" class="min-w-max mr-3 self-center my-auto">Brand Name</label>
                            <input type="text" class="form-control focus:border-blue-200 focus:ring-blue-200
                            @error('name')
                            border-red-300
                            @else
                            border-gray-300
                            @enderror
                            rounded w-50" name="name" value="{{old('name',$brand->name)}}">
                        </div>
                        @error('name')
                            <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group  my-4">
                        <div class="flex justify-center">
                            <label for="country" class="min-w-max mr-3 self-center my-auto">Country Name</label>
                            <select name="country" class="form-control focus:border-blue-200 focus:ring-blue-200 rounded w-50
                                    @error('country')
                                            border-red-300
                                    @else
                                            border-gray-300
                                    @enderror">
                                <option value="">Select The Brand's Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($country->id == old('country') || (isset($brand->country->id) && $country->id == $brand->country->id)) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('country')
                            <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex w-50  m-auto justify-between my-4">
                        <button class="btn btn-success text-white font-bold">Update Brand</button>
                        <a href="{{route('admin.brands.index')}}" class="btn btn-danger font-bold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
