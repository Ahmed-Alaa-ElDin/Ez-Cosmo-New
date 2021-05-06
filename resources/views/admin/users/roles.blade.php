@extends('layouts.master')

@section('users')
    active
@endsection

@section('user-roles')
    active
@endsection

@section('style')
    <style>
        *:focus {
            outline: 0 !important;
        }

    </style>
@endsection

@section('content')

    {{-- {{dd($user->roles->first()->id)}} --}}
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1>
            {{ $user->first_name }} {{ $user->last_name }}
            <small>Roles</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                {{-- start: Edit Role --}}
                <form action="{{route('admin.users.update.roles',$user->id)}}" method="POST">
                    @csrf

                    <div class="form-group my-4">
                        <div class="flex justify-center">
                            <label for="role" class="min-w-max mr-3 self-center my-auto">
                                Current Role
                            </label>
                            <select name="role" class="form-control focus:border-blue-200 focus:ring-blue-200 
                                        @error('role')
                                                    border-red-300
                                        @else
                                                    border-gray-300
                                        @enderror
                                        rounded w-40" id="role">
                                <option value="">Choose a Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if (isset($user->roles->first()->id) && $role->id == $user->roles->first()->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="flex w-50  m-auto justify-between my-4">
                        <button class="btn btn-success text-white font-bold">Update User's Role</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger font-bold">Cancel</a>
                    </div>
                </form>
                {{-- end: Edit Role --}}

                <hr class="my-5">

                {{-- start: Old Permission List --}}
                <h3 class="w-100 text-center h5">Old Permissions</h3>
                <div class="table-responsive my-3">
                    <table class="w-max m-auto text-center table-hover table-bordered table-striped cursor-pointer">
                        <tr class="">
                            <th class="px-3 py-2 bg-warning">Object</th>
                            <th class="px-3 py-2 bg-warning" colspan="2">Permission</th>
                            <th class="px-3 py-2 bg-info">Object</th>
                            <th class="px-3 py-2 bg-info" colspan="2">Permission</th>
                        </tr>
                        @foreach ($permissions as $permission)
                            @if ($loop->odd)
                                <tr>
                                    <td class="px-3 py-2 table-warning">
                                        {{ ucwords(explode('-', $permission->name, 2)[0]) }}
                                    </td>
                                    <td class="px-3 py-2 table-warning">
                                        {{ ucwords(explode('-', $permission->name, 2)[1]) }}
                                    </td>
                                    <td class="px-3 py-2 table-warning">
                                        @if (in_array($permission->id, $currentPermissions))
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </td>
                                @else
                                    <td class="px-3 py-2 table-info">{{ ucwords(explode('-', $permission->name, 2)[0]) }}
                                    </td>
                                    <td class="px-3 py-2 table-info">{{ ucwords(explode('-', $permission->name, 2)[1]) }}
                                    </td>
                                    <td class="px-3 py-2 table-info">
                                        @if (in_array($permission->id, $currentPermissions))
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                {{-- end: Old Permission List --}}

            </div>
        </div>
    </section>


@endsection
