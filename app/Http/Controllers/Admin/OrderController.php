<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $type=$request->type??'sponsoring';
        $orders = Order::where('type', $type)->get();

        return view('admin.orders.'.$type.'.index', compact('orders'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::where('type','service')->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_organizers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $type=$request->type??'sponsoring';
        return view('admin.orders.'.$type.'.create', compact('events', 'categories', 'event_organizers', 'service_providers', 'sponsers'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $order->id]);
        }
        $type=$order->type;
        return redirect()->route('admin.orders.index',['type'=>$type]);
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::where('type','service')->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_organizers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('event', 'category', 'service_provider', 'sponser');
        $type=$order->type;
        return view('admin.orders.'.$type.'.edit', compact('events', 'categories', 'event_organizers', 'service_providers', 'sponsers', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
        $type=$order->type;
        return redirect()->route('admin.orders.index',['type'=>$type]);
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('event', 'category',  'service_provider', 'sponser');
        $type=$order->type;
        return view('admin.orders.'.$type.'.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('order_create') && Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Order();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
