@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Purchase Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Purchase Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Purchase Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="invoice_number">Invoice No <span class="required">*</span></label>
                      <input type="text" name="invoice_number" class="form-control" id="invoice_number" placeholder="Invoice No" value="{{old('invoice_number',invoiceNo())}}" required="" readonly=""> 
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="supplier_id">Select Suppliers <span class="required">*</span></label>
                      <select class="form-control select2bs4" name="supplier_id" id="supplier_id" required="">

                        <option value="" selected="" disabled="">Select Suppliers</option>
                        
                        @foreach(suppliers() as $supplier)
                         <option value="{{$supplier->id}}">{{$supplier->supplier_name}}-{{$supplier->supplier_phone}}-{{$supplier->supplier_email}}-{{$supplier->supplier_address}}</option>

                        @endforeach                     
                      
                      </select>

                      <a href="#" class="btn btn-success add-new-supplier my-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Add New Supplier</a>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="warehouse_id">Select Warehouse</label>
                      <select class="form-control select2bs4" name="warehouse_id" id="warehouse_id" required="">Select Warehouse <span class="required">*</span>
                      <option value="" selected="" disabled="">Select Warehouse</option>
                      @foreach(warehouses() as $warehouse)
                        <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}-{{$warehouse->warehouse_phone}}-{{$warehouse->warehouse_email}}-{{$warehouse->warehouse_address}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>
                  


                  <div class="col-md-12">

                      <div class="input-container">
                      <i class="fa fa-barcode icon"></i>
                      <input class="form-control input-field scan-purchase-product" type="text" placeholder="Search By Product Code or Product Name" name="scan_product" autofocus="">
                    </div>

                    <div class="get-product-lists"></div>

                  </div>

                  <div class="col-md-12">
                    <div class="table-responsive">
                     <table class="table table-bordered table-striped">  

                       <thead>
                         <tr>
                           <th>Image</th>
                           <th>Name</th>
                           <th>Price ($)</th>
                           <th>Quantity</th>
                           <th>Tax (%)</th>
                           <th>Total ($)</th>
                           <th>Action</th>
                         </tr>
                       </thead> 

                       <tbody id="purchase-conts">
                        @if(count(purchaseCarts()) > 0)
                         @foreach(purchaseCarts() as $cart)
                          <tr id="purchase_cart_{{$cart->id}}" class="purchase-carts">
                            <td width="15"> 
                              <img class="img-fluid featured-image" src="{{URL::to($cart->product->featured_image)}}">
                            </td>
                            <td width="15">{{$cart->product->product_name}}</td>
                            <td width="10" class="purchase-pro-price purchase_pro_price_{{$cart->id}}">{{$cart->product->purchase_price}}</td>
                            <td width="10">
                              <input type="number" class="form-control my-cart-qty cart_qty_{{$cart->id}}" name="cart_qty[]" data-id="{{$cart->id}}" value="{{$cart->cart_qty}}">
                            </td>
                            <td width="15">
                              <input type="number" name="purchase_product_tax[]" class="form-control product_purchase_tax purchase_product_tax_{{$cart->id}}" min="0" data-id="{{$cart->id}}" value="0">
                            </td> 
                            <td width="15" class="purchase-sub-total purchase_subtotal_{{$cart->id}}">{{$cart->product->purchase_price * $cart->cart_qty}}</td>
                            <td width="15"> 
                              <a href="#" class="btn btn-danger btn-sm delete-purchase-cart" data-id="{{$cart->id}}"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                         @endforeach
                        @else
                         <td class="no-data" colspan="7">
                           <h4>No Data Found</h4>
                         </td>
                        @endif
                       </tbody>
                     </table>
                     <div class="purchase-cal">
                       <div class="form-inline">
                         <p>
                           Sub Total : <input type="number" class="form-control purchase-subtotal" value="{{purchaseCartSubtotal()}}" placeholder="Sub Total" readonly="">
                         </p>     
                       </div>



                       <div class="form-inline">
                         <p class="purchase-discount-cal"> 
                           Discount ({{setting()->discount_type=='percentage'?"%":"$"}}) : <input type="number" class="form-control purchase-discount" placeholder="Discount" data-id="{{setting()->discount_type}}" min="0" value="0">
                           <a>
                         </p>     
                       </div> 
 

                       <div class="form-inline">
                         <p class="purchase-total-cal">
                           Total : <input type="number" class="form-control purchase-total"  placeholder="Total">
                         </p>     
                       </div>

                       <div class="form-inline">
                         <p class="purchase-pay-cal">
                           Pay : <input type="number" class="form-control purchase-pay"  placeholder="Pay">
                         </p>     
                       </div>

                       <div class="form-inline">
                         <p class="purchase-due-cal">
                           Due : <input type="number" class="form-control purchase-due"  placeholder="Due"  readonly="">
                         </p>     
                       </div>

                     </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
    </section>
 </div>


 <div class="modal fade bd-example-modal-lg" id="add-new-supplier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title">Add Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addSupplier">
        <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_name">Supplier Name <span class="required">*</span></label>
                      <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="Supplier Name" value="{{old('supplier_name')}}" required="">
                      @error('supplier_name')
                         <span class="alert alert-danger">{{ $message }}</span>
                      @enderror 
                         
                   </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_phone">Supplier Phone <span class="required">*</span></label>
                      <input type="number" name="supplier_phone" class="form-control" id="supplier_phone" placeholder="Supplier Phone" value="{{old('supplier_phone')}}" required="">
                      @error('supplier_phone')
                         <span class="alert alert-danger">{{ $message }}</span>
                      @enderror 
                         
                   </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_email">Supplier Email <span class="required">*</span></label>
                      <input type="email" name="supplier_email" class="form-control" id="supplier_email" placeholder="Supplier Email" value="{{old('supplier_email')}}" required="">
                      @error('supplier_email')
                         <span class="alert alert-danger">{{ $message }}</span>
                      @enderror 
                         
                   </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_address">Supplier Address <span class="required">*</span></label>
                      <input type="text" name="supplier_address" class="form-control" id="supplier_address" placeholder="Supplier Address" value="{{old('supplier_address')}}"  required="">
                      @error('supplier_address')
                         <span class="alert alert-danger">{{ $message }}</span>
                      @enderror 
                         
                   </div>
                  </div>
                 


                 <div class="col-md-12">
                 <div class="form-group">
                   <label for="image">Image ( Optional )</label>
                   <input name="supplier_image" type="file" id="image" accept="image/*" class="dropify" data-height="200"/>

                   @error('supplier_image')
                     <span class="alert alert-danger">{{ $message }}</span>
                   @enderror

                 </div>
               </div>

          </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success">Add Supplier</button>
        </div>
        </form>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection  