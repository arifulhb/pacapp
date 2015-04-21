<li><a href="<?php echo base_url() . 'customer'; ?>">Customer</a></li>
<li class="active"><?php echo $_action == 'add' ? 'Add New' : 'Update'; ?> Customer</li>
</ul>

<?php

if($_action=='update'){
    
//  print_r($_record[0]);
//exit();
  $_sn        = $_record[0]['cust_sn'];
  
  $_card_id      = $_record[0]['cust_card_id'];
  $_cust_id      = $_record[0]['cust_id'];  
  $_first_name      = $_record[0]['cust_first_name'];
  $_last_name      = $_record[0]['cust_last_name'];
  $_mobile       = $_record[0]['cust_mobile'];
  $_phone       = $_record[0]['cust_phone'];
  $_email       = $_record[0]['cust_email'];
  $_dob         = $_record[0]['cust_dob']==0?"":date('d-m-Y',strtotime($_record[0]['cust_dob']));
  $_address     = $_record[0]['cust_address_line1'];
  $_address2    = $_record[0]['cust_address_line2'];
  $_city        = $_record[0]['cust_city'];
  $_zip         = $_record[0]['cust_zip'];
  $_country_key = $_record[0]['cust_country'];
  
  $_car_no          = $_record[0]['cust_car_no'];
  $_car_model       = $_record[0]['cust_car_model'];
  $_car_color       = $_record[0]['cust_car_color'];
  $_additional  = $_record[0]['cust_additional'];
  
}else{
    
  $_sn        = '';
  
  $_card_id      = '';
  $_cust_id      = '';  
  $_first_name   = '';
  $_last_name    = '';
  $_mobile       = '';
  $_phone       = '';
  $_email       = '';
  $_dob         = '';
  $_address     = '';
  $_address2    = '';
  $_city        = '';
  $_zip         = '';
  $_country_key = '';
  
  $_car_no          = '';
  $_car_model       = '';
  $_car_color       = '';
  $_additional  = '';
 
}

