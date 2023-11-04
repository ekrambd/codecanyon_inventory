@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('suppliers.update',$supplier->id)}}" method="POST" enctype="multipart/form-data">
              	@csrf
              	@method('PATCH')
                <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="supplier_name">Supplier Name <span class="required">*</span></label>
		                  <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="Supplier Name" value="{{old('supplier_name',$supplier->supplier_name)}}" required="">
		                  @error('supplier_name')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="supplier_phone">Supplier Phone <span class="required">*</span></label>
		                  <input type="number" name="supplier_phone" class="form-control" id="supplier_phone" placeholder="Supplier Phone" value="{{old('supplier_phone',$supplier->supplier_phone)}}" required="">
		                  @error('supplier_phone')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="supplier_email">Supplier Email <span class="required">*</span></label>
		                  <input type="email" name="supplier_email" class="form-control" id="supplier_email" placeholder="Supplier Email" value="{{old('supplier_email',$supplier->supplier_email)}}" required="">
		                  @error('supplier_email')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="supplier_address">Supplier Address <span class="required">*</span></label>
                      
                      <textarea class="form-control" rows="5" cols="20" name="supplier_address" id="supplier_address" placeholder="Supplier Address" required="">{{old('supplier_address',$supplier->supplier_address)}}</textarea>
                      @error('supplier_address')
                         <span class="alert alert-danger">{{ $message }}</span>
                      @enderror 
                         
                   </div>
                  </div>
                 


                 <div class="col-md-12">
                 	@if($supplier->supplier_image != NULL)
                 	 <div class="form-group">
	                   <label for="image">Image <span class="required">*</span></label>
	                   <input name="supplier_image" type="file" id="image" accept="image/*" class="dropify" data-height="200" data-default-file="{{URL::to($supplier->supplier_image)}}" />

	                   @error('supplier_image')
	                     <span class="alert alert-danger">{{ $message }}</span>
	                   @enderror

	                 </div>
                 	@else
	                 <div class="form-group">
	                   <label for="image">Image ( Optional )</label>
	                   <input name="supplier_image" type="file" id="image" accept="image/*" class="dropify" data-height="200"/>

	                   @error('supplier_image')
	                     <span class="alert alert-danger">{{ $message }}</span>
	                   @enderror

	                 </div>
	               @endif 
               </div>

                </div>

                

  

                <div class="form-group">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>

                </div>

                  
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
    </section>
 </div>
@endsection