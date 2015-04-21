<?php

$_error=$this->session->flashdata('errors');

if($_error!=''){
    $_record=$this->session->flashdata('_record');    
}


if(isset($_record)){
    $_record=$_record;    
    
    $_record['cust_card_id']    =$_record[0]['cust_card_id'];    
    $_record['cust_id']         =$_record[0]['cust_id'];    
    $_record['cust_first_name'] =$_record[0]['cust_first_name'];    
    //$_record['cust_last_name']  =$_record[0]['cust_last_name'];        
    $_record['cust_mobile']     =$_record[0]['cust_mobile'];    
    $_record['cust_phone']      =$_record[0]['cust_phone'];    
    $_record['cust_email']      =$_record[0]['cust_email'];    
    $_record['cust_dob']        =$_record[0]['cust_dob'];    
    $_record['cust_address_line1']=$_record[0]['cust_address_line1'];    
    $_record['cust_address_line2']=$_record[0]['cust_address_line2'];    
    $_record['cust_city']       =$_record[0]['cust_city'];    
    $_record['cust_zip']        =$_record[0]['cust_zip'];    
    $_record['cust_country']    =$_record[0]['cust_country'];    
    $_record['cust_car_no']     =$_record[0]['cust_car_no'];    
    $_record['cust_car_model']  =$_record[0]['cust_car_model'];    
    $_record['cust_car_color']  =$_record[0]['cust_car_color'];    
    $_record['cust_additional'] =$_record[0]['cust_additional'];     
    $_record['inputplan']                =$_record[0]['inputplan'];     
    $_record['inputNumberOfSessions']    =$_record[0]['inputNumberOfSessions'];     
    $_record['inputNumberOfMonths']      =$_record[0]['inputNumberOfMonths'];     
    //print_r($_record);
}
else{
    $_record['inputplan']                ='';     
    $_record['inputNumberOfSessions']    ='';     
    $_record['inputNumberOfMonths']      ='';     
    
    $_record['cust_card_id']    ='';
    $_record['cust_id']         ='';
    $_record['cust_first_name'] ='';
    //$_record['cust_last_name']  ='';
    $_record['cust_mobile']     ='';
    $_record['cust_phone']      ='';
    $_record['cust_email']      ='';
    $_record['cust_dob']        ='';
    $_record['cust_address_line1']='';
    $_record['cust_address_line2']='';
    $_record['cust_city']       ='';
    $_record['cust_zip']        ='';
    $_record['cust_country']    ='';
    $_record['cust_car_no']     ='';
    $_record['cust_car_model']  ='';
    $_record['cust_car_color']  ='';
    $_record['cust_additional'] =''; 
}

