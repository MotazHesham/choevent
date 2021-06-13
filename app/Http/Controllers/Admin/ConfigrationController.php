<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConfigrationRequest;
use App\Http\Requests\StoreConfigrationRequest;
use App\Http\Requests\UpdateConfigrationRequest;
use App\Models\Configration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigrationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('configration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configrations = Configration::all();

        return view('admin.configrations.index', compact('configrations'));
    }

    public function create()
    {
        abort_if(Gate::denies('configration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configrations.create');
    }

    public function store(StoreConfigrationRequest $request)
    {
        $configration = Configration::create($request->validated());

        return redirect()->route('admin.configrations.index');
    }

    public function edit(Configration $configration)
    {
        abort_if(Gate::denies('configration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configrations.edit', compact('configration'));
    }

    public function update(UpdateConfigrationRequest $request, Configration $configration)
    {
        $configration->update($request->validated());

        return redirect()->route('admin.configrations.index');
    }

    public function show(Configration $configration)
    {
        abort_if(Gate::denies('configration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configrations.show', compact('configration'));
    }

    public function destroy(Configration $configration)
    {
        abort_if(Gate::denies('configration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configration->delete();

        return back();
    }

    public function massDestroy(MassDestroyConfigrationRequest $request)
    {
        Configration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
