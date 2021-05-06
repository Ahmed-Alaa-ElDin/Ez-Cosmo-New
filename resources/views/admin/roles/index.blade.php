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
            All Roles
            <small>View</small>
        </h1>

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <div id="buttonPlacement" class="mb-3 text-center"></div>
                <div class="table-responsive">
                    <table id="roles" class="table table-bordered w-100 text-center">
                        <thead class="bg-primary text-white align-middle">
                            <tr>
                                <th class="align-middle">#</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">No. of Members</th>
                                <th class="align-middle">No. of Permissions</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $role->name }}</td>
                                    <td class="align-middle">{{ $role->users->count() }}</td>
                                    <td class="align-middle">{{ $role->permissions->count() }}</td>
                                    <td class="align-middle">
                                        {{-- Show Role's Details --}}
                                        <a href="{{ route('admin.roles.show', $role->id) }}"
                                            class="btn btn-sm btn-primary font-bold"><i class="far fa-eye fa-fw"></i></a>

                                        {{-- Edit Role --}}
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-sm btn-info font-bold"><i class="fas fa-edit fa-fw"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light text-primary align-middle">
                            <tr>
                                <th class="align-middle">#</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">No. of Members</th>
                                <th class="align-middle">No. of Permissions</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    {{-- Initialize Datatable --}}
    $("#roles").DataTable({
    buttons: [{
    extend: 'colvis',
    className: 'bg-info font-bold',
    },
    {
    extend: 'copyHtml5',
    className: 'bg-primary font-bold',
    exportOptions: {
    columns: [0,1,2]
    }
    },
    {
    extend: 'excelHtml5',
    className: 'bg-success font-bold',
    exportOptions: {
    columns: [0,1,2]
    }
    },
    {
    extend: 'pdfHtml5',
    className: 'bg-danger font-bold',
    exportOptions: {
    columns: [0,1,2]
    }
    },
    {
    extend: 'print',
    className: 'bg-dark font-bold',
    exportOptions: {
    columns: [0,1,2]
    }
    },
    ]
    }).buttons().container().appendTo(document.getElementById("buttonPlacement"));;

    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif

@endsection
