<?php
 use App\Models\Category;
 use App\Models\Subcategory;
 use Illuminate\Http\Request;

 function categories()
 {
 	 $categories = Category::orderBy('id', 'DESC')->get();
 	 return $categories;
 }

 function featuredImage(Request $request)
 {
 	    if($request->file('featured_image'))
	    {   
	        $file = $request->file('featured_image');
	        $name = time().$file->getClientOriginalName();
	        $file->move(public_path().'/uploads/products/', $name); 
	        $path = 'uploads/products/'.$name;
	        return $path;
	    }
 }

 function subcategories()
 {
 	$subcategories = Subcategory::latest()->get();
 	return $subcategories;
 }

 function getSubcategories($category_id)
 {
 	$subcategories = Subcategory::where('category_id',$category_id)->latest()->get();
 	return $subcategories;
 }

 function updatefeaturedImage(Request $request, $product)
 {
 	 if($request->file('featured_image'))
	    {   
	        $file = $request->file('featured_image');
	        $name = time().$file->getClientOriginalName();
	        $file->move(public_path().'/uploads/products/', $name); 
	        unlink(public_path($product->featured_image));
	        $path = 'uploads/products/'.$name;
	    }
	    else
	    {
	    	$path = $product->featured_image;
	    }

	    return $path;
 }
 

 function storeSupplierimage(Request $request)
 {
 	 if($request->file('supplier_image'))
    {   
        $file = $request->file('supplier_image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/suppliers/', $name); 
        $path = 'uploads/suppliers/'.$name;
        return $path;
    }
    else
    {
    	return NULL;
    }
 }

 function updateSupplierimage(Request $request, $supplier)
 {
 	 if($request->file('supplier_image'))
    {    
        $file = $request->file('supplier_image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/suppliers/', $name); 
        if($supplier->supplier_image != NULL)
        {
        	unlink(public_path($supplier->supplier_image));
        }
        $path = 'uploads/suppliers/'.$name;
        return $path;
    }
    else
    {
    	return $supplier->supplier_image;
    }
 }

 function storecustomerimage(Request $request)
 {
    if($request->file('customer_image'))
    {   
        $file = $request->file('customer_image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/customers/', $name); 
        $path = 'uploads/customers/'.$name;
        return $path;
    }
    else
    {
        return NULL;
    }
 }

 function updateCustomerimage(Request $request, $customer)
 {
    if($request->file('customer_image'))
    {    
        $file = $request->file('customer_image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/customers/', $name); 
        if($customer->customer_image != NULL)
        {
            unlink(public_path($customer->customer_image));
        }
        $path = 'uploads/customers/'.$name;
        return $path;
    }
    else
    {
        return $customer->customer_image;
    }
 }