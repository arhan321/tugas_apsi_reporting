<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyJurusanRequest;

class JurusanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jurusan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jurusans = Jurusan::with('fakultas')->get();
    
        return view('admin.jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        abort_if(Gate::denies('jurusan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $fakultas = Fakultas::all()->pluck('nama_fakultas', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        return view('admin.jurusans.create', compact('fakultas'));
    }

    public function store(StoreJurusanRequest $request)
    {
        $jurusan = Jurusan::create($request->all());

        return redirect()->route('admin.jurusans.index');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $fakultas = Fakultas::all()->pluck('nama_fakultas', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        return view('admin.jurusans.edit', compact('jurusan', 'fakultas'));
    }

    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->all());

        return redirect()->route('admin.jurusans.index');
    }

    public function show(Jurusan $jurusan)
    {
        abort_if(Gate::denies('jurusan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jurusan->load('fakultas');

        return view('admin.jurusans.show', compact('jurusan'));
    }

    public function destroy(Jurusan $jurusan)
    {
        abort_if(Gate::denies('jurusan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jurusan->delete();

        return back();
    }

    public function massDestroy(MassDestroyJurusanRequest $request)
    {
        Jurusan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
