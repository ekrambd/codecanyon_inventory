<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $subcategories = Subcategory::where('category_id',$category->id)->get();

        $products = Product::where('category_id',$category->id)->get();

        if(count($products) > 0)
        {
            foreach($products as $product)
            {
                unlink(public_path($product->featured_image));
                $product->delete();
            }
        }

        if(count($subcategories) > 0)
        {
            foreach($subcategories as $subcategory)
            {
                $subcategory->delete();
            }
        }

    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
