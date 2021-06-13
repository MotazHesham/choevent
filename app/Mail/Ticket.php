<?php

namespace App\Mail;
use App\Models\Event;
use App\Models\Ticket as TicketModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class Ticket extends Mailable
{
    use Queueable, SerializesModels;

    protected $event;
    protected $user;
    protected $count;
    protected $link;
    protected $ticket;
    protected $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event,TicketModel $ticket,$count=1)
    {
     
            
        $this->logo=url('images/logo.png');
        $this->event=$event;
        $this->ticket=$ticket;
        $this->user=Auth::user();
        $this->count=$count;
        $this->link= route('website.tickets.verify',['user_id'=>Auth::id(),'event_id'=>$event->id]);//"$count.'عدد الحضور على التذكرة'.$event->name.'تذكرة حضور فعالية'";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.ticket') ->with([
            'event' => $this->event,
            'ticket'=>$this->ticket,
            'user'=>$this->user,
            'count'=>$this->count,
            'message'=>'message',
            'link'=>$this->link,
            'logo'=>$this->logo
           
        ]);;
    }
}
