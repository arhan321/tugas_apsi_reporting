<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Jurusan;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyMahasiswaRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MahasiswaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['jurusan', 'fakultas', 'media'])->get();
    
        return view('admin.mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        abort_if(Gate::denies('mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $fakultas = Fakultas::all()->pluck('nama_fakultas', 'id')->prepend(trans('global.pleaseSelect'), '');
        $jurusans = Jurusan::all()->pluck('nama_jurusan', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        return view('admin.mahasiswas.create', compact('fakultas', 'jurusans'));
    }

    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());

        if ($request->input('image', false)) {
            $mahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mahasiswa->id]);
        }

        return redirect()->route('admin.mahasiswas.index');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusans = Jurusan::all()->pluck('nama_jurusan', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        return view('admin.mahasiswas.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->all());

        if ($request->input('image', false)) {
            if (! $mahasiswa->image || $request->input('image') !== $mahasiswa->image->file_name) {
                if ($mahasiswa->image) {
                    $mahasiswa->image->delete();
                }
                $mahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($mahasiswa->image) {
            $mahasiswa->image->delete();
        }

        return redirect()->route('admin.mahasiswas.index');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Eager load relasi 'jurusan' dan 'fakultas'
        $mahasiswa->load(['jurusan', 'fakultas', 'media']);

        return view('admin.mahasiswas.show', compact('mahasiswa'));
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyMahasiswaRequest $request)
    {
        $mahasiswas = Mahasiswa::find(request('ids'));

        foreach ($mahasiswas as $mahasiswa) {
            $mahasiswa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mahasiswa_create') && Gate::denies('mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Mahasiswa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
