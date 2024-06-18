@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jurusan.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jurusans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.jurusan.fields.id') }}</th>
                        <td>{{ $jurusan->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.jurusan.fields.nama_jurusan') }}</th>
                        <td>{{ $jurusan->nama_jurusan }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.jurusan.fields.kode_jurusan') }}</th>
                        <td>{{ $jurusan->kode_jurusan }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.jurusan.fields.fakultas') }}</th>
                        <td>{{ $jurusan->fakultas->nama_fakultas ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jurusans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
