<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFakultasRequest;
use App\Http\Requests\UpdateFakultasRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyFakultasRequest;

class FakultasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fakultas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Fakultas::all();

        return view('admin.fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        abort_if(Gate::denies('fakultas_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultas.create');
    }

    public function store(StoreFakultasRequest $request)
    {
        $fakultas = Fakultas::create($request->all());

        return redirect()->route('admin.fakultas.index');
    }

    public function edit(Fakultas $fakulta)
    {
        abort_if(Gate::denies('fakultas_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultas.edit', compact('fakulta'));
    }

    public function update(UpdateFakultasRequest $request, Fakultas $fakulta)
    {
        $fakulta->update($request->all());

        return redirect()->route('admin.fakultas.index');
    }

    public function show(Fakultas $fakulta)
    {
        abort_if(Gate::denies('fakultas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultas.show', compact('fakulta'));
    }

    public function destroy(Fakultas $fakulta)
    {
        abort_if(Gate::denies('fakultas_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakulta->delete();

        return back();
    }

    public function massDestroy(MassDestroyFakultasRequest $request)
    {
        $fakultas = Price::find(request('ids'));

        foreach ($fakultas as $fakulta) {
            $fakulta->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
