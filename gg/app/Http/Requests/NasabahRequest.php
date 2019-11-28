<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NasabahRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'gender' => 'required',
            'email' => 'nullable|email',
            'phone_number' => ['nullable', 'numeric', 'unique:users', 'digits_between:8,15'],
            'address' => ['required', 'string', 'min:3', 'max:70'],
            'city' => 'required',
            'districts' => 'required',
            'urban' => 'required',
            /*'postal_code' => 'required|numeric|digits:5',*/
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama lengkap',
            'gender' => 'Jenis kelamin',
            'phone_number' => 'Nomor telepon',
            'address' => 'Alamat',
            'city' => 'Kota/Kabupaten',
            'districts' => 'Kecamatan',
            'urban' => 'Desa/Kelurahan',
            'postal_code' => 'Kode pos',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => ':attribute hanya boleh berisi huruf.',
            'postal_code.digits' => ':attribute tidak valid.',
        ];
    }
}
