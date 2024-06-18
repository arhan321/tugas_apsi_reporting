@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jurusan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jurusans.update", [$jurusan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nama_jurusan">{{ trans('cruds.jurusan.fields.nama_jurusan') }}</label>
                <input class="form-control {{ $errors->has('nama_jurusan') ? 'is-invalid' : '' }}" type="text" name="nama_jurusan" id="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}">
                @if($errors->has('nama_jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jurusan.fields.nama_jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kode_jurusan">{{ trans('cruds.jurusan.fields.kode_jurusan') }}</label>
                <input class="form-control {{ $errors->has('kode_jurusan') ? 'is-invalid' : '' }}" type="text" name="kode_jurusan" id="kode_jurusan" value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}">
                @if($errors->has('kode_jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jurusan.fields.kode_jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fakultas_id">{{ trans('cruds.jurusan.fields.fakultas') }}</label>
                <select class="form-control {{ $errors->has('fakultas_id') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id">
                    @foreach($fakultas as $id => $nama)
                        <option value="{{ $id }}" {{ old('fakultas_id', $jurusan->fakultas_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
                @if($errors->has('fakultas_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fakultas_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jurusan.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
