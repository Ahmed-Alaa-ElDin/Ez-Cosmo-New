<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\Users\UsersExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Rules\OldPassword;
use Illuminate\Support\Facades\Hash;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user-create')->only('create', 'store');
        $this->middleware('can:user-show-all')->only('index', 'showJSON');
        $this->middleware('can:user-edit-role')->only('showRoles', 'updateRoles');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        session(['old_route' => route('admin.users.index')]);

        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $roles = Role::all();

        return view('admin.users.create', compact('countries', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name = 'default_profile.png';

        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'max:50',
            'gender' => 'required',
            'phone' => 'nullable|numeric',
            'country_id' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|max:191',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->profile_photo) {
            $req_image = $request->profile_photo;
            $image_name = 'profile-' . rand() . '.' . $req_image->getClientOriginalExtension();
            $req_image->move(public_path('images'), $image_name);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo' => $image_name,
            'visit_num' => 0
        ]);

        if ($request->role != null) {
            $user->assignRole($request->role);
        } else {
            $user->assignRole('User');
        }


        $old_route = session('old_route') ? session('old_route') : route('admin.users.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "'$request->first_name $request->last_name' Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->user()->hasPermissionTo('user-show-all') || auth()->id() == $user->id) {

            return view('admin.users.show', compact('user'));
        } else {

            return abort(403);
        }
    }

    public function showJSON($id)
    {
        $user = User::with('country')->find($id);

        return response()->json(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->hasPermissionTo('user-edit-all') || auth()->id() == $user->id) {

            $countries = Country::all();

            return view('admin.users.edit', compact('user', 'countries'));
        } else {

            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('user-edit-all') || auth()->id() == $user->id) {

            $user = User::findOrFail($id);

            $old_pass = $user->password;

            $request->validate([
                'first_name' => 'required|max:50',
                'last_name' => 'max:50',
                'gender' => 'required',
                'phone' => 'nullable|numeric',
                'country_id' => 'required',
                'email' => 'required|unique:users,email,' . $user->id . '|max:191',
            ]);

            if ($request->old_password && ($request->new_password || $request->password_confirmation)) {
                $request->validate([
                    'old_password' => ['required', new OldPassword($user->id)],
                    'new_password' => 'required|different:old_password|confirmed',
                    'new_password_confirmation' => 'required',
                    Hash::make('new_password') => 'different:password'
                ]);

                $new_pass = Hash::make($request->new_password);
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'email' => $request->email,
                'password' => isset($new_pass) ? $new_pass : $old_pass,
            ]);

            if ($user->id == Auth::id()) {

                return redirect()->route('admin.users.show', $user->id)->with('success', "'$request->first_name $request->last_name' Updated Successfully");
            } else {

                $old_route = session('old_route') ? session('old_route') : route('admin.users.index');

                session()->forget('old_route');

                return redirect($old_route)->with('success', "'$request->first_name $request->last_name' Updated Successfully");
            };
        } else {

            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->hasPermissionTo('user-delete-all') || auth()->id() == $user->id) {

            $user->delete();

            $old_route = session('old_route') ? session('old_route') : route('admin.users.index');

            session()->forget('old_route');

            return redirect($old_route)->with('success', "'$user->first_name $user->last_name' Deleted Successfully");
        } else {

            return abort(403);
        }
    }

    public function updateProfilePhoto($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->file) {
            $req_image = $request->file;
            $image_name = 'profile-' . rand() . '.' . $req_image->getClientOriginalExtension();
            $req_image->move(public_path('images'), $image_name);

            $user->update([
                'profile_photo' => $image_name
            ]);

            return response()->json([
                'success' => 'New Image Added Successfully',
                'image' => $image_name
            ]);
        }
    }

    public function deleteProfilePhoto($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'profile_photo' => 'default_profile.png'
        ]);

        return response()->json([
            'success' => 'Old Image Deleted Successfully'
        ]);
    }

    public function showRoles($id)
    {

        $user = User::find($id);

        $roles = Role::all();

        $permissions = Permission::all();

        $currentPermissions = $user->getPermissionsViaRoles()->pluck('id')->toArray();

        return view('admin.users.roles', compact('user', 'roles', 'permissions', 'currentPermissions'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required',
        ]);

        $user->syncRoles(Role::find($request->role));

        $old_route = session('old_route') ? session('old_route') : route('admin.users.index');

        session()->forget('old_route');

        return redirect($old_route)->with('success', "$user->first_name $user->last_name\'s Role Updated Successfully");
    }

    // Export Excel File
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'Users.xlsx');
    }

    // Export PDF File
    public function exportPDF()
    {
        return Excel::download(new UsersExport, 'Users.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
