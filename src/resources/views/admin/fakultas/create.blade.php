@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fakultas.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fakultas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_fakultas">{{ trans('cruds.fakultas.fields.nama_fakultas') }}</label>
                <input class="form-control {{ $errors->has('nama_fakultas') ? 'is-invalid' : '' }}" type="text" name="nama_fakultas" id="nama_fakultas" value="{{ old('nama_fakultas', '') }}">
                @if($errors->has('nama_fakultas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_fakultas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fakultas.fields.nama_fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kode_fakultas">{{ trans('cruds.fakultas.fields.kode_fakultas') }}</label>
                <input class="form-control {{ $errors->has('kode_fakultas') ? 'is-invalid' : '' }}" type="text" name="kode_fakultas" id="kode_fakultas" value="{{ old('kode_fakultas', '') }}">
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

@section('scripts')
{{-- <script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.fakultas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($fak) && $fak->image)
      var file = {!! json_encode($fak->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script> --}}
@endsection
