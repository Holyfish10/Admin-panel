<?php

namespace App\Mail;

use App\Ticket;
use Illuminate\Contracts\Mail\Mailer;

class ticketMailer {
    protected $mailer;
    protected $fromAddress = 'jdebdev091994@gmail.com';
    protected $fromName = 'Support ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->fromAddress, $this->fromName)->to($this->to)->subject($this->subject);
        });
    }

    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title ";
        $this->view = 'emails.ticket-info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function sendTicketStatusNotification($ticketOwn, Ticket $ticket)
    {
        $this->to = $ticketOwn;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket-status';
        $this->data = compact('ticketOwn', 'ticket');

        return $this->deliver();
    }

}