?>
<section class="panel">
    <header class="panel-heading clearfix">
        <?php echo $_page_title;
        
        if($_action=='update'){  ?>        
        <a class="btn btn-info pull-right" 
           href="<?php echo base_url().'customer/details/'.$_record[0]['cust_sn'];?>" role="button">View Customer</a>
        <?php 
        }//end if
        ?>
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
             
            if($_action=='update'){
            $_sn        = $_record[0]['cust_sn'];
            }else{
                $_sn='';
            }
            $_card_id      = $_record[0]['cust_card_id'];
            $_cust_id      = $_record[0]['cust_id'];  
            $_first_name      = $_record[0]['cust_first_name'];
            $_last_name      = $_record[0]['cust_last_name'];
            $_mobile       = $_record[0]['cust_mobile'];
            $_phone       = $_record[0]['cust_phone'];
            $_email       = $_record[0]['cust_email'];
            if($_record[0]['cust_dob']!=''){
            $_dob         = date('d-m-Y',$_record[0]['cust_dob']);
            }else{
            $_dob         =''    ;
            }
            $_address     = $_record[0]['cust_address_line1'];
            $_address2    = $_record[0]['cust_address_line2'];
            $_city        = $_record[0]['cust_city'];
            $_zip         = $_record[0]['cust_zip'];
            $_country_key = $_record[0]['cust_country'];

            $_car_no          = $_record[0]['cust_car_no'];
            $_car_model       = $_record[0]['cust_car_model'];
            $_car_color       = $_record[0]['cust_car_color'];
            $_additional  = $_record[0]['cust_additional'];
            //print_r($_record);
            
        }//end error
        ?>
            
        <form class="form-horizontal" role="form" method="POST"
              action="<?php echo base_url().'customer/save';?>">
            <input type="hidden" name="_engine" value="backend">
            <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>">
            <?php
            if($_action=='update'): ?>
            <input type="hidden" id="_sn" name="_sn" value="<?php echo $_sn;?>">
                <?php
            endif;
            ?>
            <div class="form-group">
                <label for="inputCardID" class="col-md-2 control-label">Card ID *</label>
                <div class="col-md-5">
                    <?php
                    if($_action=='add'){
                    ?>
                    <input type="text" class="form-control" id="inputCardID" value="<?php echo $_card_id;?>"
                           name="inputCardID" placeholder="Card ID" required="">
                    <?php }
                    else{ ?>
                    <p class="form-control-static"><strong>
                            <span id="active_card_id"><?php echo $_card_id;?></span></strong>
                        <button class="btn btn-xs btn-default pull-right" type="button" 
                                id="change_card" title="Change Card ID"><i class="fa fa-pencil"></i></button>
                    </p>
                        <?php
                                                    
                            echo '<ul class="card_id_list">';
                            foreach($_card_ids as $id): ?>
                                <li style="height: 22px;border-bottom: #eee dotted 1px;"
                                    id="card_<?php echo $id['cust_card_id'];?>"><?php echo $id['cust_card_id'];?>&nbsp;
                                    <button class="btn btn-xs btn-link btn-card-remove" 
                                            type="button" value="<?php echo $id['cust_card_id'];?>"
                                    title="Remove ID"><i class="fa fa-trash-o"></i></button>
                                </li>
                                <?php
                            endforeach;                        
                            echo '</ul>';                        
                    }?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputIDNumber" class="col-md-2 control-label">ID Number</label>
                <div class="col-md-5">
                    <?php                    
                    //$_cust_id='';
                    if($_cust_id==''){
                    ?>
                    <input type="text" class="form-control" id="inputIDNumber" value="<?php echo $_cust_id;?>"
                           name="inputIDNumber" placeholder="ID Number">
                    <?php }
                    else{ ?>
                    <p class="form-control-static"><span id='cust_id_number'><?php echo $_cust_id;?></span>
                    <button class="btn btn-xs btn-default pull-right" type="button" 
                            value="<?php echo $_cust_id;?>"
                                id="change_id" title="Change ID Number"><i class="fa fa-pencil"></i></button>
                    </p>
                        <?php
                    }?>
                </div>
            </div>
            <?php 
            /*
            if($_action=='add'){ ?>
            <div class="form-group">
                <label for="inputPassword" class="col-md-2 control-label">Password *</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" id="inputPassword"  maxlength="12"
                           name="inputPassword" placeholder="Password" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword" class="col-md-2 control-label">Confirm Password *</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" id="inputConfirmPassword" maxlength="12"
                           name="inputConfirmPassword" placeholder="Confirm Password" required="">
                </div>
            </div>                
                <?php                
            }//end if    */          
            ?>
            
            <div class="form-group">
                <label for="inputFirstName" class="col-md-2 control-label">Name *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputFirstName"  value="<?php echo trim($_first_name);?>"
                           name="inputFirstName" placeholder="First Name" required="">
                </div>
            </div>
            <?php /*
            <div class="form-group">
                <label for="inputLastName" class="col-md-2 control-label">Last Name *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputLastName"  value="<?php echo $_last_name;?>"
                           name="inputLastName" placeholder="Last Name" required="">
                </div>
            </div> */?>
            <div class="form-group">
                <label for="inputMobileNo" class="col-md-2 control-label">Mobile Number</label>
                <div class="col-md-5">
                    <input type="tel" class="form-control" id="inputMobileNo"  value="<?php echo $_mobile;?>"
                           name="inputMobileNo" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhoneNumber" class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-5">
                    <input type="tel" class="form-control" id="inputPhoneNumber"  value="<?php echo $_phone;?>"
                           name="inputPhoneNumber" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-md-2 control-label">Email Address</label>
                <div class="col-md-5">
                    <input type="email" class="form-control" id="inputEmail"  value="<?php echo $_email;?>"
                           name="inputEmail" placeholder="Email Address">
                </div>
            </div>
            <div class="form-group">
                <label for="inputBirthday" class="col-md-2 control-label">Birthday</label>
                <div class="col-md-5"> 
                    <input class="form-control" id="inputBirthday" name="inputBirthday" 
                                   type="text" value="<?php echo $_dob;?>">                 
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-md-2 control-label">Address</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputAddress"  value="<?php echo $_address;?>"
                           name="inputAddress" placeholder="Address">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-md-offset-2">
                    <input type="text" class="form-control" id="inputAddress2"  value="<?php echo $_address2;?>"
                           name="inputAddress2" placeholder="Address Line 2">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCity" class="col-md-2 control-label">City</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCity"  value="<?php echo $_city;?>"
                           name="inputCity" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <label for="inputZipcode" class="col-md-2 control-label">ZipCode</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputZipcode"  value="<?php echo $_zip;?>"
                           name="inputZipcode" placeholder="Zipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCountry" class="col-md-2 control-label">Country</label>
                <div class="col-md-5">
                    <select class="form-control" id="inputCountry" name="inputCountry">
                          <?php 
                                foreach($_country as $key => $value): ?>
                                <option <?php echo $_country_key==$key?'SELECTED':'';?> value="<?php echo $key?>"><?php echo $value;?></option>    
                                    <?php                                    
                                endforeach;?>                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarNumber" class="col-md-2 control-label">Car Number</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarNumber"  value="<?php echo $_car_no;?>"
                           name="inputCarNumber" placeholder="Car Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarModel" class="col-md-2 control-label">Model</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarModel" value="<?php echo $_car_model;?>"
                           name="inputCarModel" placeholder="Model">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarColor" class="col-md-2 control-label">Color</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarColor"  value="<?php echo $_car_color;?>"
                           name="inputCarColor" placeholder="Color">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarColor" class="col-md-2 control-label">Additional Information</label>
                <div class="col-md-5">
                    <div class="form-control" contenteditable="true" id="inputAdditionalInfo"
                         style=" margin-bottom: 10px; padding: 10px; border: 1px solid #e2e2e4; min-height: 150px;
                         overflow: scroll;">                        
                        <?php echo trim($_additional);?>
                    </div>
                    <input type="hidden" name="inputAdditionalInfo" id="inputAdditionalInfo_hide"
                           value="<?php echo trim($_additional);?>">
                    <?php /*
                    <textarea class="form-control" id="inputAdditionalInfo" 
                              name="inputAdditionalInfo" rows="5"><?php echo $_additional;?></textarea>*/?>
                </div>
            </div>            
            <div class="form-group">
                <div class="col-md-offset-2 col-md-5">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo ucfirst($_action);?> Customer</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php

