@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.fakultas.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fakultas.edit", [$fakulta->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nama_fakultas">{{ trans('cruds.fakultas.fields.nama_fakultas') }}</label>
                <input class="form-control {{ $errors->has('nama_fakultas') ? 'is-invalid' : '' }}" type="text" name="nama_fakultas" id="nama_fakultas" value="{{ old('nama_fakultas', $fakulta->nama_fakultas) }}">
                @if($errors->has('nama_fakultas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_fakultas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fakultas.fields.nama_fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kode_fakultas">{{ trans('cruds.fakultas.fields.kode_fakultas') }}</label>
                <input class="form-control {{ $errors->has('kode_fakultas') ? 'is-invalid' : '' }}" type="text" name="kode_fakultas" id="kode_fakultas" value="{{ old('kode_fakultas', $fakulta->kode_fakultas) }}">
                @if($errors->has('kode_fakultas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_fakultas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fakultas.fields.kode_fakultas_helper') }}</span>
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
