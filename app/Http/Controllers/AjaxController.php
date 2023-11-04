<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Purchasecart;
use App\Models\Supplier;
class AjaxController extends Controller
{
    public function allCategories()
    {
    	try
    	{
    		return response()->json(['status'=>true, 'categories'=>categories()]);
    	}catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function getSubcategories(Request $request)
    {
        try
        {
            $subcategories = Subcategory::where('category_id',$request->category_id)->orderBy('id','DESC')->get();
            if(count($subcategories) > 0)
            {
                return response()->json(['status'=>true, 'message'=>'Data found', 'data'=>$subcategories]);
            }
            return response()->json(['status'=>false, 'message'=>'No data found', 'data'=>$subcategories]);
            
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function scanPurchaseProduct(Request $request)
    {
        try
        {   

            $search = $request->scan_purchase_product;


            if (preg_match('/[a-zA-Z]/', $search))
            {
               $data =  Product::where('products.product_name', 'LIKE', "%$search%")->orderBy('id','DESC')->get();

               return response()->json(['status'=>true, 'type'=>'array', 'data'=>$data]);
            }
     
               $product =  Product::where('products.product_code',$search)->first();


              addPurchaseCart($product);
         
             return response()->json(['status'=>true, 'type'=>'cart', 'data'=>purchaseCarts()]); 

        }catch(Exception $e){ 
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function productPurchase($id)
    {
        try
        {
            $product = Product::findorfail($id);
            addPurchaseCart($product);


            return response()->json(['status'=>true, 'message'=>'Successfully the product has been added to cart', 'data'=>purchaseCarts()]); 
            
        }catch(Exception $e){  
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function deletePurchaseCart($id)
    {
        try
        {
            $cart = Purchasecart::findorfail($id);
            $cart->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the cart has been deleted']);
        }catch(Exception $e){  
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function getSuppliers()
    {
        try
        {
            $supplier = Supplier::latest()->first();
            $suppliers = Supplier::latest()->get();
            return response()->json(['status'=>true, 'supplier'=>$supplier, 'data'=>$suppliers]);
        }catch(Exception $e){  
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
