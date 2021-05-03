@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Forms
            <small>Edit</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{route('admin.forms.update',$form->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group  my-4">
                        <div class="flex justify-center">
                            <label for="name" class="min-w-max mr-3 self-center my-auto">Form Name</label>
                            <input type="text" class="form-control focus:border-blue-200 focus:ring-blue-200
                            @error('name')
                            border-red-300
                            @else
                            border-gray-300
                            @enderror
                            rounded w-50" name="name" value="{{old('name',$form->name)}}">
                        </div>
                        @error('name')
                            <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex w-50  m-auto justify-between my-4">
                        <button class="btn btn-success font-bold text-white">Update Form</button>
                        <a href="{{route('admin.forms.index')}}" class="btn btn-danger font-bold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
