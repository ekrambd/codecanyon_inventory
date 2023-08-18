<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            
            'product_name' => 'required|string|max:50|unique:products,product_name,' . $this->product->id,
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'product_code' => 'required|string|unique:products,product_code,' . $this->product->id,
            'product_unit' => 'required|string',
            'purchase_price' => 'required|integer',
            'sale_price'  => 'required|integer',
            'product_stock' => 'required|integer',
            'stock_limit' => 'required|integer',
            'product_description' => 'required',

        ];
    }
}
