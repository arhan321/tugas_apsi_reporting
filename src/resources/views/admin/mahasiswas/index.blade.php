@extends('layouts.admin')
@section('content')
@can('mahasiswa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mahasiswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.data_mahasiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.data_mahasiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Product">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.id') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.image') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.nama_mahasiswa') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.nim_mahasiswa') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.umur_mahasiswa') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.fakultas') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.jurusan_mahasiswa') }}</th>
                        <th>{{ trans('cruds.data_mahasiswa.fields.status_perkuliahan') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $key => $m)
                        <tr data-entry-id="{{ $m->id }}">
                            <td></td>
                            <td>{{ $m->id ?? '' }}</td>
                            <td>
                                @if($m->image)
                                    <a href="{{ $m->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $m->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>{{ $m->nama_mahasiswa ?? '' }}</td>
                            <td>{{ $m->nim_mahasiswa ?? '' }}</td>
                            <td>{{ $m->umur_mahasiswa ?? '' }}</td>
                            <td>{{ $m->fakultas->nama_fakultas ?? '' }}</td> 
                            <td>{{ $m->jurusan->nama_jurusan ?? '' }}</td> 
                            <td>
                                @if(isset(App\Models\Mahasiswa::STATUS[$m->status_perkuliahan]))
                                    <span class="status-{{ strtolower(str_replace(' ', '_', $m->status_perkuliahan)) }}">
                                        {{ App\Models\Mahasiswa::STATUS[$m->status_perkuliahan] }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @can('mahasiswa_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.mahasiswas.show', $m->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('mahasiswa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.mahasiswas.edit', $m->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('mahasiswa_delete')
                                    <form action="{{ route('admin.mahasiswas.destroy', $m->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.status-aktif {
    background-color: #28a745;
    color: white;
    padding: 2px 5px;
    border-radius: 3px;
}

.status-cuti {
    background-color: #ffc107;
    color: white;
    padding: 2px 5px;
    border-radius: 3px;
}

.status-drop_out {
    background-color: #dc3545;
    color: white;
    padding: 2px 5px;
    border-radius: 3px;
}

.status-tidak_aktif {
    background-color: #6c757d;
    color: white;
    padding: 2px 5px;
    border-radius: 3px;
}
</style>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('mahasiswa_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.mahasiswas.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection
