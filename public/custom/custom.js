$(document).ready(function(){
	$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

	$('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    }) 
   

   $("#category_id").select2({
          theme: 'bootstrap4', // Use the Bootstrap 4 theme
          dropdownParent: $("#add-subcategory-modal") // Attach the dropdown to the modal
    });

   $('.dropify').dropify();


   $('#product_description').summernote(
      {
        height: 300,
        focus: true
      }
    );

    var base_url = localStorage.getItem('base_url');


     var ajax_url = '';
     
     var type= '';
 
    var categoryTable = $('#category-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/categories",
        },

        columns: [
            {data: 'category_name', name: 'category_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });



    var subcategoryTable = $('#subcategory-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/subcategories",
        },

        columns: [
            {data: 'subcategory_name', name: 'subcategory_name'},
            {data: 'category', name: 'category'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    var productTable = $('#product-table').DataTable({ 
        searching: true, 
        processing: true,
        serverSide: true,
        ordering: false,
        responsive:true,
        stateSave: true,
        ajax: {
          url: base_url+"/products",
          data: function (d) {
                d.category_id = $('#select_category_id').val(),
                d.subcategory_id = $('#select_subcategory_id').val(),
                d.search = $('.dataTables_filter input').val()
            }
        },

        columns: [
            {data: 'image', name: 'image'},
            {data: 'product_name', name: 'product_name'},
            {data: 'category', name: 'category'},
            {data: 'purchase_price', name: 'purchase_price'},
            {data: 'sale_price', name: 'sale_price'},
            {data: 'product_stock', name: 'product_stock'},
            {data: 'stock_limit', name: 'stock_limit'},
            {data: 'product_unit', name: 'product_unit'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]


    });
   

   $('.filter-product').click(function(e){
        e.preventDefault();
        productTable.draw(); 
    });


   var supplierTable = $('#supplier-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/suppliers",
        },

        columns: [
            {data: 'supplier_name', name: 'supplier_name'},
            {data: 'supplier_phone', name: 'supplier_phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


   var customerTable = $('#customer-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/customers",
        },

        columns: [
            {data: 'customer_name', name: 'customer_name'},
            {data: 'customer_phone', name: 'customer_phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });



    $(document).on('click', '.delete-category', function(e){
    	e.preventDefault();
    	var int_category_id = $(this).data('id');
    	  if(confirm('Do you want to delete this?'))
	      {
	          ajax_url = base_url+"/categories/"+int_category_id;
	         $.ajax({

	                 url: ajax_url,
	                 type:"DELETE",
	                 dataType:"json",
	                 success:function(data) {
	                    $('.data-table').DataTable().ajax.reload(null, false);
	                    toastr.success(data);

	                 },
	                        
	            });
	      }
    });


     $(document).on('click', '.delete-customer', function(e){
      e.preventDefault();
      var int_customer_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            ajax_url = base_url+"/customers/"+int_customer_id;
           $.ajax({

                   url: ajax_url,
                   type:"DELETE",
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                      toastr.success(data);

                   },
                          
              });
        }
    });


    $(document).on('click', '.add-new-subcategory', function(e){
        e.preventDefault();
        $('#add-subcategory-modal').modal('show');
        $('.subcategory-title').text('Add Subcategory');
        ajax_url = base_url+"/all-categories";
         $('#category_id').html('<option value="" selected="" disabled="">Select category</option>');
         $('.subcategory-button-text').text('Add Subcategory');
       $.ajax({

               url: ajax_url,
               type:"GET",
               dataType:"json",
               success:function(data) {
                $(data.categories).each(function(idx,val){

                          $('#category_id').append('<option value="'+val.id+'">'+val.category_name+'</option>');

                          $('#subcategory_name').val('');
                         var firstOptionValue = $("#category_id option:first").val();
                         $("#category_id").val(firstOptionValue).trigger("change");
 
                      }); 
               },
                      
          });  
       
    });

    $(document).on('submit', '#submit-add-subcategory', function(e){
        e.preventDefault();
        var subcategory_name = $('#subcategory_name').val();
        var category_id = $('#category_id').val(); 
       
        var subcategory_id = $('.subcategory_id').val();

        type = (subcategory_id === "") ? "POST" : "PATCH";
        ajax_url = base_url + ((subcategory_id === "") ? "/subcategories" : "/subcategories/" + subcategory_id);

        $.ajax({

                   url: ajax_url,
                   type: type,
                   data:{'subcategory_name':subcategory_name, 'category_id':category_id},
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                       toastr.success(data.message);
                       $('#subcategory_name').val('');
                       $('#add-subcategory-modal').modal('hide');
                       var firstOptionValue = $("#category_id option:first").val();
                       $("#category_id").val(firstOptionValue).trigger("change");
                       

                   },
                   error:function (response){
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[class=err_'+field_name+']').html('<p class="text-strong text-danger">' +error+ '</p>')
                        })
                    }
                          
        });
    });

    $(document).on('click', '.edit-subcategory', function(e){
       e.preventDefault();
      $('#add-subcategory-modal').modal('show');
       $('#category_id').html('<option value="" selected="" disabled="">Select category</option>');
       $('.subcategory-title').text('Edit Subcategory');
       var get_subcategory_id = $(this).data('id');
       $('.subcategory_id').val(get_subcategory_id);
       $('.subcategory-button-text').text('Update Subcategory');
       $.ajax({

                   url: base_url+"/subcategories/"+get_subcategory_id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                      
                      $('#subcategory_name').val(data.subcategory.subcategory_name);

                      $(data.categories).each(function(idx,val){

                         var is_selected = (data.subcategory.category_id == val.id) ? "selected" : "not_selected";

                          $('#category_id').append('<option value="'+val.id+'" '+is_selected+'>'+val.category_name+'</option>');

                      });
                   },
                          
        });
    });
    
    $(document).on('click', '.delete-subcategory', function(e){
        e.preventDefault();
        var int_subcategory_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            ajax_url = base_url+"/subcategories/"+int_subcategory_id;
           $.ajax({

                   url: ajax_url,
                   type:"DELETE",
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                      toastr.success(data);
                   },
                          
              });
        }
    });


    $(document).on('click', '.delete-supplier', function(e){
        e.preventDefault();
        var int_supplier_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            ajax_url = base_url+"/suppliers/"+int_supplier_id;
           $.ajax({

                   url: ajax_url,
                   type:"DELETE",
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                      toastr.success(data);
                   },
                          
              });
        }
    });



    $(document).on('click', '.delete-product', function(e){
        e.preventDefault();
        var int_product_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            ajax_url = base_url+"/products/"+int_product_id;
           $.ajax({

                   url: ajax_url,
                   type:"DELETE",
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                      toastr.success(data);
                   },
                          
              });
        }
    });


    $(document).on('click', '.add-new-category', function(e){
       e.preventDefault();
       $('#add-category-modal').modal('show');   
       $('.category-title').text('Add Category');
      $('.category-button-text').text('Add Category');
       $('#category_name').val('');
    });

    $(document).on('submit', '#submit-add-category', function(e){
       e.preventDefault();

       var category_name = $('#category_name').val(); 
       var int_category_id = $('.category_id').val();

        type = (int_category_id === "") ? "POST" : "PATCH";
        ajax_url = base_url + ((int_category_id === "") ? "/categories" : "/categories/" + int_category_id);
        

        $.ajax({

                   url: ajax_url,
                   type: type,
                   data:{'category_name':category_name},
                   dataType:"json",
                   success:function(data) {
                      $('.data-table').DataTable().ajax.reload(null, false);
                       toastr.success(data.message);
                       $('#category_name').val('');
                       $('#add-category-modal').modal('hide');
                       
                       

                   },
                   error:function (response){
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[class=err_'+field_name+']').html('<p class="text-strong text-danger">' +error+ '</p>')
                        })
                    }
                          
        });
       
    });

    $(document).on('click', '.edit-category', function(e){
      e.preventDefault();
      $('#add-category-modal').modal('show');
      var get_category_id = $(this).data('id');
      $('.category_id').val(get_category_id); 
      $('.category-title').text('Edit Category');
      $('.category-button-text').text('Update Category');
      $.ajax({

                   url: base_url+"/categories/"+get_category_id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                      
                      $('#category_name').val(data.category.category_name);

                    
                   },
                          
        });

    });


    $(document).on('change', '#select_category_id', function(){
         var select_category_id = $(this).val();
         $('#select_subcategory_id').html('<option value="" selected="" disabled="">Select subcategory</option>');
         $.ajax({

                   url: base_url+"/get-subcategories",
                   type:"POST",
                   data:{'category_id':select_category_id},
                   dataType:"json",
                   success:function(response) {
                      
                        $(response.data).each(function(idx,val){
                            $('#select_subcategory_id').append('<option value='+val.id+'>'+val.subcategory_name+'</option>');
                        });

                    
                   },
                          
        });
    });

    $(document).on('click', '.reset-filter', function(e){
        if(confirm('Do you want to reset?'))
        {
            window.location.reload();
        }
    });

});

