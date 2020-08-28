<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
Use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => '',
           'user_id' => '',
           'status' => '',
        ]);

        $todo = new Todo;
        $todo->name = $request->input('name');
        $todo->user_id = Auth::user()->id;
        $todo->status = $request->input('status');

        $todo->save();

        return redirect('/')->with('success', 'Todo is aangemaakt');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        return $todo;
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
           'name' => '',
           'status' => '',
           'user_id' => '',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->name = $request->input('name');
        $todo->user_id = Auth::user()->id;
        $todo->status = $request->input('status');

        $todo->save();

        return redirect('/')->with('success', 'Todo is bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect('/')->with('success', 'Todo is verwijderd');
    }
}
