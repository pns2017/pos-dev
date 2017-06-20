        var save_method; //for save method string
        var table;
        var text;
        var tableID = $("table").attr('id');

        $(document).ready(function() 
        {
            if(tableID == "customers-table")
            {
            //datatables
                    table = $('#customers-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "customers/customers_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],
                    });
            }
            else if(tableID == "suppliers-table")
            {
                    table = $('#suppliers-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "suppliers/suppliers_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],
                        
                        "rowCallback": function( row, data, index )
                        {
                          var status = data[6],
                              $node = this.api().row(row).nodes().to$();

                          if (status == 'Inactive') 
                          {
                            $node.css('background-color', 'Pink');
                          }
                        }                        
                    });
            }
            else if(tableID == "inventory-table")
            {
                    table = $('#inventory-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "inventory/inventory_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],
                        // below reorder point is pink, equal is yellow, empty is gray
                        "rowCallback": function( row, data, index ) 
                        {
                          var stock = parseInt(data[6]), //data[2]
                              reorder = parseFloat(data[8]), //data[4]
                              $node = this.api().row(row).nodes().to$();

                          if (stock < reorder && stock != 0) 
                          {
                            $node.css('background-color', 'Pink');
                          }
                          else if (stock == reorder) 
                          {
                            $node.css('background-color', '#ffff66'); 
                          }
                          else if (stock == 0) 
                          {
                            $node.css('background-color', '#cccccc'); 
                          }  
                        }                  
                    });           
            }
            else if(tableID == "supply-logs-table")
            {
                    table = $('#supply-logs-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "supply_logs/supply_logs_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],

                        "rowCallback": function( row, data, index ) {
                          var qty = parseInt(data[4]),
                              $node = this.api().row(row).nodes().to$();

                          if (qty < 0) {
                             $node.css('background-color', 'Pink');
                          } 
                        }               
                    });           
            }
            else if(tableID == "damaged-items-table")
            {
                    table = $('#damaged-items-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "damaged_items/damaged_items_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],

                        "rowCallback": function( row, data, index ) {
                          var qty = parseInt(data[3]),
                              $node = this.api().row(row).nodes().to$();

                          if (qty < 0) {
                             $node.css('background-color', 'Pink');
                          } 
                        }               
                    });           
            }
            else if(tableID == "users-table")
            {
                    table = $('#users-table').DataTable({ 
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "users/users_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],

                        "rowCallback": function( row, data, index ) {
                          var user_type = data[1],
                              $node = this.api().row(row).nodes().to$();

                          if (user_type == 'administrator') {
                             $node.css('background-color', 'Cyan');
                          } 
                        }               
                    });           
            }
            else if(tableID == "cashier-table")
            {
                    table = $('#cashier-table').DataTable({ 

                        searching: false, paging: false,
                        "bInfo" : false,
                        "oLanguage": 
                        {
                            "sEmptyTable": ' ',
                            "sInfoEmpty": 'as'
                        },
                 
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                 
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "cashier/cashier_controller/ajax_list",
                            "type": "POST",
                        },
                 
                        //Set column definition initialisation properties.
                        "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": false, //set not orderable
                        },
                        ],

                        "rowCallback": function( row, data, index ) {
                          var discount = data[4],
                              $node = this.api().row(row).nodes().to$();

                          if (discount != '' && discount != '0') {
                             $node.css('background-color', '#99ffdd');
                          } 
                        }           
                    });  
                    set_transaction_details();
            }          
        });

        // reset file path everytime modal_form_view is closed - for image upload
        $('#modal_form_view').on('hidden.bs.modal', function(){
            $("#userfile").val("");
        });
        

        // refresh transaction item count and subtotal
        function set_transaction_details()
        {
            // ajax cancel an item
            $.ajax({
                url : "cashier/cashier_controller/ajax_set_transaction",
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    // updating total payable
                    $('#subtotal').html(data.subtotal);

                    // updating total items
                    $('#item_count').html(data.item_count);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('');
                }
            });
        }

        function view_product(sku)
        {
            if(document.getElementById('form_view') != null)
            {
                $('#form_view')[0].reset(); // reset form on modals
            }

            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "inventory/inventory_controller/ajax_edit/" + sku,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="sku"]').val(data.sku);
                    $('[name="name"]').val(data.name);
                    $('[name="description"]').val(data.description);
                    $('[name="category"]').val(data.category);
                    $('[name="unit_price"]').val(data.unit_price);
                    $('[name="unit_cost"]').val(data.unit_cost);
                    $('[name="in_stock"]').val(data.in_stock);
                    $('[name="unit_sold"]').val(data.unit_sold);
                    $('[name="unit_damaged"]').val(data.unit_damaged);
                    $('[name="unit_lost"]').val(data.unit_lost);
                    $('[name="reorder_point"]').val(data.reorder_point);
                    // fetch image path
                    document.getElementById('image').src = "uploads/"+data.imgpath;
                    
                    $('#modal_form_view').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('View Product'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function edit_privileges(id) // for customer table
        {
            save_method = 'update-privileges';
            $('#form')[0].reset(); // reset form on modals
            $('#form_privileges')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "users/users_controller/ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="user_id"]').val(data.user_id);
                    $('[name="administrator"]').val(data.administrator).prop('selected', true);
                    $('[name="current_administrator"]').val(data.administrator);
                    $('[name="cashier"]').val(data.cashier).prop('selected', true);
                    $('[name="inventory"]').val(data.inventory).prop('selected', true);
                    $('[name="supplier"]').val(data.supplier).prop('selected', true);
                    $('[name="customer"]').val(data.customer).prop('selected', true);
                    $('[name="user"]').val(data.user).prop('selected', true);
                    $('[name="report"]').val(data.report).prop('selected', true);

                    $('#modal_form_privileges').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Privileges'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function view_edit_user(id) // for customer table
        {
            save_method = 'update-user';
            $('#form')[0].reset(); // reset form on modals
            $('#form_privileges')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "users/users_controller/ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="user_id"]').val(data.user_id);
                    $('[name="username"]').val(data.username);
                    $('[name="password"]').val(data.password);
                    $('[name="repassword"]').val(data.password);
                    $('[name="current_username"]').val(data.username);
                    $('[name="lastname"]').val(data.lastname);
                    $('[name="firstname"]').val(data.firstname);
                    $('[name="middlename"]').val(data.middlename);
                    $('[name="current_name"]').val(data.lastname + data.firstname + data.middlename);
                    $('[name="contact"]').val(data.contact);
                    $('[name="email"]').val(data.email);
                    $('[name="address"]').val(data.address);

                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
         
        function add_customer() // ---> calling for the Add Modal form
        {
            save_method = 'add-customer';
            text = 'Add Customer';
            
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text(text); // Set Title to Bootstrap modal title
        }

        function add_supplier() // ---> calling for the Add Modal form
        {     
            save_method = 'add-supplier';
            text = 'Add Supplier';

            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text(text); // Set Title to Bootstrap modal title
        }

        function add_product()
        {
            save_method = 'add-product';

            $('#form')[0].reset(); // reset form on modals
            $('#form_add_stock')[0].reset(); // reset form on modals
            $('#form_damaged_items')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Product'); // Set Title to Bootstrap modal title
        }

        function add_user()
        {
            save_method = 'add-user';

            $('#form')[0].reset(); // reset form on modals
            $('#form_privileges')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
        }

        function add_to_cart(item_data)
        {       
            //Loading the variable - Splitting search item data
            var mystr = item_data;

            //Splitting it with : as the separator
            var myarr = mystr.split(":");

            //Then read the values from the array where 0 is the first
            var sku = myarr[0];


            save_method = 'add-to-cart';

            $('#form')[0].reset(); // reset form on modals
            $('#form_add_to_cart')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "inventory/inventory_controller/ajax_edit/" + sku,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="sku"]').val(data.sku);
                    // hidden item data values for retrieval (not disabled input)
                    $('[name="item_sku"]').val(data.sku);
                    $('[name="item_name"]').val(data.name);
                    $('[name="item_unit_price"]').val(data.unit_price);
                    $('[name="item_in_stock"]').val(data.in_stock);


                    $('[name="name"]').val(data.name);
                    // $('[name="description"]').val(data.description);
                    $('[name="unit_price"]').val(data.unit_price);
                    $('[name="in_stock"]').val(data.in_stock);
                    // fetch image path
                    // document.getElementById('image').src = "uploads/"+data.imgpath;

                    $('#modal_form_add_to_cart').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Add to Cart'); // Set Title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Item Not Found');
                }
            });
        }
        // cancel a single item from cart
        function cancel_item(sku)
        {
            // ajax cancel an item
            $.ajax({
                url : "cashier/cashier_controller/ajax_cancel_item/"+sku,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    $('#modal_form_add_to_cart').modal('hide');
                    reload_table();

                    // updating total payable
                    $('#subtotal').html(data.subtotal);
                    // updating total items
                    $('#item_count').html(data.item_count);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Unable to cancel this item');
                }
            });
        }
        // provide event listener function for link buttons
        document.getElementById('cancel_transaction').addEventListener('click', cancel_transaction, true);

        // cancelling whole transaction
        function cancel_transaction()
        {
            // ajax cancel an item
            $.ajax({
                url : "cashier/cashier_controller/ajax_cancel_transaction",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    $('#modal_form_add_to_cart').modal('hide');
                    reload_table();

                    // updating total payable
                    $('#subtotal').html(data.subtotal);
                    // updating total items
                    $('#item_count').html(data.item_count);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Unable to cancel transaction');
                }
            });
        }

        function edit_customer(id) // for customer table
        {
            save_method = 'update-customer';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "customers/customers_controller/ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="customer_id"]').val(data.customer_id);
                    $('[name="lastname"]').val(data.lastname);
                    $('[name="firstname"]').val(data.firstname);
                    $('[name="middlename"]').val(data.middlename);
                    $('[name="current_name"]').val(data.lastname + data.firstname + data.middlename);
                    $('[name="address"]').val(data.address);
                    $('[name="city"]').val(data.city);
                    $('[name="contact"]').val(data.contact);
                    $('[name="email"]').val(data.email);

                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Customer'); // Set title to Bootstrap modal title
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
        

        function edit_supplier(id) // for supplier table
        {
            save_method = 'update-supplier';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "suppliers/suppliers_controller/ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="supplier_id"]').val(data.supplier_id);
                    $('[name="name"]').val(data.name);
                    $('[name="current_name"]').val(data.name);
                    $('[name="address"]').val(data.address);
                    $('[name="city"]').val(data.city);
                    $('[name="contact"]').val(data.contact);
                    $('[name="email"]').val(data.email);
                    $('[name="status"]').val(data.status).prop('selected', true);
                    $('[name="products"]').val(data.products);

                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Supplier'); // Set title to Bootstrap modal title
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function edit_product(id) // for supplier table
        {
            save_method = 'update-product';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
         
            //Ajax Load data from ajax
            $.ajax({
                url : "inventory/inventory_controller/ajax_edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="sku"]').val(data.sku);
                    $('[name="current_name"]').val(data.name);
                    $('[name="name"]').val(data.name);
                    $('[name="description"]').val(data.description);
                    $('[name="category"]').val(data.category);
                    $('[name="unit_price"]').val(data.unit_price);
                    $('[name="unit_cost"]').val(data.unit_cost);
                    $('[name="reorder_point"]').val(data.reorder_point);

                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }         

        // adding stock dialog opener
        function add_stock(sku)
        {
            // call get suppliers from controller

            save_method = 'add-stock';
            $('#form_add_stock')[0].reset(); // reset form on modals
            $('#form')[0].reset(); // reset form on modals
            $('#form_damaged_items')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "inventory/inventory_controller/ajax_edit/" + sku,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="sku"]').val(data.sku);
                    $('[name="name"]').val(data.name);
                    $('[name="cost"]').val(data.unit_cost);
                    $('[name="unit_cost"]').val(data.unit_cost);
                    $('[name="in_stock"]').val(data.in_stock);
                    $('[name="reorder_point"]').val(data.reorder_point);

                    $('#modal_form_add_stock').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Add Stock'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        // damaged items dialog opener
        function damaged_items(sku)
        {
            // call get suppliers from controller

            save_method = 'damaged-items';
            $('#form_damaged_items')[0].reset(); // reset form on modals
            $('#form_add_stock')[0].reset(); // reset form on modals
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "inventory/inventory_controller/ajax_edit/" + sku,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $('[name="sku"]').val(data.sku);
                    $('[name="name"]').val(data.name);
                    $('[name="unit_cost"]').val(data.unit_cost);
                    $('[name="in_stock"]').val(data.in_stock);
                    $('[name="unit_damaged"]').val(data.unit_damaged);

                    $('#modal_form_damaged_items').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Damaged Items'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
         
        function save()
        {
            // resetting errors in form validations
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
         
            // initialize form for both add and update as default 
            $form = '#form';

            if(save_method == 'add-customer') 
            {
                url = "customers/customers_controller/ajax_add";
            }
            else if(save_method == 'update-customer')
            {
                url = "customers/customers_controller/ajax_update";
            }
            else if(save_method == 'add-supplier')
            {
                url = "suppliers/suppliers_controller/ajax_add";
            }
            else if(save_method == 'update-supplier')
            {
                url = "suppliers/suppliers_controller/ajax_update";
            }
            else if(save_method == 'add-product') 
            {
                url = "inventory/inventory_controller/ajax_add";
            }
            else if(save_method == 'update-product') 
            {
                url = "inventory/inventory_controller/ajax_update";
            }
            else if(save_method == 'add-user') 
            {
                url = "users/users_controller/ajax_add";
            }
            else if(save_method == 'update-user') 
            {
                url = "users/users_controller/ajax_update";
            }
            else if(save_method == 'update-privileges') 
            {
                // change form for add stock to form_add_stock
                $form = '#form_privileges';
                url = "users/users_controller/ajax_privileges_update";
            }
            // if add stock
            else if(save_method == 'add-stock') 
            {
                // change form for add stock to form_add_stock
                $form = '#form_add_stock';
                url = "inventory/inventory_controller/ajax_add_stock";
            }
            // if damaged items
            else if(save_method == 'damaged-items') 
            {
                // change form for damaged items to form_damaged_items
                $form = '#form_damaged_items';
                url = "inventory/inventory_controller/ajax_damaged_items";
            }
            // if damaged items
            else if(save_method == 'add-to-cart') 
            {
                // change form for damaged items to form_damaged_items
                $form = '#form_add_to_cart';
                url = "cashier/cashier_controller/ajax_add_to_cart";
            }
         
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $($form).serialize(),
                dataType: "JSON",
                success: function(data)
                {
         
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        $('#modal_form_add_stock').modal('hide');
                        $('#modal_form_damaged_items').modal('hide');
                        $('#modal_form_privileges').modal('hide');
                        $('#modal_payment').modal('hide');
                        $('#modal_form_add_to_cart').modal('hide');
                        reload_table();

                        // updating total items and payable for cashier
                        if(save_method == 'add-to-cart') 
                        {
                            $('#item_count').html(data.item_count);
                            $('#subtotal').html(data.subtotal);

                            $('#srch-term').typeahead('val', '');
                        }
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
         
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
         
                }
            });
        }
         
        function delete_customer(id)
        {
            if(confirm('Are you sure to delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "customers/customers_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
         
            }
        }

        function delete_supplier(id)
        {
            if(confirm('Are you sure to delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "suppliers/suppliers_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
         
            }
        }

        function delete_product(sku)
        {
            if(confirm('Are you sure to delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "inventory/inventory_controller/ajax_delete/"+sku,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        $('#modal_form_add_stock').modal('hide');
                        $('#modal_form_damaged_items').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });

            }
        }

        function delete_user(id)
        {
            if(confirm('Are you sure to delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "users/users_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        $('#modal_form_privileges').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Unable to delete one remaining administrator account');
                    }
                });

            }
        }