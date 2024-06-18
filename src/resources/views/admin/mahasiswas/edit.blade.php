@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.data_mahasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mahasiswas.update", [$mahasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.data_mahasiswa.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_mahasiswa">{{ trans('cruds.data_mahasiswa.fields.nama_mahasiswa') }}</label>
                <input class="form-control {{ $errors->has('nama_mahasiswa') ? 'is-invalid' : '' }}" type="text" name="nama_mahasiswa" id="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}">
                @if($errors->has('nama_mahasiswa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_mahasiswa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.nama_mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nim_mahasiswa">{{ trans('cruds.data_mahasiswa.fields.nim_mahasiswa') }}</label>
                <input class="form-control {{ $errors->has('nim_mahasiswa') ? 'is-invalid' : '' }}" type="text" name="nim_mahasiswa" id="nim_mahasiswa" value="{{ old('nim_mahasiswa', $mahasiswa->nim_mahasiswa) }}">
                @if($errors->has('nim_mahasiswa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nim_mahasiswa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.nim_mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="umur_mahasiswa">{{ trans('cruds.data_mahasiswa.fields.umur_mahasiswa') }}</label>
                <input class="form-control {{ $errors->has('umur_mahasiswa') ? 'is-invalid' : '' }}" type="number" name="umur_mahasiswa" id="umur_mahasiswa" value="{{ old('umur_mahasiswa', $mahasiswa->umur_mahasiswa) }}" step="0.01">
                @if($errors->has('umur_mahasiswa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('umur_mahasiswa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.umur_mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jurusan_mahasiswa">{{ trans('cruds.data_mahasiswa.fields.jurusan_mahasiswa') }}</label>
                <select class="form-control {{ $errors->has('jurusan_mahasiswa') ? 'is-invalid' : '' }}" name="jurusan_mahasiswa" id="jurusan_mahasiswa">
                    @foreach($jurusans as $id => $nama_jurusan)
                        <option value="{{ $id }}" {{ old('jurusan_mahasiswa', $mahasiswa->jurusan_mahasiswa) == $id ? 'selected' : '' }}>{{ $nama_jurusan }}</option>
                    @endforeach
                </select>
                @if($errors->has('jurusan_mahasiswa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jurusan_mahasiswa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.jurusan_mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.data_mahasiswa.fields.status_perkuliahan') }}</label>
                <select class="form-control {{ $errors->has('status_perkuliahan') ? 'is-invalid' : '' }}" name="status_perkuliahan" id="status_perkuliahan">
                    <option value disabled {{ old('status_perkuliahan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Mahasiswa::STATUS as $key => $label)
                        <option value="{{ $key }}" {{ old('status_perkuliahan', $mahasiswa->status_perkuliahan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_perkuliahan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_perkuliahan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_mahasiswa.fields.status_perkuliahan_helper') }}</span>
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
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.mahasiswas.storeMedia') }}',
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
@if(isset($mahasiswa) && $mahasiswa->image)
      var file = {!! json_encode($mahasiswa->image) !!}
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

</script>
@endsection
