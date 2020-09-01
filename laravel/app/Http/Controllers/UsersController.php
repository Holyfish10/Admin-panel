<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\Hash;
use App\Role;
use Illuminate\Support\Facades\DB;

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
            ]);

            $user = User::find($id);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

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
}
