@extends('layouts.admin')
@section('content')
@can('jurusan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.jurusans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.jurusan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.jurusan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-jurusans">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.jurusan.fields.id') }}</th>
                        <th>{{ trans('cruds.jurusan.fields.nama_jurusan') }}</th>
                        <th>{{ trans('cruds.jurusan.fields.kode_jurusan') }}</th>
                        <th>{{ trans('cruds.jurusan.fields.fakultas') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusans as $key => $j)
                        <tr data-entry-id="{{ $j->id }}">
                            <td></td>
                            <td>{{ $j->id ?? '' }}</td>
                            <td>{{ $j->nama_jurusan ?? '' }}</td>
                            <td>{{ $j->kode_jurusan ?? '' }}</td>
                            <td>{{ $j->fakultas->nama_fakultas ?? '' }}</td> 
                            <td>
                                @can('jurusan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.jurusans.show', $j->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('jurusan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.jurusans.edit', $j->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('jurusan_delete')
                                    <form action="{{ route('admin.jurusans.destroy', $j->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        @can('jurusan_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.jurusans.massDestroy') }}",
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
        let table = $('.datatable-jurusans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection
