@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.data_mahasiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.id') }}
                        </th>
                        <td>
                            {{ $mahasiswa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.image') }}
                        </th>
                        <td>
                            @if($mahasiswa->image)
                                <a href="{{ $mahasiswa->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $mahasiswa->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.nama_mahasiswa') }}
                        </th>
                        <td>
                            {{ $mahasiswa->nama_mahasiswa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.nim_mahasiswa') }}
                        </th>
                        <td>
                            {{ $mahasiswa->nim_mahasiswa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.umur_mahasiswa') }}
                        </th>
                        <td>
                            {{ $mahasiswa->umur_mahasiswa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $mahasiswa->fakultas->nama_fakultas ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.jurusan_mahasiswa') }}
                        </th>
                        <td>
                            {{ $mahasiswa->jurusan->nama_jurusan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.status_perkuliahan') }}
                        </th>
                        <td>
                            {{ App\Models\Mahasiswa::STATUS[$mahasiswa->status_perkuliahan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_mahasiswa.fields.created_at') }}
                        </th>
                        <td>
                            {{ $mahasiswa->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
