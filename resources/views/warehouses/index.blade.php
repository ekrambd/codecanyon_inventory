@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Warehouses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Warehouses</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Warehouses</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">

               <a href="{{route('warehouses.create')}}" class="btn btn-primary add-new add-new-product mb-3">Add New</a>
              	
              	<div class="fetch-data table-responsive">
              	  <table id="warehouse-table" class="table table-bordered table-striped data-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
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