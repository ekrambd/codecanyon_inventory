<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

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
}
