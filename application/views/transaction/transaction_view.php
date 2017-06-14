         <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard').'dashboard';?>">Dashboard</a></li>
                    <li><a>Transaction</a></li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">  
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">


                                <!--Item Name Searchbox-->
                                <!--=================================================================================-->
                                
                                    <div class="input-group">
                                            <form role="search">
                                                <div id="the-basics-products">
                                                    <input class="typeahead form-control" id="srch-term" type="text" placeholder="Search Item" style="width:500px; font-size: 18px;">
                                                </div>
                                            </form>

                                          <div class="input-group-btn">

                                            <button class="btn btn-success" style="margin-top: -3px; height:48px; width:60px;" onclick="add_to_cart(document.getElementById('srch-term').value)"><i class="fa fa-cart-plus" style="font-size: 25px;"></i></button>

                                          </div>
                                    </div>
                                

                                

                                <?php
                                    // get products list from inventory 
                                    for($i = 0; $i < count($inventory); $i++){
                                        $products_list[$i] = $inventory[$i]->sku . ': ' . $inventory[$i]->name . ' ----- Php ' . $inventory[$i]->unit_price;
                                    }
                                    // converting php array to javascript (json)
                                    $json_list_products = json_encode($products_list);

                                    // output json_list to be retrieved by javascript for combo box (the-basic.js)
                                ?>
                                <span id="json_list_products" class="hidden"><?php echo $json_list_products ?></span>

                                <!--END Item Name Searchbox-->
                                <!--=================================================================================-->

                                <!--Condensed Table-->
                                <!--===================================================-->
                                <br><br><br>

                                <!--Customer Name Searchbox-->
                                <!--=================================================================================-->
                                <form role="search">
                                    <div class="input-group">
                                        <div id="the-basics-customers">
                                            <input class="typeahead form-control" id="srch-term" type="text" placeholder="Search Customer" style="width:500px; font-size: 18px;">
                                        </div>

                                          <!-- <div class="input-group-btn">
                                            <button id="btn_search" class="btn btn-default" type="submit" style="margin-top: -3px;"><i class="fa fa-search"></i></button>
                                          </div> -->
                                    </div>
                                </form>

                                <?php
                                    // get customers list from customers 
                                    for($i = 0; $i < count($customers); $i++){
                                        $customers_list[$i] = $customers[$i]->lastname . ', ' . $customers[$i]->firstname . ' ' . $customers[$i]->middlename;
                                    }
                                    // converting php array to javascript (json)
                                    $json_list_customers = json_encode($customers_list);

                                    // output json_list to be retrieved by javascript for combo box (the-basic.js)
                                ?>
                                <span id="json_list_customers" class="hidden"><?php echo $json_list_customers ?></span>

                                <!--END Customer Name Searchbox-->
                                <!--=================================================================================-->

                        </div> <!-- end of col-md-6 -->
                        <div class="col-md-6">
                            <!--Bordered Table-->
                                <!--===================================================-->

                                <div class="panel-body tran_container">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Items in Cart <i class="fa fa-shopping-cart"></i></h3> 
                                    </div>
                                    <div class="table-responsive">
                                        <table id="cashier-table" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">SKU</th>
                                                    <th class="text-center">ItemName</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Discount(%)</th>
                                                    <th class="text-center">Extended</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                

                                <div>
                                    <div class="col-md-6">
                                        <div class="panel media pad-all">
                                            <div class="media-left">
                                                <span class="icon-wrap icon-wrap-sm icon-circle bg-info">
                                                <i class="fa fa-shopping-cart fa-2x"></i>
                                                </span>
                                            </div>
                                
                                            <div class="media-body">
                                                <p class="text-muted mar-no">Number of Items</p>
                                                <p class="text-2x mar-no text-thin">543</p> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel media pad-all">
                                            <div class="media-left">
                                                <span class="icon-wrap icon-wrap-sm icon-circle bg-danger">
                                                <i class="fa fa-dollar fa-2x"></i>
                                                </span>
                                            </div>
                                
                                            <div class="media-body">
                                                <p class="text-muted mar-no">Total Payable</p>
                                                <p class="text-2x mar-no text-thin">654</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified">
                                        <a href="javascript:void(0)" class="btn btn-lg btn-info">Cancel</a>
                                        <a href="javascript:void(0)" class="btn btn-lg btn-mint">Clear List</a>
                                    </div>
                                    <div class="btn-group btn-group-justified">
                                        <a onclick="view_payment_report();" class="btn btn-lg btn-danger">Payment</a>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <!--===================================================
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

            <!-- Bootstrap modal (Password) -->
            <div class="modal fade" id="modal_payment" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Payment modal</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Transaction ID :</label>
                                        <div class="col-md-6">
                                            <label class="control-label"><strong>00001</strong></label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Customer name :</label>
                                        <div class="col-md-6">
                                            <label class="control-label"><strong>John Smith</strong></label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Number of Items :</label>
                                        <div class="col-md-6">
                                            <label class="control-label"><strong>40</strong></label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Payable :</label>
                                        <div class="col-md-6">
                                            <label class="control-label"><strong>$1,000</strong></label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-md-3">Amount:</label>
                                        <div class="col-md-6">
                                            <input name="trans_amount" placeholder="Enter Amount" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Balance :</label>
                                        <div class="col-md-6">
                                            <label class="control-label"> Sample Balance</label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="" class="btn btn-primary">Confirm & Print</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->


            <!-- Bootstrap modal for ADD TO CART -->
            <div class="modal fade" id="modal_form_add_to_cart" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Add to Cart</h3>
                        </div>
                        <div class="modal-body form">

                            <!-- <div class="form-group">

                                <div align="center"><img id="image" style="width:200px; height:200px;"></div>

                            </div>
                            <hr> -->

                            <form action="#" id="form_add_to_cart" class="form-horizontal">
                                <input type="hidden" value="" name="item_sku"/>
                                <input type="hidden" value="" name="item_name"/>
                                <input type="hidden" value="" name="item_unit_price"/>
                                <input type="hidden" value="" name="item_in_stock"/>
                                
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">SKU :</label>
                                        <div class="col-md-9">
                                            <input name="sku" placeholder="SKU" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Product Name :</label>
                                        <div class="col-md-9">
                                            <input name="name" placeholder="Product Name" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3">Description :</label>
                                        <div class="col-md-9">
                                            <input name="description" placeholder="Description" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                    <hr> -->
                                    <div class="row" style="padding-left: 50px;">
                                    <div class="form-group col-xs-6">
                                        <label style="width:100px;" class="control-label col-md-3">Unit Price :</label>
                                        <div class="col-md-9" style="width:140px;">
                                            <input name="unit_price" placeholder="Unit Price" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label style="width:100px;" class="control-label col-md-3">In Stock :</label>
                                        <div class="col-md-9" style="width:140px;">
                                            <input name="in_stock" placeholder="In Stock" class="form-control" type="text" disabled>
                                        </div>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" style="font-size: 18px; font-weight: bold;">Quantity :</label>
                                        <div class="col-md-9">
                                            <input style="font-size: 18px; font-weight: bold;" name="quantity" placeholder="Quantity" class="form-control" type="number" value="1">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-cart-plus"></i> &nbsp;Add to Cart</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->