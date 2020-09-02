<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\Projects;
use App\Timer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $invoices = Auth::user()->invoices;
        $test = Invoice::where('status', '=', 2);

        return view('invoices.index', compact('invoices', 'test'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $clients = Client::all();
        return view('invoices.create', compact('clients'));
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
            'client_id' => '',
            'user_id' => '',
            'name' => '',
            'item' => '',
            'description' => '',
            'amount' => '',
            'tax' => '',
            'discount' => '',
            'status' => '',
            'total' => '',
        ]);

        $invoice = new Invoice;

        if(!empty($request->client_id)) {
            $invoice->client_id = $request->input('client_id');
            $invoice->name = '';
        } else {
            $invoice->client_id = 0;
            $invoice->name = $request->input('name');
        }
        $invoice->user_id = Auth::user()->id;
        $invoice->description = $request->input('description');
        $invoice->amount = $request->input('amount');
        $invoice->tax = $invoice->tax != 0 ? $request->input('tax') : 0;
        $invoice->discount = $invoice->discount != 0 ? $request->input('discount') : 0;
        $invoice->total = $request->input('total');
        $invoice->status = $request->input('status');
        $item = $request->get('item');
        $itemStr = serialize( $item );
        $invoice->item = $itemStr;

        $description = $request->get('description');
        $descStr = serialize( $description );
        $invoice->description = $descStr;

        $amount = $request->get('amount');
        $amountStr = serialize( $amount );
        $invoice->amount = $amountStr;

        $invoice->save();

        return redirect('/invoices')->with('success', 'Factuur is aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show($id)
    {
        $clients = Client::find($id);
        $invoice = Invoice::find($id);

        if($invoice->user->wage == 0) {
            return redirect('error');
        } else {
            return view('invoices.show', compact('clients', 'invoice'));
        }
    }

    /**
     * @param $time
     * @return float|int|mixed
     */

    public function decimalhours($time) {
        $hms = explode(":", $time);
        return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $clients = Client::all();
        $projects = Projects::all();
        $timer = Timer::all();

        foreach($invoice->timers as $key => $value) {
            $from = new Carbon($value->created_at);
            $to = new Carbon($value->stopped_at);

            $hms = $from->diff($to)->format('%H:%I:%S');

            $decimal = number_format($this->decimalHours($hms), 2, '.', '');

            if(isset($decimal)) {
                return view('invoices.edit', compact('invoice', 'clients', 'projects', 'timer', 'decimal'));
            }
        }
        return view('invoices.edit', compact('invoice', 'clients', 'projects', 'timer'));
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
            'client_id' => '',
            'user_id' => '',
            'project_id' => '',
            'name' => '',
            'item' => '',
            'description' => '',
            'amount' => '',
            'tax' => '',
            'discount' => '',
            'status' => '',
            'total' => '',
        ]);

        $invoice = Invoice::findOrFail($id);

        if(!empty($request->project_id)) {
            $invoice->project_id = $request->input('project_id');

            $invoice->item = '';
            $invoice->description = '';
            $invoice->amount = '';
        } else {
            $invoice->project_id = 0;

            $invoice->item = $request->input('item');
            $invoice->description = $request->input('description');
            $invoice->amount = $request->input('amount');
            $invoice->total = $request->input('total');

            $item = $request->get('item');
            $itemStr = serialize( $item );
            $invoice->item = $itemStr;

            $description = $request->get('description');
            $descStr = serialize( $description );
            $invoice->description = $descStr;

            $amount = $request->get('amount');
            $amountStr = serialize( $amount );
            $invoice->amount = $amountStr;

            if(empty($item) && empty($description) && empty($amount)) {
                $invoice->item = '';
                $invoice->description = '';
                $invoice->amount = '';
            }
        }

        if(!empty($request->client_id)) {
            $invoice->client_id = $request->input('client_id');
            $invoice->name = '';
        } else {
            $invoice->client_id = 0;
            $invoice->name = $request->input('name');
        }


        $invoice->user_id = Auth::user()->id;
        $invoice->tax = $invoice->tax != 0 ? $request->input('tax') : 0;
        $invoice->discount = $invoice->discount != 0 ? $request->input('discount') : 0;
        $invoice->status = $request->input('status');


        $invoice->save();

        return redirect('/invoices')->with('success','Factuur is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        return back()->with('success', 'Factuur is verwijderd');
    }

    /**
     * Remove bulk resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        $invoices = $request->ids;

        Invoice::whereIn('id',explode(",",$invoices))->delete();

        return response()->json(['status'=>true,'success'=>"Facturen zijn verwijderd."]);
    }

    public function downloadPDF($id)
    {
        $invoice = Invoice::find($id);

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download(date('Y') . '-' . $id . '.pdf');
    }
}
