<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBoothDetailRequest;
use App\Http\Requests\StoreBoothDetailRequest;
use App\Http\Requests\UpdateBoothDetailRequest;
use App\Models\Booth;
use App\Models\BoothDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoothDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booth_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boothDetails = BoothDetail::all();

        return view('admin.boothDetails.index', compact('boothDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('booth_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booths = Booth::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.boothDetails.create', compact('booths'));
    }

    public function store(StoreBoothDetailRequest $request)
    {
        $boothDetail = BoothDetail::create($request->all());

        return redirect()->route('admin.booth-details.index');
    }

    public function edit(BoothDetail $boothDetail)
    {
        abort_if(Gate::denies('booth_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booths = Booth::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boothDetail->load('booth');

        return view('admin.boothDetails.edit', compact('booths', 'boothDetail'));
    }

    public function update(UpdateBoothDetailRequest $request, BoothDetail $boothDetail)
    {
        $boothDetail->update($request->all());

        return redirect()->route('admin.booth-details.index');
    }

    public function show(BoothDetail $boothDetail)
    {
        abort_if(Gate::denies('booth_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boothDetail->load('booth');

        return view('admin.boothDetails.show', compact('boothDetail'));
    }

    public function destroy(BoothDetail $boothDetail)
    {
        abort_if(Gate::denies('booth_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boothDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoothDetailRequest $request)
    {
        BoothDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
