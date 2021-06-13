<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Event;
use App\Models\User;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
       
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::where('type','activity')->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id');

        return view('admin.events.create', compact('categories', 'cities', 'users'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        
        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
        }

        foreach ($request->input('album', []) as $file) {
            $event->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('album');
        }

        if ($request->input('stage', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('stage')))->toMediaCollection('stage');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->back()->with('msg','تم إضافة الفعالية بنجاح..ستقوم إدارة المنصة بمراجعتها ونشرها');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::where('type','activity')->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id');

        $event->load('category', 'city');

        return view('admin.events.edit', compact('categories', 'cities', 'users', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        // $event->users()->sync($request->input('users', []));

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

        if (count($event->album) > 0) {
            foreach ($event->album as $media) {
                if (!in_array($media->file_name, $request->input('album', []))) {
                    $media->delete();
                }
            }
        }

        $media = $event->album->pluck('file_name')->toArray();

        foreach ($request->input('album', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $event->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('album');
            }
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

        return redirect()->back();
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('category', 'city');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function activate($id){
        $event=Event::find($id);
        $event->publish=1;
        $event->save();
        return redirect()->back();

    }
    public function suspend($id){
        $event=Event::find($id);
        $event->publish=0;
        $event->save();
        return redirect()->back();

    }
}
