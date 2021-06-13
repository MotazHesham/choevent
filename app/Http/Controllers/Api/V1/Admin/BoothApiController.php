<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBoothRequest;
use App\Http\Requests\UpdateBoothRequest;
use App\Http\Resources\Admin\BoothResource;
use App\Models\Booth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoothApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('booth_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoothResource(Booth::with(['event'])->get());
    }

    public function store(StoreBoothRequest $request)
    {
        $booth = Booth::create($request->all());

        if ($request->input('image', false)) {
            $booth->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new BoothResource($booth))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Booth $booth)
    {
        abort_if(Gate::denies('booth_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoothResource($booth->load(['event']));
    }

    public function update(UpdateBoothRequest $request, Booth $booth)
    {
        $booth->update($request->all());

        if ($request->input('image', false)) {
            if (!$booth->image || $request->input('image') !== $booth->image->file_name) {
                if ($booth->image) {
                    $booth->image->delete();
                }

                $booth->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($booth->image) {
            $booth->image->delete();
        }

        return (new BoothResource($booth))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Booth $booth)
    {
        abort_if(Gate::denies('booth_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booth->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