if($_action=='update'){  
    
    $data['_visit_subs']=$_visit_subs;
    $data['_session_subs']=$_session_subs;
    $data['_gift_subs']=$_gift_subs;
    
    $this->load->view('customer/customer_subscription_edit');
?>

<div class="col-sm-12">
<?php 
if(count($_cust_campaign)>0){ ?>
    
    <section class="panel" id="subscribe">
        <header class="panel-heading clearfix">Subscription History (All expired subscriptions)</header>
        <div class="panel-body">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>                        
                        <th>Campaign Name</th>
                        <th>Subscribe Date</th>
                        <th>Type</th>
                        <th>Expire Date</th>                        
                        <th>Balance</th>           
                        <th>Bill No</th>           
                        <th>Bill Amount</th>           
                        <th>Transactions</th>   
                    </tr>
                </thead>
                <tbody id='currect_subscription'>
                    <?php 
                    foreach($_cust_campaign as $row): ?>
                    <tr>
                        <td><?php echo $row['cmpn_name'];?></td>
                        <td><?php echo date('d M Y',$row['subs_date']);?></td>
                        <td><?php echo $row['subs_type'];?></td>
                        <td><?php echo date('d M Y',$row['expire_date']);?></td>
                        <td><?php echo number_format($row['cust_balance'],2,'.',',');?></td>
                        <td><?php echo $row['subs_bill_no'];?></td>
                        <td><?php echo $row['subs_bill_amount'];?></td>
                        <td><a href="<?php echo base_url().'customer/view_transactions/'.$_sn.'/'.$row['subs_sn'];?>" target="_blank" title="View Transections">
                                View Transactions</a></td>
                    </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </section>
<?php 
}//
?>    
<section class="panel" id="subscribe">
    <header class="panel-heading clearfix">
        <i class="fa fa-thumb-tack"></i>  Subscribe Customer
    </header>
    <div class="panel-body">
        <?php //print_r($_subscribe);?>
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Campaign Type</th>
                    <th>Campaign Name</th>
                    <th>Expire Duration</th>
                    <th>Expire Date*</th>
                    <th class="text-center">Check</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($_subscribe as $row):

                    ?>
                <tr id="row_<?php echo $row['cmpn_sn'];?>">

                    <td><?php echo $row['cmpn_type'];?></td>

                    <td class='camp_name'><?php echo $row['cmpn_name'];?></td>

                    <td><?php echo $row['cmpn_expire_duration'].' '.ucfirst($row['cmpn_duration_type']); 
                    echo $row['cmpn_expire_duration']>1?'s':''; ?></td>

                    <td class="expire_date">                        
                        <?php
//                        $date = new DateTime();
//                        $date->modify("+ ".$row['cmpn_expire_duration'].' '.$row['cmpn_duration_type']);
//                        echo $date->format("d M, Y");
//                        $expire=$date->format("Y-m-d");
                        ?>
                        <input type="hidden" id="expire_<?php echo $row['cmpn_sn'];?>"
                               value="<?php echo $expire;?>">
                    </td>

                    <td>
                        <div class="checkbox" style='margin: 0px;'>
                            <label class='control-label check_lebel_<?php echo $row['cmpn_sn'];?>'>
                            <input type='checkbox' 
                               id='check_<?php echo $row['cmpn_sn'];?>'> Subscribe </label>
                               
                        </div>                        
                    </td>
                    <td class="text-center">                        
                        <button class="btn btn-info btn-subscribe btn-sm" type="button" 
                                value="<?php echo $row['cmpn_sn'];?>" title='Subscribe'>
                            <i class="fa fa-thumbs-o-up"></i></button>
                        </td>

                </tr>
                    <?php
                endforeach;
                ?>                
            </tbody>
        </table>
    </div>
                
<!--CHANGE CARD ID model-->

<div class="modal_card_id in" tabindex="-1"  
     style="position: fixed;top: 30px;left: 25%; display: none;z-index: 900;outline: none;"
     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Change Card ID</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-horizontal">
              <div class="form-group">
                <label for="newCardID" class="col-md-3 control-label">New Card ID</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="newCardID"  value=""
                           name="newCardID" placeholder="New Card ID">
                </div>
                </div>              
              <div class="error" style="display: none;">
                  <div class="alert alert-warning alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p id="error_message"></p>
                    
                  </div>
              </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSaveNewCard" class="btn btn-primary">Save New Card ID</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--change id number-->
<div class="modal_id_number in" tabindex="-1"  
     style="position: fixed;top: 30px;left: 25%; display: none;z-index: 900;outline: none;"
     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Change ID Number</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-horizontal">
              <div class="form-group">
                <label for="newIDNumber" class="col-md-3 control-label">New ID Number</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="newIDNumber"  value=""
                           name="newIDNumber" placeholder="New ID Number">
                </div>
                </div>              
              <div class="error" style="display: none;">
                  <div class="alert alert-warning alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p id="error_message_id_number"></p>
                    
                  </div>
              </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSaveNewID" class="btn btn-primary">Save New ID Number</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</section >   
</div>    
<?php 
    
}//nd update?>
<script> require(['page/customer_form']); </script> 
<script> require(['page/customer_subscribe']); </script> 
