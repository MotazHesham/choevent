<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $group=$request->group??'admin';
        $users = User::where('group',$group)->get();

        return view('admin.users.'.$group.'s.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $services = Category::all()->pluck('name', 'id');

        return view('admin.users.admins.create', compact('roles', 'services'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->input());
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->services()->sync($request->input('services', []));

        if ($request->input('avatar', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
        }

        if ($request->input('company_register_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('company_register_image')))->toMediaCollection('company_register_image');
        }

        if ($request->input('employee_identity_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('employee_identity_image')))->toMediaCollection('employee_identity_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->back();
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $services = Category::all()->pluck('name', 'id');

        $user->load('roles', 'services');
        $group=$user->group??'admin';
        
        return view('admin.users.'.$group.'s.edit', compact('roles', 'services', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->services()->sync($request->input('services', []));

        if ($request->input('avatar', false)) {
            if (!$user->avatar || $request->input('avatar') !== $user->avatar->file_name) {
                if ($user->avatar) {
                    $user->avatar->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
            }
        } elseif ($user->avatar) {
            $user->avatar->delete();
        }

        if ($request->input('company_register_image', false)) {
            if (!$user->company_register_image || $request->input('company_register_image') !== $user->company_register_image->file_name) {
                if ($user->company_register_image) {
                    $user->company_register_image->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('company_register_image')))->toMediaCollection('company_register_image');
            }
        } elseif ($user->company_register_image) {
            $user->company_register_image->delete();
        }

        if ($request->input('employee_identity_image', false)) {
            if (!$user->employee_identity_image || $request->input('employee_identity_image') !== $user->employee_identity_image->file_name) {
                if ($user->employee_identity_image) {
                    $user->employee_identity_image->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('employee_identity_image')))->toMediaCollection('employee_identity_image');
            }
        } elseif ($user->employee_identity_image) {
            $user->employee_identity_image->delete();
        }
        $group=$user->group??'admin';
       
        return redirect()->route('admin.users.index',['group'=>$group]);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'services');
        $group=$user->group??'admin';
        
        return view('admin.users.'.$group.'s.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
