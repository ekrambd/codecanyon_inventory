@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Warehouse</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Warehouse</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Warehouse</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('warehouses.store')}}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="warehouse_name">Warehouse Name <span class="required">*</span></label>
		                  <input type="text" name="warehouse_name" class="form-control" id="warehouse_name" placeholder="Warehouse Name" value="{{old('warehouse_name')}}" required="">
		                  @error('warehouse_name')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="warehouse_phone">Warehouse Phone <span class="required">*</span></label>
		                  <input type="number" name="warehouse_phone" class="form-control" id="warehouse_phone" placeholder="Warehouse Phone" value="{{old('warehouse_phone')}}" required="">
		                  @error('warehouse_phone')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>


                  <div class="col-md-4">
                  	<div class="form-group">
		                  <label for="warehouse_email">Warehouse Email <span class="required">*</span></label>
		                  <input type="email" name="warehouse_email" class="form-control" id="warehouse_email" placeholder="Warehouse Email" value="{{old('warehouse_email')}}" required="">
		                  @error('warehouse_email')
				                 <span class="alert alert-danger">{{ $message }}</span>
		                  @enderror 
		                     
		               </div>
                  </div>

                  <div class="col-md-12">
                  	<div class="form-group">
		                  <label for="warehouse_address">Warehouse Address <span class="required">*</span></label>
		                  
                      <textarea class="form-control" rows="5" cols="20" name="warehouse_address" id="warehouse_address" placeholder="Warehouse Address" required="">{{old('warehouse_address')}}</textarea>
		                  @error('warehouse_address')
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