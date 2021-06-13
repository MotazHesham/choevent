<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOfferRequest;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $type=$request->type??'sponsoring';
       if($type=='sponsoring'){
        $offers = Offer::where('service_provider_id', null)->get();
       }else{
        $offers = Offer::where('sponsor_id', null)->get();
       }
         return view('admin.offers.'.$type.'.index', compact('offers'));
    }

    public function create()
    {
        abort_if(Gate::denies('offer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.offers.create', compact('orders', 'service_providers', 'sponsers'));
    }

    public function store(StoreOfferRequest $request)
    {
        $offer = Offer::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $offer->id]);
        }

        return redirect()->route('admin.offers.index');
    }

    public function edit(Offer $offer)
    {
        abort_if(Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offer->load('order', 'service_provider', 'sponser');

        return view('admin.offers.edit', compact('orders', 'service_providers', 'sponsers', 'offer'));
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer->update($request->all());

        return redirect()->route('admin.offers.index');
    }

    public function show(Offer $offer)
    {
        abort_if(Gate::denies('offer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer->load('order', 'service_provider', 'sponser');

        return view('admin.offers.show', compact('offer'));
    }

    public function destroy(Offer $offer)
    {
        abort_if(Gate::denies('offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfferRequest $request)
    {
        Offer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('offer_create') && Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Offer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
