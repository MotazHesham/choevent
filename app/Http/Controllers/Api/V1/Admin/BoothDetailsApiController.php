<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoothDetailRequest;
use App\Http\Requests\UpdateBoothDetailRequest;
use App\Http\Resources\Admin\BoothDetailResource;
use App\Models\BoothDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoothDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booth_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoothDetailResource(BoothDetail::with(['booth'])->get());
    }

    public function store(StoreBoothDetailRequest $request)
    {
        $boothDetail = BoothDetail::create($request->all());

        return (new BoothDetailResource($boothDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BoothDetail $boothDetail)
    {
        abort_if(Gate::denies('booth_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoothDetailResource($boothDetail->load(['booth']));
    }

    public function update(UpdateBoothDetailRequest $request, BoothDetail $boothDetail)
    {
        $boothDetail->update($request->all());

        return (new BoothDetailResource($boothDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BoothDetail $boothDetail)
    {
        abort_if(Gate::denies('booth_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boothDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
