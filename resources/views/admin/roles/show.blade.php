@extends('layouts.master')

@section('roles')
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
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1>
            {{ $role->name }}'s Permissions
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.roles.edit', $role->id) }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-edit fa-xs absolute top-3 left-3"></i> Edit Role's Permissions</a>
            <a href="{{ route('admin.roles.index') }}"
                class="btn btn-primary font-bold inline-block items-center relative block pl-8"><i
                    class="fas fa-backward fa-xs absolute top-3 left-3"></i> Back To Roles</a>

        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card shadow">
            <div class="card-body">
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
                                        @if (in_array($permission->id, $role->permissions->pluck('id')->toArray()))
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
            </div>
        </div>
    </section>


@endsection

@section('script')

    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif

@endsection
