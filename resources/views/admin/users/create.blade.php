@extends('layouts.master')

@section('users')
    active
@endsection

@section('add-user')
    active
@endsection

@section('style')
    <style>
        * {
            box-sizing: border-box 
        }

        *:focus {
            outline: 0 !important;
        }

        #DetailsModal .row {
            margin-left: 0;
            margin-right: 0;
        }

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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
            <small>Create</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- Profile Photo --}}
                        <div class="col-lg-12 my-2">
                            <div class="flex justify-center">
                                <img id="profile_photo" style="width: 20%" src="{{asset('images/default_profile.png')}}" alt="Profile Photo">
                            </div>
                            <div class="flex justify-center mx-auto mt-4" style="width: 30%">
                                <form method="post" action="" enctype="multipart/form-data" id="myform" class="d-none">
                                    @csrf
                                    <input type="file" accept="image/*" name="profile_photo" id="profilePhotoInput" class="d-none">
                                </form>
                                <button type="button" class="btn btn-primary btn-sm font-bold" id="changeProfilePhoto">Add Profile Photo</button>
                            </div>
                            @error('profile_photo')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                            @if ($errors->any())
                                <div class="text-yellow-500 text-center text-sm mt-2 font-bold">Please Choose the Profile Photo Again</div>
                            @endif
                        </div>

                        {{-- First Name --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="first_name" class="min-w-max mr-3 my-auto font-bold">First Name</label>
                                <input type="text" name="first_name"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('first_name') border-red-300 @else border-gray-300 @enderror rounded"
                                id="first_name" required value="{{old('first_name')}}">
                            </div>
                            @error('first_name')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="last_name" class="min-w-max mr-3 my-auto font-bold">Last Name</label>
                                <input type="text" name="last_name"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('last_name') border-red-300 @else border-gray-300 @enderror rounded"
                                id="last_name" value="{{old('last_name')}}">
                            </div>
                            @error('last_name')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="offset-lg-1 col-lg-3 form-group my-2">
                            <div class="flex justify-end">
                                <label for="gender" class="min-w-max mr-3 my-auto font-bold">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="">Choose Gender</option>
                                    <option value="1" @if (old('gender') == 1) selected @endif>Male</option>
                                    <option value="2" @if (old('gender') == 2) selected @endif>Female</option>
                                </select>
                            </div>
                            @error('gender')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-start">
                                <label for="phone" class="min-w-max mr-3 my-auto font-bold">Phone</label>
                                <input type="text" name="phone"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('phone') border-red-300 @else border-gray-300 @enderror rounded"
                                id="phone" value="{{old('phone')}}">
                            </div>
                            @error('phone')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-lg-5 form-group my-2">
                            <div class="flex justify-center">
                                <label for="email" class="min-w-max mr-3 my-auto font-bold">Email</label>
                                <input type="text" name="email"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('email') border-red-300 @else border-gray-300 @enderror rounded"
                                id="email" required value="{{old('email')}}">
                            </div>
                            @error('email')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Country --}}
                        <div class="col-lg-3 form-group my-2">
                            <div class="flex justify-center">
                                <label for="country_id" class="min-w-max mr-3 my-auto font-bold">Country</label>
                                <select name="country_id" id="country_id">
                                    <option value="">Choose Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" @if (old('country_id') == $country->id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country_id')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="password" class="min-w-max mr-3 my-auto font-bold">Password</label>
                                <input type="password" name="password"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('password') border-red-300 @else border-gray-300 @enderror rounded"
                                id="password">
                            </div>
                            @error('password')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        {{-- Confirm Password --}}
                        <div class="col-lg-5 form-group my-2">
                            <div class="flex justify-center">
                                <label for="password_confirmation" class="min-w-max mr-3 my-auto font-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('password') border-red-300 @else border-gray-300 @enderror rounded"
                                id="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- User's Role --}}
                        @can('user-edit-role')                            
                            <div class="col-lg-3 form-group my-2">
                                <div class="flex justify-center">
                                    <label for="role" class="min-w-max mr-3 my-auto font-bold">Role</label>
                                    <select type="password" name="role"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('password') border-red-300 @else border-gray-300 @enderror rounded"
                                    id="role"> 
                                        <option value="">Choose a Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" @if (old('role') === $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        @endcan

                        {{-- Buttons --}}
                        <div class="flex offset-lg-3 col-lg-6  mx-auto justify-between my-2">
                            <button class="btn btn-success text-white font-bold">Add User</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger font-bold">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </section>


@endsection

@section('script')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    }
});

    $('#gender').select2({
        theme: 'bootstrap4',
        dropdownAutoWidth: true,
        placeholder: 'Choose Gender'
    });

    $('#country_id').select2({
        theme: 'bootstrap4',
        dropdownAutoWidth: true,
        placeholder: 'Choose Country'
    });

    @can('user-edit-role')                            
    $('#role').select2({
        theme: 'bootstrap4',
        dropdownAutoWidth: true,
        placeholder: 'Choose Role'
    });
    @endcan

    $('#changeProfilePhoto').on('click', function () {
        $('#profilePhotoInput').click();
    });

    $('#profilePhotoInput').on('change', function () {
        
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#profile_photo').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        } else {
            $('#profile_photo').attr('src','{{asset('images/default_profile.png')}}')
        }
    });
@endsection
