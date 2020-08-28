<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        return $this->middleware('developer');
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id')->paginate(10);
        $users->all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:users,name',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|confirmed|min:6',
           'created_at' => '',
           'last_login' => '',
           'role' => '',
        ]);

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->created_at = Carbon::now();
        $user->last_login = Carbon::now();
        $user->role = $request->input('role');

        $user->save();

        return redirect('/users')->with('success', 'Gebuiker is aangemaakt');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
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
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'confirmed:min6',
            'role' => '',
        ]);

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role = $request->input('role');

        $user->save();

        return redirect('/users')->with('success', 'Gebuiker is bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'Gebruiker is verwijderd');
    }
}
