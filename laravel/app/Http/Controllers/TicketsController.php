<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\ticketMailer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Catagory;
use App\Ticket;

class TicketsController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('ticket-index')) {
            $tickets = Ticket::orderBy('created_at', 'desc')
                ->where('status', '=', 'Open')
                ->paginate(10);

            $tickets->closed = Ticket::where('status', '=', 'Gesloten')->count();
            $tickets->open = $tickets->where('status', '=', 'Open')->count();

            return view('tickets.index', compact('tickets'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $catagories = Catagory::all();
        return view('tickets.create', compact('catagories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, ticketMailer $mail)
    {
        $this->validate($request, [
            'title' => 'required',
            'catagory' => 'required',
            'priority' => 'required',
            'content' => 'required',
        ]);

        $tickets = new Ticket();
        $tickets->name = $request->input('name');
        $tickets->email = $request->input('email');
        $tickets->phone = $request->input('phone');
        $tickets->title = $request->input('title');
        $tickets->ticket_id = strtoupper(Str::random(10));
        $tickets->category_id = $request->input('catagory');
        $tickets->priority = $request->input('priority');
        $tickets->content = $request->input('content');
        $tickets->status = "Open";

        $tickets->save();
        $mail->sendTicketInformation($tickets->email, $tickets);

        return redirect('/')->with('success', "Een ticket met ID: $tickets->ticket_id is geopend");
    }

    public function show($ticket_id)
    {
        if(auth()->user()->can('ticket-show')) {
            $tickets = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $catagory = $tickets->catagory;

            return view('tickets.show', compact('tickets', 'catagory'));
        }
    }

    /**
     * Close ticket without destroying
     *
     * @param App\Mail\ticketMailer
     * @param ticketMailer $mail
     * @return \Illuminate\Http\RedirectResponse
     * @sendTicketStatusNotification
     */

    public function closeTicket($ticket_id, ticketMailer $mail)
    {
        if(auth()->user()->can('ticket-destroy')) {
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $ticket->update(['status' => 'Gesloten']);

            $ticketOwn = $ticket->email;

            $mail->sendTicketStatusNotification($ticketOwn, $ticket);


            return redirect('/tickets')->with('success', 'Ticket is gesloten!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($ticket_id)
    {
        if(auth()->user()->can('ticket-destroy')) {
            $tickets = Ticket::find($ticket_id);
            $tickets->delete();

            return redirect('/tickets')->with('success', 'Ticket is verwijderd!');
        }
    }
}
