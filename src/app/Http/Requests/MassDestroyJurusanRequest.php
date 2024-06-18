<?php

namespace App\Http\Requests;

use Gate;
use App\Models\Jurusan;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJurusanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('jurusan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:jurusans,id',
        ];
    }
}
