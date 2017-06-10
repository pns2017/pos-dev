            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?php echo $title; ?></h1>

                    <!--Searchbox-->
                    <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
                    <li class="active">Users List</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Users Information Table</h3>
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_user()"><i class="fa fa-plus-square"></i> &nbsp;Add User</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>UserID</th>
                                        <th>UserType</th>
                                        <th>Username</th>
                                        <th>LastName</th>
                                        <th>FirstName</th>
                                        <th>MiddleName</th>
                                        <th class="min-tablet">Registered</th>
                                        <th style="width:80px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

            <!-- Bootstrap modal (Basic Info) -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Users Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="user_id"/> 
                                <input type="hidden" value="" name="current_username"/>
                                <input type="hidden" value="" name="current_name"/>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Username :</label>
                                        <div class="col-md-9">
                                            <input name="username" placeholder="Username" class="form-control" type="text" >
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Password :</label>
                                        <div class="col-md-9">
                                            <input name="password" placeholder="Password" class="form-control" type="password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Re-enter Password :</label>
                                        <div class="col-md-9">
                                            <input name="repassword" placeholder="Re-enter Password" class="form-control" type="password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <hr>                      
                                    <!--Basic Info-->
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Last Name :</label>
                                        <div class="col-md-9">
                                            <input name="lastname" placeholder="Last Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">First Name :</label>
                                        <div class="col-md-9">
                                            <input name="firstname" placeholder="First Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Middle Name :</label>
                                        <div class="col-md-9">
                                            <input name="middlename" placeholder="Middle Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Contact :</label>
                                        <div class="col-md-9">
                                            <input name="contact" placeholder="Contact" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email :</label>
                                        <div class="col-md-9">
                                            <input name="email" placeholder="Email" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Address :</label>
                                        <div class="col-md-9">
                                            <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->

           <!-- Bootstrap modal (Privileges) -->
            <div class="modal fade" id="modal_form_privileges" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Users Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form_privileges" class="form-horizontal">
                                 <input type="hidden" value="" name="user_id"/>
                                 <input type="hidden" value="" name="current_administrator"/>
                                 <div class="form-body">
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Administrator</label>
                                        <div class="col-md-9">
                                            <select name="administrator" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Cashier Module</label>
                                        <div class="col-md-9">
                                            <select name="cashier" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                    
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Inventory Module</label>
                                        <div class="col-md-9">
                                            <select name="inventory" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                    
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Suppliers Module:</label>
                                        <div class="col-md-9">
                                            <select name="supplier" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Customers Module:</label>
                                        <div class="col-md-9">
                                            <select name="customer" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Users Module:</label>
                                        <div class="col-md-9">
                                            <select name="user" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">   
                                        <label class="control-label col-md-3">Reports Module:</label>
                                        <div class="col-md-9">
                                            <select name="report" class="form-control" >
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                    
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->

