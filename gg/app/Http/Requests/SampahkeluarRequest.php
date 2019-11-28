<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SampahkeluarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'date_in' => 'nullable',
            'destination' => 'required|max:50',
            'kategorisampahs' => 'required|array',
            'kategorisampahs.*' => 'required|distinct',
            'weight' => 'required|array',
            'weight.*' => 'required|numeric|min:0|not_in:0',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
            'extra_cost' => 'nullable|numeric',
            'status_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'destination' => 'Tujuan sampah keluar',
            'kategorisampahs.*' => 'Kategori sampah',
            'weight.*' => 'Berat sampah',
            'price.*' => 'Harga sampah',
        ];
    }
}
