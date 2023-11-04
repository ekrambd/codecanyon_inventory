<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
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
           'warehouse_name' => 'required|string|unique:warehouses,warehouse_name,' . $this->warehouse->id,

           'warehouse_email' => 'required|email|unique:warehouses,warehouse_email,' . $this->warehouse->id, 


           'warehouse_phone' => 'required|string|unique:warehouses,warehouse_phone,' . $this->warehouse->id, 

           'warehouse_address' => 'required',


        ]; 
    }
}
