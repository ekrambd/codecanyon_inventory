<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'subcategory_name',
        'category_id',
    ];


    protected $casts = [
        'subcategory_name' => 'string',
        'category_id'     => 'integer',
    ];

}
