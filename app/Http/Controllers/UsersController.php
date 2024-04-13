<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index()
    {
        //
        return view('admin.setup.users.sysusers-index', [
            'users' => $this->getUsers(),
        ]);
    }

    private function getUsers()
    {
        return User::where('user_role', '<>', 'BRANCH_PASTOR')->orderBy('name')->get();
    }

    public function create()
    {
        return view(
            'admin.setup.users.sysusers-create',
            [
                'divisionsCombo' => $this->getDivisions(),
                'roles' => ['SYS_ADMIN', 'ZONAL_OVERSEER', 'DIVISIONAL_OVERSEER'],
            ]
        );
    }
    protected function getDivisions()
    {
        return Division::orderBy('division_name')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $this->FormValidation($request);
        $attributes['password'] = bcrypt('perezchapel');
        $attributes['user_status'] = 'New';

        User::create($attributes);
        return back()->with(['success' => 'User (' . $attributes['name'] . ') saved successfully ']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == 1)
            return back()->with("errormessage", "Default User cannot be deleted");

        if ($user->user_status == "Active") {
            return back()->with("errormessage", "Active User cannot be deleted");
        }
        $user->delete();

        return back()->with('success', 'User Deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view(
            'admin.setup.users.sysusers-edit',
            [
                'user' => $user,
                'divisionsCombo' => $this->getDivisions(),
                'roles' => ['SYS_ADMIN', 'ZONAL_OVERSEER', 'DIVISIONAL_OVERSEER'],
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    /*   public function update(Request $request, Zone $user)
    {

        $attributes = $this->FormValidation($request, $user);

        $user->update($attributes);

        return back()->with('success', 'Zone (' . $attributes['zone_name'] . ') Updated!');
    } */



    protected function FormValidation(Request $request, ?User $user = null): array //defalut is null, ? indeciates its optopnal
    {
        $user ??= new User();
        $attributes =   $request->validate([
            'name' => 'required|min:4|max:250',
            'email' => ['required', 'min:4', Rule::unique('users', 'email')->ignore($user)],
            //'password' => 'required',
            'user_role' => 'required',
            // 'user_role_id' => 'nullable',
            //'division_id' => 'required',
            //'zone_id'=>'nullable'
        ]);

        if ($attributes['user_role'] == 'SYS_ADMIN') {
            $attributes['user_role_id'] = '';
        } else if ($attributes['user_role'] == 'DIVISIONAL_OVERSEER') {
            $data = $request->validate([
                'division_id' => ['required', Rule::exists('divisions', 'id')],
            ]);
            $attributes['user_role_id'] = $data['division_id'];
        } elseif ($attributes['user_role'] == 'ZONAL_OVERSEER') {
            $dataz = $request->validate([
                'zone_id' => ['required', Rule::exists('zones', 'id')],
            ]);
            $attributes['user_role_id'] = $dataz['zone_id'];
        }

        return $attributes;
    }

    public function resetPassword(User $user)
    {
        if ($user == null) return;
        //add comments to a given post
        $user->update(
            [
                'password' => bcrypt('perezchapel'),
                'user_status' => 'New'
            ]
        );

        return back()->with('success', 'Password Reset Successfully !');
    }

}
