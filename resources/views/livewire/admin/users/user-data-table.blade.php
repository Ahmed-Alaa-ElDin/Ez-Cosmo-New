<div>
    <div class="flex justify-center">
        <div>
            <a href="{{ route('admin.users.exportExcel') }}" class="btn btn-success btn-sm font-bold"><i
                    class="fas fa-file-excel"></i> &nbsp; Excel</a>
            <a href="{{ route('admin.users.exportPDF') }}" class="btn btn-danger btn-sm font-bold"><i
                    class="fas fa-file-pdf"></i> &nbsp; PDF</a>
        </div>
    </div>
    <div class="flex justify-between my-2">
        <div class="form-inline">
            Show &nbsp;
            <select wire:model='perPage' class="form-control pr-4 text-sm">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            &nbsp; entries
        </div>
        <div>
            <input wire:model.debounce.300ms="search" placeholder="Search Usrers ..." class="form-control">
        </div>
    </div>


    <table id="users" class="table table-bordered w-100 text-center">
        <thead class="bg-primary text-white align-middle">
            <tr>
                <th class="align-middle cursor-pointer" wire:click="sortBy('first_name')">Name &nbsp;
                    @include('partials._sort_icon', ['field' => 'first_name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('email')">Mail &nbsp;
                    @include('partials._sort_icon', ['field' => 'email'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('phone')">Phone &nbsp;
                    @include('partials._sort_icon', ['field' => 'phone'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('gender')">Gender &nbsp;
                    @include('partials._sort_icon', ['field' => 'gender'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('roles.name')">Role &nbsp;
                    @include('partials._sort_icon', ['field' => 'roles.name'])</th>
                <th class="align-middle cursor-pointer" wire:click="sortBy('visit_num')">Visits No. &nbsp;
                    @include('partials._sort_icon', ['field' => 'visit_num'])</th>
                <th class="align-middle">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->first_name . ' ' . $user->last_name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->phone ? $user->phone : 'N/A' }}</td>
                    <td class="align-middle">{{ $user->gender == '1' ? 'Male' : 'Female' }}</td>
                    <td class="align-middle">{{ $user->getRoleNames()->first() }}</td>
                    <td class="align-middle">{{ $user->visit_num }}</td>
                    <td class="align-middle">

                        {{-- Show User's Details --}}
                        @can('user-show-all')
                            <button type="button" class="btn btn-sm btn-primary font-bold detailsButton"
                                data-name='{{ $user->name }}' data-id='{{ $user->id }}' data-toggle="modal"
                                data-target="#DetailsModal" wire:click="load({{ $user->id }})"><i
                                    class="fas fa-user fa-fw"></i></button>
                        @endcan

                        {{-- Edit User --}}
                        @can('user-edit-all')
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info font-bold"><i
                                    class="fas fa-user-edit fa-fw"></i></a>
                        @endcan

                        {{-- Delete User --}}
                        @can('user-delete-all')
                            <button type="button" class="btn btn-sm btn-danger font-bold deleteButton"
                                data-name='{{ $user->first_name . ' ' . $user->last_name }}'
                                data-id='{{ $user->id }}' data-toggle="modal" data-target="#DeleteModal"
                                wire:click="load({{ $user->id }})"><i class="fas fa-user-times fa-fw"></i></button>
                        @endcan

                        {{-- Edit User Role --}}
                        @can('user-edit-role')
                            <a href="{{ route('admin.users.show.roles', $user->id) }}"
                                class="btn btn-sm btn-warning font-bold"><i class="fas fa-key fa-fw"></i></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light text-primary align-middle">
            <tr>
                <th class="align-middle">Name</th>
                <th class="align-middle">Mail</th>
                <th class="align-middle">Phone</th>
                <th class="align-middle">Gender</th>
                <th class="align-middle">Role</th>
                <th class="align-middle">Visits No.</th>
                <th class="align-middle">Actions</th>
            </tr>
        </tfoot>
    </table>

    <div class="flex justify-between">
        <div>
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
        </div>
        <div>
            {{ $users->links() }}
        </div>

    </div>

    {{-- ------------------------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------------------------ --}}

    <!-- Details Modal -->
    <div class="modal fade bd-example-modal-xl" id="DetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="datailsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white font-bold">
                    <h5 class="modal-title" id="datailsModalCenterTitle">User's Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center bg-gray-200 px-1 py-3">
                    <div class="row">
                        <div class="col-lg-8 pl-3">
                            <div class="bg-white rounded-xl py-3">

                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-lg-12 text-center h3 mb-3" id="userName">
                                        {{ $this->name }}
                                    </div>

                                    {{-- Images --}}
                                    <div class="col-lg-3 px-3 mb-3 border-l-2 border-gray-100">
                                        <div id="userImages" style="height: 100%">
                                            <div class="single_slide">
                                                <img src="{{ asset('images/' . $this->image) }}" style="margin: auto"
                                                    draggable="false">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Other Details 1 --}}
                                    <div class="col-lg-9">
                                        <div class="row">

                                            {{-- Country --}}
                                            <div class="col-lg-12 mb-2">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-900 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Country</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-900 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userCountry">
                                                            {{ $this->country }} </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Email --}}
                                            <div class="col-lg-12 mb-2">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-800 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Email</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-800 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userEmail">
                                                            {{ $this->mail }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-700 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Phone</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-700 py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100" id="userPhone">
                                                            {{ $this->phone }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Gender --}}
                                            <div class="col-lg-12 mb-2 origin">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-5 bg-gray-600 text-white rounded-l font-bold py-1 overflow-hidden flex items-center">
                                                        <span class="text-center w-100">Gender</span>
                                                    </div>
                                                    <div
                                                        class="col-lg-7 bg-white rounded-r border-2 border-gray-600 py-1 overflow-hidden flex items-center">
                                                        <div class="text-center w-100" id="userGender">
                                                            {{ $this->gender }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pr-3 pl-1">
                            <div class="bg-white rounded-xl p-3">
                                <div class="row">

                                    {{-- Visits Number --}}
                                    <div class="col-lg-6 mb-2">
                                        <div class="bg-indigo-900 text-white rounded-t font-bold py-1">
                                            Visits Number
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-900 py-1"
                                            id="userVisitNum">
                                            {{ $this->visit_num }}
                                        </div>
                                    </div>

                                    {{-- Verified Mail --}}
                                    <div class="col-lg-6 mb-2 origin">
                                        <div class="bg-indigo-800 text-white rounded-t font-bold py-1">
                                            Verified Mail
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-800 py-1"
                                            id="userVerifiedMail">
                                            {{ $this->verified_mail }}
                                        </div>
                                    </div>

                                    {{-- Last Visit Date --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-700 text-white rounded-t font-bold py-1">
                                            Last Visit Date
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-700 py-1"
                                            id="userLastVisit">
                                            {{ $this->last_visit }}
                                        </div>
                                    </div>

                                    {{-- Created at --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-600 text-white rounded-t font-bold py-1">
                                            Created at
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-600 py-1"
                                            id="userCreatedAt">
                                            {{ $this->created_at }}
                                        </div>
                                    </div>

                                    {{-- Last Updated --}}
                                    <div class="col-lg-12 mb-2 origin">
                                        <div class="bg-indigo-500 text-white rounded-t font-bold py-1">
                                            Last Updated at
                                        </div>
                                        <div class="bg-white rounded-b border-2 border-indigo-500 py-1"
                                            id="userLastUpdatedAt">
                                            {{ $this->updated_at }}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex justify-center">
                    <button type="button" class="btn btn-danger font-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Details Modal -->

    {{-- ------------------------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------------------------ --}}

    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white font-bold">
                    <h5 class="modal-title" id="deleteModalCenterTitle">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are You Sure, You Want To Delete '<span id="deletedItemName"
                        class="font-bold">{{ $this->name }}</span>' ?
                </div>
                <div class="modal-footer flex justify-between">
                    <button type="button" class="btn btn-secondary font-bold" data-dismiss="modal">Cancel</button>
                    @if ($this->user_id != '')

                        <form action="{{ route('admin.users.destroy', $this->user_id) }}" id="deleteForm"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger font-bold">Delete</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->

</div>
