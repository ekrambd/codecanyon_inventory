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
   
   purchaseSubtotal();
   

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


   var warehouseTable = $('#warehouse-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/warehouses",
        },

        columns: [
            {data: 'warehouse_name', name: 'warehouse_name'},
            {data: 'warehouse_phone', name: 'warehouse_phone'},
            {data: 'warehouse_email', name: 'warehouse_email'},
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

      $(document).on('click', '.delete-warehouse', function(e){
      e.preventDefault();
      var int_warehouse_id = $(this).data('id');
        if(confirm('Do you want to delete this?'))
        {
            ajax_url = base_url+"/warehouses/"+int_warehouse_id;
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

   //purchase product ajax

   $(document).keypress(".scan-purchase-product",function(event){
            if (event.which == '10' || event.which == '13') {
                event.preventDefault();
            }
        });
 
 var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();


    $(document).on('input', '.scan-purchase-product', function(){
        var scan_purchase_product = $(this).val();
        if(scan_purchase_product == '')
        {
            $('.get-product-lists').html('');
        }
        else
        {
            if($.isNumeric(scan_purchase_product))
            {
               delay(function() { scanPurchaseProduct(base_url,scan_purchase_product); }, 200);
            }
            else
            {
                 scanPurchaseProduct(base_url,scan_purchase_product);
            }
        }
        
        
    });

    $(document).on('click', '.select-product', function(e){
       e.preventDefault();
      $('.no-data').css('display','none');
       var int_pro_id = $(this).data('id');
       $.ajax({

                   url: base_url+"/product-purchase/"+int_pro_id,
                   type:"GET",
                   dataType:"json",
                   success:function(response) { 

                    $('#purchase-conts').html('');


                     $(response.data).each(function(idx,val){
                        var imgUrl =  val.product.featured_image;
                         var table = '<tr id="purchase_cart_'+val.id+'" class="purchase-carts">'+
                                       '<td width="15"><img class="img-fluid featured-image" src="'+base_url+"/"+val.product.featured_image+'"></td>'+
                                       '<td width="15">'+val.product.product_name+'</td>'+
                                       '<td width="10" class="purchase-pro-price purchase_pro_price_'+val.id+'">'+val.product.purchase_price+'</td>'+
                                       '<td width="10"><input type="number" class="form-control my-cart-qty cart_qty_'+val.id+'" name="cart_qty[]" value="'+val.cart_qty+'" data-id="'+val.id+'"></td>'+
                                       '<td width="10"><input type="number" name="purchase_product_tax[]" class="form-control product_purchase_tax purchase_product_tax_'+val.id+'" min="0" value="0" data-id="'+val.id+'"></td>'+
                                       '<td width="15" class="purchase-sub-total purchase_subtotal_'+val.id+'">'+val.product.purchase_price * val.cart_qty+'</td>'+ 
                                       '<td width="15"><a href="#" class="btn btn-danger btn-sm delete-purchase-cart" data-id="'+val.id+'"><i class="fa fa-trash"></i></a></td>'+
                                    '</tr>';
                          $('#purchase-conts').append(table);

                          $('.scan-purchase-product').val('');

                          $('.get-product-lists').html('');

                          $('.scan-purchase-product').focus();

                          purchaseSubtotal();
                     });

                      

                    
                   },
                          
        });
    });

    $(document).on('input', '.product_purchase_tax', function(){
       var get_pro_id = $(this).data('id');
       var get_tax_val = parseFloat($(this).val());
       var get_cart_qty = parseFloat($('.cart_qty_'+get_pro_id).val());
  
       if($(this).val() == '')
       {
          $('.purchase_subtotal_'+get_pro_id).text(0);
          purchaseSubtotal();
          return false;
       }
       var get_pro_price = parseFloat($('.purchase_pro_price_'+get_pro_id).text() * get_cart_qty);
       var get_pro_percentage = (get_tax_val / 100) * get_pro_price;
       var get_pro_total = get_pro_price+get_pro_percentage;
       $('.purchase_subtotal_'+get_pro_id).text(get_pro_total.toFixed(2));
       purchaseSubtotal();
    });

    $(document).on('input', '.my-cart-qty', function(){
       var qty_pro_id = $(this).data('id');
       var qty_pro_tax = parseFloat($('.purchase_product_tax_'+qty_pro_id).val());
       var qty_pro_val = parseFloat($(this).val());
       if($(this).val() == '')
       {
           $('.purchase_subtotal_'+qty_pro_id).text(0);
           purchaseSubtotal();
           return false;
       }
       var qty_pro_price = parseFloat($('.purchase_pro_price_'+qty_pro_id).text());
       var qty_pro_total = qty_pro_price*qty_pro_val + (qty_pro_tax/100)*qty_pro_price;
       $('.purchase_subtotal_'+qty_pro_id).text(qty_pro_total.toFixed(2));
       purchaseSubtotal();
    });

    $(document).on('input', '.purchase-discount', function(){
        purchaseSubtotal();
    });


    $(document).on('input', '.purchase-pay', function(){
        var purchase_subtotal = $('.purchase-total').val();
        var purchase_pay = $(this).val();
        if(purchase_pay != '')
        {
            var purchase_due = $('.purchase-due').val();
            var purchase_total_result = parseFloat(purchase_subtotal) - parseFloat(purchase_pay);
            $('.purchase-due').val(purchase_total_result.toFixed(2));
        }
        
    });

    $(document).on('click', '.delete-purchase-cart', function(e){
       e.preventDefault();
       var purchase_cart_len = $('.purchase-carts').each(function(){}).length;
       
       if(confirm('Do you want to delete this?'))
       {  

         if(purchase_cart_len == 1)
         {   

             var noData = '<td class="no-data" colspan="7"><h4>No data found</h4></td>';

             $('#purchase-conts').html(noData);
         }
          var int_purchase_id = $(this).data('id');
       
          $.ajax({

                   url: base_url+"/delete-purchase-cart/"+int_purchase_id,
                   type:"GET",
                   dataType:"json",
                   success:function(response) {

                      console.log(response);

                      toastr.success(response.message);

                      
                       $('#purchase_cart_'+int_purchase_id).remove();

                       purchaseSubtotal();

                       $('.scan-purchase-product').focus();
                      
                   },
                          
        });

         
       }
       
    });


    
    $('#addSupplier').submit(function(e){
       e.preventDefault();
       var formData = new FormData(this);


      $.ajax({
          type:'POST',
          url: base_url+"/suppliers",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
              $('.dropify-preview').css('display','none');
              $('#supplier_name').val('');
              $('#supplier_phone').val('');
              $('#supplier_email').val('');
              $('#supplier_address').val('');
              $('#add-new-supplier').modal('hide');
             toastr.success('Successfully supplier has been added');
             getSuppliers(base_url);
          },
          error: function(data){
              console.log('Error:', data); 
          }
      }); 
    });
   

});

function scanPurchaseProduct(base_url,scan_purchase_product)
{
    $.ajax({ 

                   url: base_url+"/scan-purchase-product",
                   type:"POST",
                   data:{'scan_purchase_product':scan_purchase_product},
                   dataType:"json",
                   success:function(response) {

                      if(response.data.length > 0 && response.type == 'array')
                      {
                          var html = '';
                           html +="<ul class='list-group'>"; 

                           $(response.data).each(function(idx,val){

                               html+="<li class='list-group-item select-product mb-2' data-id="+val.id+">"+val.product_name+"</li>";

                           });

                           html+="</ul>";

                           $('.get-product-lists').html(html);
                      }

                      else if(response.data.length > 0 && response.type == 'cart')
                      {
                           $('#purchase-conts').html('');


                             $(response.data).each(function(idx,val){
                                var imgUrl =  val.product.featured_image;
                                 var table = '<tr id="purchase_cart_'+val.id+'" class="purchase-carts">'+
                                               '<td width="15"><img class="img-fluid featured-image" src="'+base_url+"/"+val.product.featured_image+'"></td>'+
                                               '<td width="15">'+val.product.product_name+'</td>'+
                                               '<td width="10" class="purchase-pro-price purchase_pro_price_'+val.id+'">'+val.product.purchase_price+'</td>'+
                                               '<td width="10"><input type="number" class="form-control my-cart-qty cart_qty_'+val.id+'" name="cart_qty[]" value="'+val.cart_qty+'" data-id="'+val.id+'"></td>'+
                                               '<td width="10"><input type="number" name="purchase_product_tax[]" class="form-control product_purchase_tax purchase_product_tax_'+val.id+'" min="0" value="0" data-id="'+val.id+'"></td>'+
                                               '<td width="15" class="purchase-sub-total purchase_subtotal_'+val.id+'">'+val.product.purchase_price * val.cart_qty+'</td>'+ 
                                               '<td width="15"><a href="#" class="btn btn-danger btn-sm delete-purchase-cart" data-id="'+val.id+'"><i class="fa fa-trash"></i></a></td>'+
                                            '</tr>';
                                  $('#purchase-conts').append(table);

                                  $('.scan-purchase-product').val('');

                                  $('.get-product-lists').html('');

                                  $('.scan-purchase-product').focus();

                                  purchaseSubtotal();
                             });

                             $('.scan-purchase-product').focus();

                      }
                      
                      else
                      {
                           toastr.error('No data found');
                      }

                   },
                          
              }); 
}

function purchaseSubtotal()
{   
  var purchaseSubtotal = 0;
  var float_purchase_discount = parseFloat($('.purchase-discount').val());
    $('.purchase-sub-total').each(function(idx,val){
        purchaseSubtotal += parseFloat($(this).html()); 
    });
    var get_cal_purchase = purchaseSubtotal - (float_purchase_discount/100)*purchaseSubtotal;
   $('.purchase-subtotal').val(purchaseSubtotal.toFixed(2));
   $('.purchase-total').val(get_cal_purchase.toFixed(2));

}

function getSuppliers(base_url)
{
     $.ajax({ 

                   url: base_url+"/get-suppliers",
                   type:"GET",
                   dataType:"json",
                   success:function(response) {
  
                    $('#supplier_id').html('');
                        $(response.data).each(function(idx,value){

                            var options = '<option value="'+value.id+'">'+value.supplier_name+"-"+value.supplier_phone+"-"+value.supplier_email+"-"+value.supplier_address+'</option>';

                            console.log(value);

                            $('#supplier_id').append(options);
                        });
                   },
                          
              }); 
}