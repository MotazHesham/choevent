<?php

namespace App\Mail;
use App\Models\Event;
use App\Models\BoothDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class BoothMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $event;
    protected $user;
    protected $booth;
    protected $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event,BoothDetail $booth)
    {
     
            
        $this->logo=url('images/logo.png');
        $this->event=$event;
        $this->booth=$booth;
        $this->user=Auth::user();
   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.booth') ->with([
            'event' => $this->event,
            'booth'=>$this->booth,
            'user'=>$this->user,
            'logo'=>$this->logo
           
        ]);;
    }
}
