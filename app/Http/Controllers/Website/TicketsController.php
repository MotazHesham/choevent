<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketUser;
use App\Models\User;
use App\Models\Configration;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Ticket as TicketMail;
use Auth;
use Carbon\Carbon;
use App\Traits\NoonPaymentTrait;

class TicketsController extends Controller
{
    use NoonPaymentTrait;
     public function index($id=0){
        
        $events=Event::where('publish',1)->has('activeTickets')
                ->orderBy('id','desc')->get();
     
        return view('website.tickets.index',compact('events','id'));
    }

    public function getEventTickets(Request $request){
        $event=Event::find($request->id);
        return $event->activeTickets;
    }
    
    public function show($id){
        return Ticket::find($id);
    }

    public function create($id){
        $event=Event::find($id);
        $user=Auth::user();
        $tickets=Ticket::where('event_id',$event->id)->get();
       return view('website.tickets.create',compact('event','tickets','user'));
   }

    public function store(Request $request){
    
        $ticket = Ticket::create($request->input());
        return redirect()->back()->with('success-msg','تم إضافة تذكرتك بنجاح');

    }

    public function payPage(Request $request){

        $event=Event::find($request->event_id);
        $tickets_count=$request->tickets_count;
        $ticket=Ticket::find($request->ticket_id);
        $merchant=now()->getTimestamp();
        $ticketUser=TicketUser::where('user_id',Auth::id())
               ->where('ticket_id',$ticket->id)->where('paid',1)->first();
        if($ticketUser){

            return ['error'=>1,'msg'=>'لقد قمت بشراء تذكرة لنفس الفعالية من قبل'];
        }
        $ticket->users()->attach([Auth::id()=>['count'=>$tickets_count,
                'marchent_id'=>$merchant,'created_at'=>now()]]);
        $vat=Configration::where('item','vat')->first()->value;
        $vat_value=$vat*$ticket->price/100;
       
        if($request->coupon_code){
           $coupon_discount_value=0;
            $coupon=Coupon::where('code',$request->coupon_code)->first();
            if($coupon){
                if($coupon->type=='ticket'||$coupon->type=='all'){
                    $coupon_discount=$coupon->discount;
                    $coupon_discount_value=$ticket->price*$coupon_discount/100;
                }
            }

        }
        $total=$ticket->price+$vat_value-$coupon_discount_value;
      
        return $this->initiate("$merchant",$total,'ticket',url('api/tickets/payments/feedback'));
    }
    
    public function getPaymentFeedback(Request $request){

        $orderResponse= $this->getOrder($request->orderId);
        $ticketUser=TicketUser::where('marchent_id',$request->merchantReference)->first();
        $ticketUser->order_response=$orderResponse;
        $ticketUser->init_response=$request->input();
        $ticketUser->save();
        if($orderResponse['result']['order']['status']=='3DS_RESULT_VERIFIED'){
            $ticketUser->paid=$orderResponse['result']['order']['amount'];
            $ticketUser->save();
            // Mail::to(Auth::user())->send(new TicketMail($event,$ticket,$tickets_count));
        }
        return redirect()->route('website.home');
        //4000000000000002
    
    }

    public function generateQRCode(){
        return view('website.tickets.QR_code');
    }

    public function destroy($id){
        $ticket=Ticket::find($id);
        $ticket->delete();
        return redirect()->back()->with('success-msg','تم حذف تذكرتك بنجاح');
    }

    public function verifyTicket($user_id,$event_id){
        
        $user=User::find($user_id);
        $ticket=$user->tickets->where('event_id',$event_id)->last();
        $used_at=$ticket->pivot->used_at;
        if($used_at){
            $status=false;
            $used_date=(new Carbon($used_at))->format('Y-m-d');
            $used_time=(new Carbon($used_at))->format('H:i');
            $title='دخول غير مصرح به';
            $msg="تم تسجيل الدخول بهذه التذكرة من قبل فى تاريخ :" .$used_date.
                    "  فى تمام الساعة : ". $used_time;
        }else{
            $status=true;
            $title="دخول مصرح به";
            $msg="";
            $user->tickets()->syncWithoutDetaching([$ticket->id => ['used_at' => now()]]);
            

        }
        return view('website.tickets.verify',compact('status','msg','title'));
            
    }
   
}
