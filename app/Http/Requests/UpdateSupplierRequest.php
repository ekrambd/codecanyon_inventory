<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'supplier_name' => 'required|string',

            'supplier_phone' => 'required|string|unique:suppliers,supplier_phone,' . $this->supplier->id,

            'supplier_email' => 'required|string|unique:suppliers,supplier_email,' . $this->supplier->id,

            'supplier_address' => 'required',
            

        ]; 
    }
}
