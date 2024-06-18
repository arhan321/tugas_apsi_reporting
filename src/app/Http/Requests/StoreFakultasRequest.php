<?php

namespace App\Http\Requests;

use Gate;
use App\Models\Fakultas;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class StoreFakultasRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fakultas_create');
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'string',
            //     'nullable',
            // ],
            // 'description' => [
            //     'string',
            //     'nullable',
            // ],
            // 'stock' => [
            //     'nullable',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
        ];
    }
}
