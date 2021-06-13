<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Configration;
use Spatie\MediaLibrary\Models\Media;
use Auth;
use Validator;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Website\RegisterRequest;
use App\Traits\ResponseFormatTrait;
use App\Traits\SendSmsTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Traits\NoonPaymentTrait;


class RegisterController extends Controller
{
    use NoonPaymentTrait;

    use MediaUploadingTrait,ResponseFormatTrait,SendSmsTrait;
    public function getRegisterPage(){

        $services = Category::where('type','service')->pluck('name', 'id');
        return view('website.auth.register',compact('services'));
    }

    public function validateRegisterRequest(RegisterRequest $request){
        return ['error'=>0];

    }
    public function register(Request $request)
    {
        // TODO:validate
        $input=$request->all();
        $code=rand(000000,999999);
        $input['code']=$code;
        $input['active']=($request->group=='user')?1:0;
        event(new Registered($user = User::create($input)));
        $user->services()->sync($request->input('services', []));
        if ($request->input('avatar', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        
        $this->guard()->login($user);
        $number='966'.substr($user->mobile,1);
        $msg="كود التفعيل".$code;
        $this->sendSMS($number, $msg);
        if($user->group=='organizer'||$user->group=='provider'){
            $register_fee=Configration::where('item',$user->group.'_register')->first()->value;
            $merchant=now()->getTimestamp();
            $user->marchent_id=$merchant;
            $user->save();
            $paymentResponse= $this->initiate("$merchant", $register_fee,"$user->group",url('api/users/payments/feedback'));
            return redirect()->to($paymentResponse['result']['checkoutData']['postUrl']);
        }
        return redirect()->route('website.home');
    }

    public function getPaymentFeedback(Request $request){
        $orderResponse= $this->getOrder($request->orderId);
        $user=User::where('marchent_id',$request->merchantReference)->first();
        $user->order_response=$orderResponse;
        $user->init_response=$request->input();
        if($orderResponse['result']['order']['status']=='3DS_RESULT_VERIFIED'){
            $user->paid=$orderResponse['result']['order']['amount'];
            $user->save();
        }
        
        return redirect()->route('website.home');
        //4000000000000002 

    }

     protected function guard()
    {
        return Auth::guard();
    }
    
    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    

}