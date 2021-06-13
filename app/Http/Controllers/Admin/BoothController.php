<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBoothRequest;
use App\Http\Requests\StoreBoothRequest;
use App\Http\Requests\UpdateBoothRequest;
use App\Models\Booth;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BoothController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('booth_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booths = Booth::all();

        return view('admin.booths.index', compact('booths'));
    }

    public function create()
    {
        abort_if(Gate::denies('booth_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.booths.create', compact('events'));
    }

    public function store(StoreBoothRequest $request)
    {
        $booth = Booth::create($request->all());

        if ($request->input('image', false)) {
            $booth->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $booth->id]);
        }

        return redirect()->route('admin.booths.index');
    }

    public function edit(Booth $booth)
    {
        abort_if(Gate::denies('booth_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booth->load('event');

        return view('admin.booths.edit', compact('events', 'booth'));
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

        return redirect()->route('admin.booths.index');
    }

    public function show(Booth $booth)
    {
        abort_if(Gate::denies('booth_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booth->load('event');

        return view('admin.booths.show', compact('booth'));
    }

    public function destroy(Booth $booth)
    {
        abort_if(Gate::denies('booth_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booth->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoothRequest $request)
    {
        Booth::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('booth_create') && Gate::denies('booth_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Booth();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
