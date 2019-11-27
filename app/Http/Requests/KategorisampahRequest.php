<?php

namespace App\Http\Requests;

use App\Kategorisampah;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategorisampahRequest extends FormRequest
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
        $kategorisampah_id = $this->route()->parameter('kategori_sampah')->id ?? '';

        return [
            'code' => 'required|max:12|unique:kategorisampahs,code,' . $kategorisampah_id,
            'name' => 'required',
            'price' => 'required',
            'description' => 'max:255',
            'jenissampah_id' => 'required',
            'status_id' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code' => 'Kode Sampah',
            'name' => 'Golongan',
            'price' => 'Harga Sampah',
            'description' => 'Deskripsi',
            'jenissampah_id' => 'Jenis Sampah',
            'status_id' => 'Status Sampah',
        ];
    }
}
