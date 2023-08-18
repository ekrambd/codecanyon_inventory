<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
class SubcategoryController extends Controller
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
           try{
                  if($request->ajax()) {
                        $data = Subcategory::orderBy('id','DESC')->select('*');

                        return Datatables::of($data)
                                ->addIndexColumn()
                               ->addColumn('category', function($row){
                                  return $row->category->category_name;
                               })
                               ->addColumn('action', function($row){
                                                                
                                   $btn = "";
                                    $btn .= '&nbsp;';
                                    $btn .= ' <a href="#" class="btn btn-primary btn-sm action-button edit-subcategory" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';

                                    $btn .= '&nbsp;';


                                      $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-subcategory action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
                
                                  
                
                                        return $btn;
                                })
                                ->rawColumns(['action', 'category'])
                                ->make(true); 
                    }
                    return view('subcategories.index');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcategoryRequest $request)
    {
        try
        {
            Subcategory::create($request->validated());
            return response()->json(['status'=>true, 'message'=>'Successfully subcategory has been added']);
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
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        try
        {  
            return response()->json(['status'=>true, 'subcategory'=>$subcategory, 'categories'=>categories()]);
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
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        try
        {
            $subcategory->update($request->validated());
             return response()->json(['status'=>true, 'message'=>'Successfully subcategory has been updated']);
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
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        try
        {
            $subcategory->delete();
            return response()->json('Subcategory has been deleted');
        }catch(Exception $e){
                      
                    $message = $e->getMessage();
          
                    $code = $e->getCode();       
          
                    $string = $e->__toString();       
                    return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                    exit;
        } 
    }
}
