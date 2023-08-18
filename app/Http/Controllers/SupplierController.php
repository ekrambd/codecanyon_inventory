<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplyRequest;
use App\Http\Requests\UpdateSupplierRequest;
use DataTables;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {   
        $this->middleware('auth_check');
    }
    
    public function index(Request $request)
    {
         try
        {
            if($request->ajax()) {
                $suppliers = Supplier::orderBy('id','DESC')->select('*');

                return Datatables::of($suppliers)
                        ->addIndexColumn()
                       
                       
                        ->addColumn('action', function($row){
                                                        
                           $btn = "";
                            $btn .= '&nbsp;';
                            $btn .= ' <a href="'.route('suppliers.show',$row->id).'" class="btn btn-primary btn-sm action-button" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';

                            $btn .= '&nbsp;';


                              $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-supplier action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
        
                          
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true); 
            }
            return view('suppliers.index'); 
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
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplyRequest $request)
    {
        try
        {
            $supplier = new Supplier();
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->supplier_email = $request->supplier_email;
            $supplier->supplier_address = $request->supplier_address;
            $supplier->supplier_image = storeSupplierimage($request);
            $supplier->save();

            $notification=array(
                             'messege'=>"Successfully supplier has been added",
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        try
        {
            return view('suppliers.edit', compact('supplier'));
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        try
        {
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->supplier_email = $request->supplier_email;
            $supplier->supplier_address = $request->supplier_address;
            $supplier->supplier_image = updateSupplierimage($request,$supplier);
            $supplier->update();

            $notification=array(
                             'messege'=>"Successfully supplier has been updated",
                             'alert-type'=>'success'
                            );

            return redirect('/suppliers')->with($notification);
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
         try
         {
              if($supplier->supplier_image != NULL)
              {
                  unlink(public_path($supplier->supplier_image));
              }
              $supplier->delete();
              return response()->json('Successfully supplier has been deleted');
         }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
