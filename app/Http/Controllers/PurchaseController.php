<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
class PurchaseController extends Controller
{   
	public function __construct()
    {   
        $this->middleware('auth_check');
    }
    
    public function purchaseProduct()
    {
    	return view('purchases.add_purchase'); 
    }

}
