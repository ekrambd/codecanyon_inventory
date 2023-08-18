<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

 //    public function getFeaturedImageAttribute($value)
 //    {
 //        $baseUrl = url('/'); 
 //        return $baseUrl . '/' . $value;
 //    }


 //    public function setFeaturedImageAttribute($value)
	// {
	//     $filename = basename($value);
	//     $this->attributes['featured_image'] = $filename;
	// }


	
}
