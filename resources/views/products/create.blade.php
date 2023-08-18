@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="product_name">Product Name <span class="required">*</span></label>
		                  <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name" value="{{old('product_name')}}" required="">
		                  @error('product_name')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-4">
                      	<div class="form-group">
    		                  <label for="select_category_id">Select category <span class="required">*</span></label>
    		                  <select class="form-control select2bs4" name="category_id" id="select_category_id" required="">
    		                  	<option value="" selected="" disabled="">Select category</option>
    		                  	@foreach(categories() as $category)
    		                  	 <option value="{{$category->id}}">{{$category->category_name}}</option>
    		                  	@endforeach
    		                  </select>
    		                  @error('category_id')
    				                 <span class="alert alert-danger">{{ $message }}</span>
    		                  @enderror 
    		                     
    		             </div>
                  </div>



                  <div class="col-md-4">
                        <div class="form-group">
                          <label for="select_subcategory_id">Select subcategory</label>
                          <select class="form-control select2bs4" name="subcategory_id" id="select_subcategory_id">
                            <option value="" selected="" disabled="">Select subcategory</option>
                            
                          </select>
                          @error('subcategory_id')
                             <span class="alert alert-danger">{{ $message }}</span>
                          @enderror 
                             
                     </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="product_code">Product Code <span class="required">*</span></label>
                      <input type="number" class="form-control" name="product_code" id="product_code" placeholder="Product Code" value="{{old('product_code')}}" required="">
                      @error('product_code')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="product_unit">Product Unit <span class="required">*</span></label>
                      <input type="text" class="form-control" name="product_unit" id="product_unit" placeholder="Product Unit" value="{{old('product_unit')}}" required="">
                      @error('product_unit')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="purchase_price">Purchase Price <span class="required">*</span></label>
                      <input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="Purchase Price" value="{{old('purchase_price')}}" required="">
                      @error('purchase_price')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>



                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sale_price">Sale Price <span class="required">*</span></label>
                      <input type="number" class="form-control" name="sale_price" id="sale_price" placeholder="Sale Price" value="{{old('sale_price')}}" required="">
                      @error('sale_price')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="product_stock">Product Stock <span class="required">*</span></label>
                      <input type="number" class="form-control" name="product_stock" id="product_stock" placeholder="Product Stock" value="{{old('product_stock')}}" required="">
                      @error('product_stock')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="stock_limit">Stock limit <span class="required">*</span></label>
                      <input type="number" class="form-control" name="stock_limit" id="stock_limit" placeholder="Stock limit" value="{{old('stock_limit')}}" required="">
                      @error('stock_limit')
                             <span class="alert alert-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                 

                 <div class="col-md-12">
                   <div class="form-group">
                   <label for="product_description">Description <span class="required">*</span></label>
                   <textarea id="product_description" name="product_description" required=""></textarea>
                   @error('product_description')
                     <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
                 </div>
                 </div>


                 <div class="col-md-12">
                 <div class="form-group">
                   <label for="image">Image <span class="required">*</span></label>
                   <input name="featured_image" type="file" id="image" accept="image/*" class="dropify" data-height="200" required="" />

                   @error('featured_image')
                     <span class="alert alert-danger">{{ $message }}</span>
                   @enderror

                 </div>
               </div>

                </div>

                

  

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </div>

                  
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
    </section>
 </div>
@endsection