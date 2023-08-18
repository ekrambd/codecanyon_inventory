<?php

namespace App\Observers;

use App\Models\Subcategory;
use App\Models\Product;
class SubcategoryObserver
{
    /**
     * Handle the Subcategory "created" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function created(Subcategory $subcategory)
    {
        //
    }

    /**
     * Handle the Subcategory "updated" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function updated(Subcategory $subcategory)
    {
        //
    }

    /**
     * Handle the Subcategory "deleted" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function deleted(Subcategory $subcategory)
    {
        $products = Product::where('subcategory_id',$subcategory->id)->get();

        if(count($products) > 0)
        {
            foreach($products as $product)
            {
                unlink(public_path($product->featured_image));
                $product->delete();
            }
        }
    }

    /**
     * Handle the Subcategory "restored" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function restored(Subcategory $subcategory)
    {
        //
    }

    /**
     * Handle the Subcategory "force deleted" event.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return void
     */
    public function forceDeleted(Subcategory $subcategory)
    {
        //
    }
}
