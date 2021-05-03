@extends('layouts.master')

@section('categories')
    active
@endsection

@section('all-categories')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header flex justify-between">
        <h1>
            All Categories
            <small>View</small>
        </h1>
        <div>
            <a href="{{ route('admin.categories.create') }}"
                class="btn btn-success font-bold inline-block items-center relative block pl-8"><i
                    class="fa fa-plus fa-xs absolute top-3 left-3"></i> Create New Category</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body shadow">
                <div id="buttonPlacement" class="mb-3 text-center"></div>
                <table id="categories" class="table table-bordered w-100 text-center">
                    <thead class="bg-primary text-white align-middle">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="align-middle">{{ $category->name }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.categories.show', $category->id) }}"
                                        class="btn btn-sm btn-primary font-bold"><i class="far fa-eye mr-2"></i> Products</a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-info font-bold"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger font-bold deleteButton"
                                        data-name='{{ $category->name }}' data-id='{{ $category->id }}' data-toggle="modal"
                                        data-target="#DeleteModal"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-light text-primary align-middle">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Delete '<span id="deletedItemName" class="font-bold"></span>' ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger font-bold">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    $("#categories").DataTable({
    buttons: [{
    extend: 'colvis',
    className: 'bg-info font-bold',
    },
    {
    extend: 'copyHtml5',
    className: 'bg-primary font-bold',
    exportOptions: {
    columns: [0]
    }
    },
    {
    extend: 'excelHtml5',
    className: 'bg-success font-bold',
    exportOptions: {
    columns: [0]
    }
    },
    {
    extend: 'pdfHtml5',
    className: 'bg-danger font-bold',
    exportOptions: {
    columns: [0]
    }
    },
    {
    extend: 'print',
    className: 'bg-dark font-bold',
    exportOptions: {
    columns: [0]
    }
    },
    ]
    }).buttons().container().appendTo(document.getElementById("buttonPlacement"));;

    $('.deleteButton').on('click', function() {
    $('#deletedItemName').text($(this).data('name'));
    $('#deleteForm').attr("action", '/categories/' + $(this).data('id'));
    });
    @if (session('success'))
        toastr.success('{{ session('success') }}')
    @endif
@endsection
