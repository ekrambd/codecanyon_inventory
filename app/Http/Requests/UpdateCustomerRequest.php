<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            
            'customer_name' => 'required|string',

            'customer_phone' => 'required|string|unique:customers,customer_phone,' . $this->customer->id,

            'customer_email' => 'required|string|unique:customers,customer_email,' . $this->customer->id,

            'customer_address' => 'required',
            

        ]; 
    }
}
