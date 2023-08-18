@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">

               <a href="{{route('products.create')}}" class="btn btn-primary add-new add-new-product mb-3">Add New</a><br><br>

                <div class="card w-100">
                  <div class="card-header">
                  	<h5>Filter product</h5>
                  </div>

                  <div class="card-body">
                  	 <div class="row">
                  	 	<div class="col-md-6">
                  	 	  <div class="form-group">
                  	 	  	<label for="select_category_id">Filter by category</label>
                  	 	  	<select class="form-control select2bs4" id="select_category_id">
	                  	  	 <option value="" selected="" disabled="">Select category</option>
	                  	  	 @foreach(categories() as $category)
	                  	  	 <option value="{{$category->id}}">{{$category->category_name}}</option>
	                  	  	 @endforeach
	                  	    </select>
                  	 	  </div>
	                  	  
	                  	</div>


	                  	<div class="col-md-6">
                  	 	  <div class="form-group">
                  	 	  	<label for="select_subcategory_id">Filter by subcategory</label>
                  	 	  	<select class="form-control select2bs4" id="select_subcategory_id">
	                  	  	 <option value="" selected="" disabled="">Select subcategory</option>
                           @foreach(subcategories() as $subcategory)
                           <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
	                  	  	@endforeach
	                  	    </select>
                  	 	  </div>
	                  	  
	                  	</div>

	                  	<div class="col-md-12 d-flex justify-content-center button-product-filters">

		                  	<button type="button" class="btn btn-primary filter-product"><i class="fa fa-search"></i> SEARCH</button>

		                  	<button type="button" class="btn btn-danger reset-filter">RESET</button>
	                   </div>

                  	 </div>
                  </div>
                </div>
              	
              	<div class="fetch-data table-responsive">
              	  <table id="product-table" class="table table-bordered table-striped data-table">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Purchase Price</th>
                      <th>Sale Price</th>
                      <th>Stock</th>
                      <th>Stock Limit</th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="conts">
                  
                  </tbody>


              	</div>
                

              </div>
              
            </div>
    </section>
 </div>



@endsection