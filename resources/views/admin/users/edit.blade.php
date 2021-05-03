@extends('layouts.master')

@section('users')
    active
@endsection

@section('all-users')
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
            {{$user->first_name . ' ' . $user->last_name . ' Profile'}}
            <small>Update</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">

                        {{-- Profile Photo --}}
                        <div class="col-lg-12 my-2">
                                <div class="flex justify-center">
                                    <img id="profile_photo" style="width: 20%" src="{{asset('images/' . $user->profile_photo)}}" alt="Profile Photo">
                                </div>
                                <div class="mx-auto mt-4 text-center" style="width: 30%">
                                    <input type="file" accept="image/*" name="profilePhotoInput" id="profilePhotoInput" class="d-none">
                                    <button type="button" class="btn btn-primary btn-sm font-bold" id="changeProfilePhoto">Upload Image</button>
                                    <button type="button" id="deleteProfilePhoto" data-id="{{$user->id}}" class="btn btn-danger btn-sm font-bold hide">Delete Image</button>
                                </div>
                        </div>

                        {{-- First Name --}}
                        <div class="col-lg-4 form-group my-2">
                            <div class="flex justify-center">
                                <label for="first_name" class="min-w-max mr-3 my-auto font-bold">First Name</label>
                                <input type="text" name="first_name"
                                class="form-control focus:border-blue-200 focus:ring-blue-200 @error('first_name') border-red-300 @else border-gray-300 @enderror rounded"
                                id="first_name" required value="{{old('first_name', $user->first_name)}}">
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
                                id="last_name" required value="{{old('last_name', $user->last_name)}}">
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
                                    <option value="1" @if (old('gender' , $user->gender) == 1) selected @endif>Male</option>
                                    <option value="2" @if (old('gender' , $user->gender) == 2) selected @endif>Female</option>
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
                                id="phone" value="{{old('phone', $user->phone)}}">
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
                                id="email" required value="{{old('email', $user->email)}}">
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
                                        <option value="{{$country->id}}" @if (old('country_id', $user->country_id) == $country->id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country_id')
                                <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="col-lg-12 form-group my-2 bg-red-100 rounded p-3 border-2 border-red-300">
                            <div class="row">
                                <div class="col-lg-12 mb-3 text-red-900">
                                    <label class="min-w-max w-100 text-center my-auto font-bold">Change Password</label>
                                </div>

                                {{-- Old Password --}}
                                <div class="col-lg-4 flex justify-center text-red-800">
                                    <label for="old_password" class="min-w-max mr-3 my-auto font-bold">Old Password</label>
                                    <input type="password" name="old_password"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('old_password') border-red-300 @else border-gray-300 @enderror rounded"
                                    id="old_password" autocomplete="off">
                                </div>
                                

                                {{-- New Password --}}
                                <div class="col-lg-4 flex justify-center text-red-800">
                                    <label for="new_password" class="min-w-max mr-3 my-auto font-bold">New Password</label>
                                    <input type="password" name="new_password"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('new_password') border-red-300 @else border-gray-300 @enderror rounded"
                                    id="new_password">
                                </div>
                                

                                {{-- Confirm Password --}}
                                <div class="col-lg-4 flex justify-center text-red-800">
                                    <label for="new_password_confirmation" class="min-w-max mr-3 my-auto font-bold">Confirm Password</label>
                                    <input type="password" name="new_password_confirmation"
                                    class="form-control focus:border-blue-200 focus:ring-blue-200 @error('new_password_confirmation') border-red-300 @else border-gray-300 @enderror rounded"
                                    id="new_password_confirmation">
                                </div>

                                <div class="col-lg-12">
                                    @error('old_password')
                                        <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                    @enderror
                                    @error('new_password')
                                        <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                    @enderror
                                    @error('new_password_confirmation')
                                        <div class="text-red-500 text-center mt-2 font-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex offset-lg-3 col-lg-6  mx-auto justify-between my-2">
                            <button class="btn btn-success text-white font-bold">Update Profile</button>
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

    if ($('#profile_photo').attr('src') != '{{asset('images/default_profile.png')}}') {
        $('#deleteProfilePhoto').removeClass('hide');
        $('#changeProfilePhoto').text('Change Image');
    };


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

    $('#deleteProfilePhoto').on('click', function () {
        $.ajax({
            url: "{{'/admin/user_img/'.$user->id}}",
            method: 'Delete',
            data: {'_token':'{{csrf_token()}}'},
            success: function (res) {
                if (res.success) {
                    $('#profile_photo').attr('src','{{asset('images/default_profile.png')}}');
                    toastr.warning('Profile Photo Deleted Successfully');
                    $('#deleteProfilePhoto').addClass('hide');
                    $('#changeProfilePhoto').text('Upload Image');

                }
            }
        })
    });

    $('#changeProfilePhoto').on('click', function () {
        $('#profilePhotoInput').click();
    });

    $('#profilePhotoInput').on('change', function () {
        
        var image = new FormData();
        image.append('_token','{{csrf_token()}}');

        var files = $('#profilePhotoInput')[0].files;
        
        if(files.length > 0 ){
            image.append('file',files[0]);
            console.log(image);
            $.ajax({
                url: "{{'/admin/user_img/' . $user->id}}",
                method: 'POST',
                data: image,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success && res.image) {
                        $('#profile_photo').attr('src','{{asset('/images')}}' + '/' + res.image);
                        toastr.success('New Profile Photo Added Successfully');
                        $('#deleteProfilePhoto').removeClass('hide');
                        $('#changeProfilePhoto').text('Change Image');
                    }
                }
            })
        }
    });
@endsection
