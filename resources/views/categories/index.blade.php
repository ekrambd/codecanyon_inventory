@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Categories</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <a href="#" class="btn btn-primary add-new add-new-category mb-2">Add New</a>
              	
              	<div class="fetch-data table-responsive">
              	  <table id="category-table" class="table table-bordered table-striped data-table">
                  <thead>
                    <tr>
                      <th>Category Name</th>
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

 <div class="modal" id="add-category-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title category-title">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="submit-add-category">
          <input type="hidden" name="category_id" class="category_id" value="">
          <div class="form-group">
            <label for="category_name">Category Name <span class="required">*</span></label>
            <input type="text" class="form-control category_name" name="category_name" id="category_name" placeholder="Category Name" value="" required="">
            <p class="err_category_name"></p>
          </div>


          <div class="form-group">
            <button type="submit" class="btn btn-success category-button-text">Add category</button>
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