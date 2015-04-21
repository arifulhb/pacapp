<li><a href="<?php echo base_url().'outlet';?>">Outlet</a></li> 
<li class="active"><?php echo $_action=='add'?'Add New':'Update';?> Outlet</li>
</ul>
<?php 
    //print_r($_record);
    if($_action=='update'){ 
        $_name      = $_record[0]['ol_name'];
        $_phone     = $_record[0]['ol_phone'];
        $_email     = $_record[0]['ol_email'];
        $_address   = $_record[0]['ol_address_line1'];
        $_address2  = $_record[0]['ol_address_line2'];
        $_city      = $_record[0]['ol_city'];
        $_zip       = $_record[0]['ol_zip'];
        $_country_key   = $_record[0]['ol_country'];        
        
    }//end if
    else{
        
            $_name      = '';
            $_phone     = '';
            $_email     = '';
            $_address   = '';
            $_address2  = '';
            $_city      = '';
            $_zip       = '';
            $_country_key   = '';                        
    }
    ?>
<section class="panel">
   
    <header class="panel-heading clearfix">
        Add New Outlet        
    </header>
    <div class="panel-body">
        <?php
        if(isset($_error)){ ?>
            <div class="alert alert-warning fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Warning!</strong><br>
            <?php echo $_error;?>
        </div>
            <?php                
                        
            $_name      = $_record[0]['ol_name'];
            $_phone     = $_record[0]['ol_phone'];
            $_email     = $_record[0]['ol_email'];
            $_address   = $_record[0]['ol_address_line1'];
            $_address2  = $_record[0]['ol_address_line2'];
            $_city      = $_record[0]['ol_city'];
            $_zip       = $_record[0]['ol_zip'];
            $_country_key   = $_record[0]['ol_country'];
            
        }//end error
        ?>
        <form class="form-horizontal" role="form" method="POST"
              action="<?php echo base_url().'outlet/save';?>" >
            <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>"/>
            <?php 
            if($_action=='update'){
            ?>
            <input type="hidden" id="_sn" name="_sn" value="<?php echo $_sn;?>"/>
            <?php } ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletName" class="col-lg-3 col-sm-3 control-label">Outlet Name *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputOutletName" value="<?php echo $_name;?>"
                                   name="inputOutletName" placeholder="Outlet Name" required="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletPhoneNumber" class="col-lg-3 col-sm-3 control-label">Phone Number</label>
                        <div class="col-lg-9">
                            <input type="tel" class="form-control" id="inputOutletPhoneNumber" value="<?php echo $_phone;?>"
                                   name="inputOutletPhoneNumber" placeholder="Phone Number">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 col-sm-3 control-label">Email Address</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" id="inputEmail"  value="<?php echo $_email;?>"
                                   name="inputEmail" placeholder="Email Address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputAddress" class="col-lg-3 col-sm-3 control-label">Address</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputAddress"  value="<?php echo $_address;?>"
                                   name="inputAddress" required="" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-md-offset-3">
                            <input type="text" class="form-control" id="inputAddress2" value="<?php echo $_address2;?>"
                                   name="inputAddress2" required="" placeholder="Address Line 2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCity" class="col-lg-3 col-sm-3 control-label">City</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputCity" value="<?php echo $_city;?>"
                                   name="inputCity" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputZipcode" class="col-lg-3 col-sm-3 control-label">ZipCode</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputZipcode"  value="<?php echo $_zip;?>"
                                   name="inputZipcode" placeholder="Zipcode">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputCountry" class="col-lg-3 col-sm-3 control-label">Country</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="inputCountry" name="inputCountry">                                
                                <?php 
                                foreach($_country as $key => $value): ?>
                                <option <?php echo $_country_key==$key?'SELECTED':'';?> value="<?php echo $key?>"><?php echo $value;?></option>    
                                    <?php                                    
                                endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <input type="submit" class="finish btn btn-primary" value="<?php echo ucfirst($_action);?> Outlet">
                    </p>
                </div>
            </div>
        </form>
    </div>
</section>