?>
<section class="panel">
    <header class="panel-heading clearfix">
        Add Customer    </header>
    <div class="panel-body">                           
            <?php 
 
            if(isset($_error) && $_error!=''){ ?>
                <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo $_error;
                ?>
                </div>            
                <?php                
            }//END IF
            ?>
        
        
        <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>customer/confirmation">
            <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>">
            
          
            <div class="form-group">
                <label for="inputIDNumber" class="col-md-2 control-label">ID Number *<br><small>NRIC/Driving License</small></label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputIDNumber" required=""
                           value="<?php echo $_record['cust_id'];?>" name="inputIDNumber" placeholder="ID Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFirstName" class="col-md-2 control-label">Name *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputFirstName" 
                           value="<?php echo $_record['cust_first_name'];?>" name="inputFirstName" placeholder="Name" required="">
                </div>
            </div>
            <?php /*
            <div class="form-group">
                <label for="inputLastName" class="col-md-2 control-label">Last Name *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputLastName" 
                           value="<?php echo $_record['cust_last_name'];?>" name="inputLastName" placeholder="Last Name" required="">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputPassword" class="col-md-2 control-label">Password *</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" id="inputPassword" maxlength="12" name="inputPassword" placeholder="Password" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword" class="col-md-2 control-label">Confirm Password *</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" id="inputConfirmPassword" maxlength="12" name="inputConfirmPassword" placeholder="Confirm Password" required="">
                </div>
            </div>   */?>             
                            
            
            <div class="form-group">
                <label for="inputMobileNo" class="col-md-2 control-label">Mobile Number *</label>
                <div class="col-md-5">
                    <input type="tel" class="form-control" id="inputMobileNo" 
                           value="<?php echo $_record['cust_mobile'];?>" name="inputMobileNo" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhoneNumber" class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-5">
                    <input type="tel" class="form-control" id="inputPhoneNumber" 
                           value="<?php echo $_record['cust_phone'];?>" name="inputPhoneNumber" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-md-2 control-label">Email Address *</label>
                <div class="col-md-5">
                    <input type="email" class="form-control" id="inputEmail" 
                           value="<?php echo $_record['cust_email'];?>" name="inputEmail" placeholder="Email Address">
                </div>
            </div>
            <div class="form-group">
                <label for="inputBirthday" class="col-md-2 control-label">Birthday</label>
                <div class="col-md-5">                                                                
                    <input class="form-control" id="inputBirthday" name="inputBirthday" 
                                   type="text" value="<?php echo $_record['cust_dob'];?>">                                       
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-md-2 control-label">Address *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputAddress" 
                           value="<?php echo $_record['cust_address_line1'];?>" name="inputAddress" placeholder="Address">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-md-offset-2">
                    <input type="text" class="form-control" id="inputAddress2" 
                           value="<?php echo $_record['cust_address_line2'];?>" name="inputAddress2" placeholder="Address Line 2">
                </div>
            </div>
            <?php /*
            <div class="form-group">
                <label for="inputCity" class="col-md-2 control-label">City</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCity" 
                           value="<?php echo $_record['cust_city'];?>" name="inputCity" placeholder="City">
                </div>
            </div> */?>
            <div class="form-group">
                <label for="inputZipcode" class="col-md-2 control-label">Postal *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputZipcode"  required="required"
                           value="<?php echo $_record['cust_zip'];?>" name="inputZipcode" placeholder="Zipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCountry" class="col-md-2 control-label">Country</label>
                <div class="col-md-5">
                    <select class="form-control" id="inputCountry" name="inputCountry">
                       <?php 
                            foreach($_country as $key => $value): ?>
                            <option <?php echo $_record['cust_country']==$key?'SELECTED':'';?> 
                                value="<?php echo $key?>"><?php echo $value;?></option>    
                                <?php                                    
                            endforeach;?>  
                                                            
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarNumber" class="col-md-2 control-label">Car Number *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarNumber" required 
                           value="<?php echo $_record['cust_car_no'];?>" name="inputCarNumber" placeholder="Car Number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarModel" class="col-md-2 control-label">Model *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarModel" required
                           value="<?php echo $_record['cust_car_model'];?>" name="inputCarModel" placeholder="Model">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarColor" class="col-md-2 control-label">Color *</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCarColor" required
                           value="<?php echo $_record['cust_car_color'];?>" name="inputCarColor" placeholder="Color">
                </div>
            </div>
            
            <div class="form-group">
                <label for="iagree" class="col-md-2 control-label">I Agree</label>
                <div class="col-md-5">
                    <label class="checkbox"> 
                        <label for="iagree" class="control-label"> I agree to the <a href="http://www.primeauto.com.sg/tnc" target="_blank">terms and conditions</a></label>
                        <input type="checkbox" id="iagree" style="margin-top: 7px;"
                           name="iagree" required=""></label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputCardID" class="col-md-2 control-label">Card ID *<br><small>Please Scan Card<small/></label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="inputCardID" 
                           value="<?php echo $_record['cust_card_id'];?>" name="inputCardID" placeholder="Card ID" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-5">
                    <button type="submit" class="btn btn-primary btn-block" id="btn-confirm1" disabled>Add Customer</button>
                </div>
            </div>
            <input type="hidden" name="_engine" value="frontend">
        </form>
    </div>
</section>
<script> require(['page/customer_add_front']); </script> 