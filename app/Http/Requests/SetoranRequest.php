<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetoranRequest extends FormRequest
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
        $custom_price_rules = $this->type === 'beli' ? 'required|numeric|min:0|not_in:0' : 'nullable|numeric|min:0|not_in:0';
        return [
            'nasabah_id' => 'required',
            'type' => 'required',
            'store_in' => 'nullable',
            'kategorisampahs' => 'required|array',
            'kategorisampahs.*' => 'required|distinct',
            'weight' => 'required|array',
            'weight.*' => 'required|numeric|min:0|not_in:0',
            'custom_price' => 'nullable|array',
            'custom_price.*' => $custom_price_rules,
            'store_cost' => 'nullable|numeric',
            /*'status_id' => 'required',*/
        ];
    }

    public function attributes()
    {
        return [
            'nasabah_id' => 'Nasabah',
            'kategorisampahs.*' => 'Kategori sampah',
            'weight.*' => 'Berat sampah',
            'custom_price.*' => 'Harga sampah',
        ];
    }
}
