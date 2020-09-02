<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->user()->can('user-index')) {
            $users = User::orderBy('id')->paginate(10);
            $users->all();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if($request->user()->can('user-create')) {
            return view('users.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if($request->user()->can('user-create')) {
            $this->validate($request, [
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'created_at' => '',
                'last_login' => '',
            ]);

            $user = new User;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->created_at = Carbon::now();
            $user->last_login = Carbon::now();

            $user->save();

            $role = $request->get('role');
            $roles = new Role;
            $roles->users()->attach($user->id, ['role_id' => $role]);

            return redirect('/users')->with('success', 'Gebuiker is aangemaakt');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if($request->user()->can('user-edit')) {
            $user = User::findOrFail($id);

            return view('users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if($request->user()->can('user-edit')) {
            $this->validate($request, [
                'name' => '',
                'email' => '',
                'password' => 'confirmed:min6',
                'wage' => '',
                'vat' => '',
            ]);

            $user = User::find($id);

            if(!empty($request->input('name'))) {
                $user->name = $request->input('name');
            }

            if(!empty($request->input('email'))) {
                $user->email = $request->input('email');
            }

            if(!empty($request->input('wage'))) {
                $user->wage = $request->input('wage');
            }

            if(!empty($request->input('vat'))) {
                $user->vat = $request->input('vat');
            }

            $user->save();

            DB::table('users_roles')
                ->where('user_id', $user->id)
                ->update(['role_id' => $request->get('role')]);

            return redirect('/users')->with('success', 'Gebuiker is bewerkt');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        if($request->user()->can('user-delete')) {
            $user = User::find($id);
            $user->delete();

            return redirect('/users')->with('success', 'Gebruiker is verwijderd');
        }
    }

    public function UserSettings($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $role = DB::table('users_roles')->where('user_id', $user->id)->get();

        foreach($role as $current) {
            $current = [
              'role_id' => $current->role_id,
              'user_id' => $current->user_id,
            ];
        }

        $currentRole = $current;


        return view('users.settings', compact('user', 'roles', 'currentRole'));
    }

    public function editData(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'exists:users,name',
            'email' => 'exists:users,email',
            'password' => 'min:6|confirmed|nullable',
            'wage' => 'numeric|min:0',
            'vat' => 'numeric|min:0',
            'role' => '',
        ]);

        $user = User::findOrFail($id);

        if(!empty($request->input('name'))) {
            $user->name = $request->input('name');
        }

        if(!empty($request->input('email'))) {
            $user->email = $request->input('email');
        }

        if(!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

       $user->wage = $request->input('wage');
       $user->vat = $request->input('vat');



        $user->save();

        if($request->user()->can('user-editRole')) {
            if(!empty($request->input('role'))) {
                DB::table('users_roles')
                    ->where('user_id', $user->id)
                    ->update(['role_id' => $request->get('role')]);
            }
        }

        //return to user settings page
        return redirect()->back()->with('success','Gegevens zijn bijgewerkt');
    }
}
