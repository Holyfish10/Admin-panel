<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Timer;
use App\Projects;
use App\Invoice;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clients = Client::orderBy('id')->where('user_id', '=',auth()->user()->id)->paginate(10);
        $invoice = Invoice::all();
        $test = Invoice::where('status', '=', 2)->count();

        return view('clients.index', compact('clients', 'test', 'invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'company' => '',
           'name' => '',
           'lastname' => '',
           'email' => '',
           'telephone' => '',
           'street' => '',
           'postcode' => '',
           'city' => '',
           'vat' => '',
		   'user_id' => '',
        ]);

        $client = new Client;
        $client->company = $request->input('company');
        $client->name = $request->input('name');
        $client->lastname = $request->input('lastname');
        $client->email = $request->input('email');
        $client->telephone = $request->input('telephone');
        $client->street = $request->input('street');
        $client->zipcode = $request->input('zipcode');
        $client->city = $request->input('city');
        $client->vat = $request->input('vat');
		$client->user_id = auth()->user()->id;

        $client->save();

        return redirect('/clients')->with('success', 'Klant is aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $clients = Client::findOrFail($id);
        $clients->invoices;

        $invoice = Invoice::find($id);

        return view('clients.show', compact('clients', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $clients = Client::all();

        return view('clients.edit', compact('client', 'clients'));
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
            'company' => '',
            'name' => '',
            'lastname' => '',
            'email' => '',
            'telephone' => '',
            'street' => '',
            'postcode' => '',
            'city' => '',
            'vat' => '',
			'user_id' => '',
        ]);

        $client = Client::findOrFail($id);

        if(!empty($request->input('client_name'))) {
            $client->name = $request->input('client_name');
        } else {
            $client->name = $request->input('client_name');
        }


        $client->company = $request->input('company');
        $client->lastname = $request->input('lastname');
        $client->email = $request->input('email');
        $client->telephone = $request->input('telephone');
        $client->street = $request->input('street');
        $client->zipcode = $request->input('zipcode');
        $client->city = $request->input('city');
        $client->vat = $request->input('vat');
		$client->user_id = auth()->user()->id;

        $client->save();

        return redirect('/clients')->with('success', 'Klant is bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return view('clients.index')->with('success', 'Klant is verwijderd');
    }

    /**
     * Remove bulk resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroyClients(Request $request)
    {
        $clients = $request->ids;

        Client::whereIn('id',explode(",",$clients))->delete();

        return response()->json(['status'=>true,'success'=>"Klanten zijn verwijderd."]);
    }
}
