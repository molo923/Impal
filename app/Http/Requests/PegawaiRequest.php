<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'gender' => 'required',
            'type' => 'required',
            'username' => ['required', 'string', 'max:20', 'unique:users', 'regex:/^[a-zA-Z0-9_]*$/'],
            'email' => ['required', 'email', 'max:70', 'min:10', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users', 'digits_between:8,15'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[0-9])(?=.*[\d\X]).*$/'],
            'address' => ['required', 'string', 'min:3', 'max:70'],
            'city' => 'required',
            'districts' => 'required',
            'urban' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama lengkap',
            'type' => 'Jenis pegawai',
            'username' => 'Username',
            'email' => 'Alamat email',
            'phone_number' => 'Nomor telepon',
            'password' => 'Kata sandi',
            'address' => 'Alamat',
            'city' => 'Kota/Kabupaten',
            'districts' => 'Kecamatan',
            'urban' => 'Desa/Kelurahan',
            'postal_code' => 'Kode pos',
        ];
    }
}
