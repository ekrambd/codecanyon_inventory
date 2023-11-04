<?php
 use App\Models\Category;
 use App\Models\Subcategory;
  use App\Models\Purchase;
 use App\Models\Customer;
 use App\Models\Supplier;
 use Illuminate\Http\Request;
use App\Models\Purchasecart;
 
 use App\Models\Setting; 
 use App\Models\Warehouse;
 function categories()
 {
 	 $categories = Category::orderBy('id', 'DESC')->get();
 	 return $categories;
 }

 function customers()
 {
     $customers = Customer::latest()->get();
     return $customers;
 }

 function suppliers()
 {
    $suppliers = Supplier::latest()->get();
    return $suppliers;
 }

 function warehouses()
 {
     $warehouses = Warehouse::latest()->get();
     return $warehouses;
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
        $path = 'uploads/customers/'.$name;    }
    else
    {
        $path =  $customer->customer_image;
    }

    return $path;
 }

 function countPurchase()
 {
     $count = Purchase::count();
     $count+=1;
     return $count;
 }

 function invoiceNo()
 {
     $number = "INV-".rand(100,10000000).countPurchase();
     return $number;
 }

 function countPurchaseCart()
 {
     $count = Purchasecart::count();
     $count+=1;
     return $count;
 }

 function purchaseCartSession()
 {
    $cart_session_id = Session::get('cart_session_id');
    if(empty($cart_session_id)){
        $cart_session_id = rand(100,10000).countPurchaseCart();
        Session::put('cart_session_id',$cart_session_id);
    }
    return $cart_session_id;
 }

 function addPurchaseCart($product)
 {
     $cart = Purchasecart::where('product_id',$product->id)->where('cart_session_id',purchaseCartSession())->first();


        if($cart)
        {   
            $cart->cart_qty = $cart->cart_qty+1; 
            $cart->unit_total = purchaseCartQtyInc($cart,$product);
            $cart->update();
     

            return response()->json(['stautus'=>true, 'message'=>'Successfully the product cart has been increment', 'data'=>purchaseCarts()]); 
        }
        $cart = new Purchasecart();
        $cart->product_id = $product->id;
        $cart->cart_qty = 1;
        $cart->unit_total = $product->purchase_price * 1;
        $cart->cart_session_id = purchaseCartSession(); 
        $cart->save(); 

    
 }

 function purchaseCartQtyInc($cart,$product)
 {
     $unit_total = $product->purchase_price * $cart->cart_qty;
     return $unit_total;
 }

 function purchaseCarts()
 {
    $carts = Purchasecart::with('product')->where('cart_session_id', purchaseCartSession())->get();
    return $carts;
 }

 function purchaseCartSubtotal()
 {
     $total = Purchasecart::where('cart_session_id',purchaseCartSession())->sum('unit_total');
    return $total;
 }

 function setting()
 {
     $setting = Setting::findorfail(1);
     return $setting;
 }

