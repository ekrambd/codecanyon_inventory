@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Customer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">

                <div class="row">
                  <div class="col-md-6">
                  	<div class="form-group">
		                  <label for="customer_name">Customer Name <span class="required">*</span></label>
		                  <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer Name" value="{{old('customer_name')}}" required="">
		                  @error('customer_name')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-6">
                  	<div class="form-group">
		                  <label for="customer_phone">Customer Phone <span class="required">*</span></label>
		                  <input type="number" name="customer_phone" class="form-control" id="customer_phone" placeholder="Customer Phone" value="{{old('customer_phone')}}" required="">
		                  @error('customer_phone')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-6">
                  	<div class="form-group">
		                  <label for="customer_email">Customer Email ( Optional )</label>
		                  <input type="email" name="customer_email" class="form-control" id="customer_email" placeholder="Customer Email" value="{{old('customer_email')}}">
		                  @error('customer_email')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>

                  <div class="col-md-6">
                  	<div class="form-group">
		                  <label for="customer_address">Customer Address <span class="required">*</span></label>
		                  <input type="text" name="customer_address" class="form-control" id="customer_address" placeholder="Customer Address" value="{{old('customer_address')}}"  required="">
		                  @error('customer_address')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>
                 


                 <div class="col-md-12">
                 <div class="form-group">
                   <label for="image">Image ( Optional )</label>
                   <input name="customer_image" type="file" id="image" accept="image/*" class="dropify" data-height="200"/>

                   @error('customer_image')
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