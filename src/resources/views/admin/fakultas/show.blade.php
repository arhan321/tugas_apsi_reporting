@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fakultas.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakultas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultas.fields.id') }}
                        </th>
                        <td>
                            {{ $fakulta->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultas.fields.nama_fakultas') }}
                        </th>
                        <td>
                            {{ $fakulta->nama_fakultas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultas.fields.kode_fakultas') }}
                        </th>
                        <td>
                            {{ $fakulta->kode_fakultas }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakultas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection