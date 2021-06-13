<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\Admin\EventResource;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource(Event::with(['category', 'city', 'users'])->get());
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->users()->sync($request->input('users', []));

        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
        }

        if ($request->input('album', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('album')))->toMediaCollection('album');
        }

        if ($request->input('stage', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('stage')))->toMediaCollection('stage');
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource($event->load(['category', 'city', 'users']));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->users()->sync($request->input('users', []));

        if ($request->input('featured_image', false)) {
            if (!$event->featured_image || $request->input('featured_image') !== $event->featured_image->file_name) {
                if ($event->featured_image) {
                    $event->featured_image->delete();
                }

                $event->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
            }
        } elseif ($event->featured_image) {
            $event->featured_image->delete();
        }

        if ($request->input('album', false)) {
            if (!$event->album || $request->input('album') !== $event->album->file_name) {
                if ($event->album) {
                    $event->album->delete();
                }

                $event->addMedia(storage_path('tmp/uploads/' . $request->input('album')))->toMediaCollection('album');
            }
        } elseif ($event->album) {
            $event->album->delete();
        }

        if ($request->input('stage', false)) {
            if (!$event->stage || $request->input('stage') !== $event->stage->file_name) {
                if ($event->stage) {
                    $event->stage->delete();
                }

                $event->addMedia(storage_path('tmp/uploads/' . $request->input('stage')))->toMediaCollection('stage');
            }
        } elseif ($event->stage) {
            $event->stage->delete();
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
