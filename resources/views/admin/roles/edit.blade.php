@extends('layouts.master')

@section('roles')
    active
@endsection

@section('style')
    <style>
        * {
            box-sizing: border-box
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
        <h1 class="mt-2">
            {{ $role->name }}'s Permissions
            <small>Update</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="flex w-50  m-auto justify-between my-5">
                        <button class="btn btn-success font-bold text-white">Update Role's Permission</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger font-bold">Cancel</a>
                    </div>

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
                                            @if (in_array($permission->id, $role->permissions->pluck('id')->toArray()))
                                                <div class="custom-control custom-switch pl-5">
                                                    <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->name}}" id="customSwitch{{$loop->iteration}}" checked>
                                                    <label class="custom-control-label cursor-pointer" for="customSwitch{{$loop->iteration}}"></label>
                                                </div>
                                            @else
                                            <div class="custom-control custom-switch pl-5">
                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->name}}" id="customSwitch{{$loop->iteration}}">
                                                <label class="custom-control-label cursor-pointer" for="customSwitch{{$loop->iteration}}"></label>
                                            </div>
                                        @endif
                                        </td>
                                    @else
                                        <td class="px-3 py-2 table-info">
                                            {{ ucwords(explode('-', $permission->name, 2)[0]) }}
                                        </td>
                                        <td class="px-3 py-2 table-info">
                                            {{ ucwords(explode('-', $permission->name, 2)[1]) }}
                                        </td>
                                        <td class="px-3 py-2 table-info">
                                            @if (in_array($permission->id, $role->permissions->pluck('id')->toArray()))
                                            <div class="custom-control custom-switch pl-5">
                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->name}}" id="customSwitch{{$loop->iteration}}" checked>
                                                <label class="custom-control-label cursor-pointer" for="customSwitch{{$loop->iteration}}"></label>
                                            </div>
                                        @else
                                        <div class="custom-control custom-switch pl-5">
                                            <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->name}}" id="customSwitch{{$loop->iteration}}">
                                            <label class="custom-control-label cursor-pointer" for="customSwitch{{$loop->iteration}}"></label>
                                        </div>
                                    @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>

                    <div class="flex w-50  m-auto justify-between my-5">
                        <button class="btn btn-success font-bold text-white">Update Role's Permission</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger font-bold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection

@section('script')

@endsection
