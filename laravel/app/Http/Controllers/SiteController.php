<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Sites;
use Illuminate\Validation\ValidationException;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $sites = Sites::orderBy('created_at', 'desc')->paginate(10);
        $site = Sites::all();
        return view('sites.index', compact('sites', 'site'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => '',
           'description' => '',
           'website' => '',
           'image' => '',
           'user_id' => '',
        ]);

        $site = new Sites;
        $site->title = $request->input('title');
        $site->description = $request->input('description');
        $site->website = $request->input('website');
        if(!empty($request->input('image'))) {
            $site->image = $request->input('image');
        } else {
            $site->image = '';
        }
        $site->client_id = NULL;
        $site->user_id = auth()->user()->id;

        $site->save();

        return redirect('sites')->with('succes', 'Website is aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $sites = Sites::findOrFail($id);
        return view('sites.show', compact('sites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $sites = Sites::findOrFail($id);
        return view('sites.edit', compact('sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => '',
            'description' => '',
            'image' => '',
            'user_id' => '',
        ]);

        $site = Sites::findOrFail($id);
        $site->title = $request->input('title');
        $site->description = $request->input('description');
        if(!empty($request->input('image'))) {
            $site->image = $request->input('image');
        } else {
            $site->image = '';
        }
        $site->user_id = auth()->user()->id;

        $site->save();

        return redirect('sites/'.$site->id)->with('success', 'Website is bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $site = Sites::findOrFail($id);
        $site->delete();

        return redirect('sites')->with('success', 'Website is verwijderd');
    }
}
