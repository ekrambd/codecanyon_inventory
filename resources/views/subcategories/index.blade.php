@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Subcategory</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Subcategory</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Subcategory</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <a href="{{route('subcategories.create')}}" class="btn btn-primary add-new add-new-subcategory mb-2">Add New</a>
              	
              	<div class="fetch-data table-responsive">
              	  <table id="subcategory-table" class="table table-bordered table-striped data-table">
                  <thead>
                    <tr>
                      <th>Subcategory Name</th>
                      <th>Category</th>
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

 <div class="modal" id="add-subcategory-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title subcategory-title">Add Subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="submit-add-subcategory">
          <input type="hidden" name="subcategory_id" class="subcategory_id" value="">
          <div class="form-group">
            <label for="subcategory_name">Subcategory Name <span class="required">*</span></label>
            <input type="text" class="form-control subcategory_name" name="subcategory_name" id="subcategory_name" placeholder="Subcategory Name" value="" required="">
            <p class="err_subcategory_name"></p>
          </div>

          <div class="form-group">
            <label for="category_id">Select category <span class="required">*</span></label>
            <select class="form-control select2bs4 category_id" id="category_id" name="category_id" required="">
              
              
            </select>
            <p class="err_category_id"></p>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success subcategory-button-text">Add Subcategory</button>
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