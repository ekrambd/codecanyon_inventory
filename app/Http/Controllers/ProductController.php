<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use DataTables;
class ProductController extends Controller
{   

    public function __construct()
    {   
        $this->middleware('auth_check');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            if($request->ajax()) {
                $products = Product::latest()->select('*');
                return Datatables::of($products)
                        ->addIndexColumn()
                        ->addColumn('category', function($row){
                       
                             return $row->category->category_name;                                             
                            
                        })

                        ->addColumn('image', function($row){
                       
                             return url('/')."/".$row->featured_image;                                             
                            
                        })

                        ->addColumn('purchase_price', function($row){
                       
                             return "$".$row->purchase_price;                                             
                            
                        })

                        ->addColumn('sale_price', function($row){
                       
                             return "$".$row->sale_price;                                             
                            
                        }) 

                        ->addColumn('image', function($row){
                       
                             return '<img class="product-image" src="'.$row->featured_image.'">';                                             
                            
                        })


                        ->addColumn('action', function($row){

                                                         
                            $btn = "";
                            $btn .= '&nbsp;';
                            $btn .= ' <a href="'.route('products.show',$row->id).'" class="btn btn-primary btn-sm action-button" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';

                            $btn .= '&nbsp;';


                              $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-product action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
        
                          
        
                                return $btn;
                        })
                        ->filter(function ($instance) use ($request) {
                            if ($request->get('search') != "") {
                                 $instance->where(function($w) use($request){
                                    $search = $request->get('search');
                                    $w->orWhere('products.product_name', 'LIKE', "%$search%");
                                });
                            }

                            if ($request->get('category_id') != "") {
                                 $instance->where(function($w) use($request){
                                    $category_id = $request->get('category_id');
                                    $w->orWhere('products.category_id', $category_id);
                                });
                            }

                            if ($request->get('subcategory_id') != "") {
                                 $instance->where(function($w) use($request){
                                    $subcategory_id = $request->get('subcategory_id');
                                    $w->orWhere('products.subcategory_id', $subcategory_id);
                                });
                            }

                            
                        })
                        ->rawColumns(['action', 'category', 'image','purchase_price','sale_price'])
                        ->make(true); 
            }
            
            return view('products.index');
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try
        {   
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->product_code = $request->product_code;
            $product->product_unit = $request->product_unit;
            $product->purchase_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->product_stock = $request->product_stock;
            $product->stock_limit = $request->stock_limit;
            $product->product_description = $request->product_description;
            $product->featured_image = featuredImage($request);
            $product->save();

            $notification=array(
                             'messege'=>"Successfully product has been added",
                             'alert-type'=>'success'
                            );

            return Redirect()->back()->with($notification);

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try
        {  
           return view('products.edit', compact('product')); 
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try
        {    
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->product_code = $request->product_code;
            $product->product_unit = $request->product_unit;
            $product->purchase_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->product_stock = $request->product_stock;
            $product->stock_limit = $request->stock_limit;
            $product->product_description = $request->product_description;
            $product->featured_image = updatefeaturedImage($request,$product);
            $product->update();

            $notification=array(
                             'messege'=>"Successfully product has been updated",
                             'alert-type'=>'success'
                            );

            return redirect('/products')->with($notification);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try
        {   
            unlink(public_path($product->featured_image));
            $product->delete();
            return response()->json('Successfully product has been deleted');
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
