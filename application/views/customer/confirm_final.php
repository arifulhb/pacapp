<section class="panel">
    <header class="panel-heading clearfix">Final Confirm Customer Data</header>
    <div class="panel-body">
        
        <form class="form-horizontal" role="form" method="POST" 
                    action="<?php echo base_url();?>customer/confirm_final_control">
            
          <?php 
            $_action=$_record[0]['_action'];
            $cust_sn=$_record[0]['cust_sn'];
            
            //FORM
            if($_action=='update'){ ?>                 
                    <input type="hidden" id="inputcustsn" name="inputcustsn" 
                   value="<?php echo $cust_sn;?>">
                <?php
            }//end if
            else{?>
            
                <?php
            }//end else
            ?>
                    
            <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>">                     
            
            <div class="row">
                <div class="col-sm-6">
                    <!--PLAN START-->
                    <div class="form-group">
                    <label for="inputPlan" class="col-md-3 control-label">Plan</label>
                    <div class="col-md-9">
                            <input type="hidden" name="inputplan" id="inputPlan" 
                                           value="<?php echo $_record[0]['_cmpn_sn'];?>">

                            <?php 
                            foreach($_campaigns as $list): 
                                if($list['cmpn_sn']==$_record[0]['_cmpn_sn']):?>
                                <label class="control-label"><?php echo $list['cmpn_name'];?></label>                                
                                    <?php
                                endif;                            
                            endforeach; ?>                    

                    </div>
                    </div>
                    <div class="form-group">
                    <label for="inputType" class="col-md-3 control-label">Type</label>
                    <div class="col-md-9">
                        <label class="control-label"><?php echo $_record[0]['_type'];?></label>
                        <input type="hidden" id="inputType" name="inputType"
                                   value="<?php echo $_record[0]['_type'];?>">
                    </div>
                </div>
            <?php /* DURATION
                   * 
                <div class="form-group">
                    <label for="inputCardID" class="col-md-3 control-label">Duration</label>
                    <div class="col-md-9">
                        <label class="control-label"><?php echo $_record[0]['_type'];?></label>
                        <input type="hidden"id="inputNumberOfMonths" 
                               value="<?php echo $_record[0]['inputNumberOfMonths'];?>" 
                               name="inputNumberOfMonths">
                    </div>
                </div> */?>
                    <div class="form-group">
                    <label for="inputPlanDate" class="col-md-3 control-label">Start Date (Old Expiry Date)</label>
                    <div class="col-md-9">
                            <?php
                            $_new_start_date=$_record[0]['_subs_start_date'];
                            ?>
                            <label class="control-label"><?php echo $_new_start_date;;?></label>
                            <input type="hidden" id="new_start_date" 
                                   value="<?php echo $_new_start_date;?>" 
                                   name="new_start_date">                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputOldCardBalance" class="col-md-3 control-label">Duration (Months)</label>
                        <div class="col-md-9">
                            <label class="control-label"><?php echo $_record[0]['_subs_num_of_months'];?></label>
                            <input type='hidden' id='inputDuration' name='inputDuration'
                                   value="<?php echo $_record[0]['_subs_num_of_months'];?>">
                        </div>
                    </div>                                
                    
                        <div class="form-group">
                        <label for="inputOldCardBalance" class="col-md-3 control-label">New Expiry Date</label>
                        <div class="col-md-9">
                            <label class="control-label"><?php echo $_record[0]['_subs_expire_date'];?></label>
                            <input type='hidden' id='new_expire_date' name='new_expire_date'
                                   value="<?php echo $_record[0]['_subs_expire_date'];?>">
                        </div>
                    </div>                                
                        <div class="form-group">
                        <label for="inputOldCardBalance" class="col-md-3 control-label">Old Card Balance</label>
                        <div class="col-md-9">
                            <label class="control-label"><?php echo $_record[0]['_old_card_balance'];?></label>
                            <input type="hidden" id="inputOldCardBalance" 
                                   value="<?php echo $_record[0]['_old_card_balance'];?>" 
                                   name="inputOldCardBalance" >
                        </div>
                    </div>                     
                        <div class="form-group">
                        <label for="inputNumberOfRedemption" class="col-md-3 control-label">Today's Redemption</label>
                        <div class="col-md-9">
                            <label class="control-label"><?php echo $_record[0]['_total_redemption'];?></label>
                            <input type="hidden" id="inputNumberOfRedemption" 
                                   value="<?php echo $_record[0]['_total_redemption'];?>" 
                                   name="inputNumberOfRedemption">
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="inputNumberOfSessions" class="col-md-3 control-label">Number of Sessions / Amt</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $_record[0]['_number_of_amount'];?></label>
                                <input type="hidden" id="inputNumberOfSessions" 
                                       value="<?php echo $_record[0]['_number_of_amount'];?>" 
                                       name="inputNumberOfSessions">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNewBalance" class="col-md-3 control-label">New Balance</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $_record[0]['_new_balance'];?></label>
                                <input type='hidden' id='inputNewBalance' name='inputNewBalance'
                                       value="<?php echo $_record[0]['_new_balance'];?>">                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBillNo" class="col-md-3 control-label">Bill No</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $_record[0]['_bill_no'];?></label>
                                <input type="hidden" id="inputBillNo" name="inputBillNo" 
                                        value="<?php echo $_record[0]['_bill_no'];?>">
                            </div>
                        </div>              
                        <div class="form-group">
                            <label for="inputBillAmount" class="col-md-3 control-label">Bill Amount</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo '$'.number_format($_record[0]['_bill_amount'],2,'.',',');?></label>
                                <input type="hidden" id="inputBillAmount"                            
                                       name="inputBillAmount" value="<?php echo $_record[0]['_bill_amount'];?>">
                            </div>
                        </div>              
                    <!--PLAN END-->
                </div><!--left-->
                <div class="col-sm-6">
                     <div class="form-group">
                <label for="inputCarNumber" class="col-md-3 control-label">Car Number</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_car_no'];?></label>
                    <input type="hidden" id="inputCarNumber" 
                           value="<?php echo $_record[0]['cust_car_no'];?>" name="inputCarNumber">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarModel" class="col-md-3 control-label">Model</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_car_model'];?></label>
                    
                    <input type="hidden"  id="inputCarModel" 
                           value="<?php echo $_record[0]['cust_car_model'];?>" name="inputCarModel">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarColor" class="col-md-3 control-label">Color</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_car_color'];?></label>
                    <input type="hidden" id="inputCarColor" 
                           value="<?php echo $_record[0]['cust_car_color'];?>" name="inputCarColor">
                </div>
            </div>
             <div class="form-group">
                <label for="inputCarColor" class="col-md-3 control-label">Additional Information</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['additional_info'];?></label>
                    <input type="hidden" id="inputAdditionalInfo" 
                           value="<?php echo $_record[0]['additional_info'];?>" 
                           name="inputAdditionalInfo">
                </div>
            </div>
                    <hr>
                    <div class="form-group">
                <label for="inputCardID" class="col-md-3 control-label">Card ID</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_card_id'];?></label>
                    <input type="hidden" id="inputCardID" 
                           value="<?php echo $_record[0]['cust_card_id'];?>" name="inputCardID">
                </div>
            </div>                        
            <div class="form-group">
                <label for="inputIDNumber" class="col-md-3 control-label">ID Number</label>
                <div class="col-md-9">

                    <label class="control-label"><?php echo $_record[0]['cust_id'];?></label>
                    <input type="hidden" id="inputIDNumber" 
                           value="<?php echo $_record[0]['cust_id'];?>" name="inputIDNumber">
                </div>
            </div>
         
                            
            <div class="form-group">
                <label for="inputFirstName" class="col-md-3 control-label">Name *</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_first_name'];?></label>
                    <input type="hidden" id="inputFirstName" 
                           value="<?php echo $_record[0]['cust_first_name'];?>" 
                           name="inputFirstName">
                </div>
            </div>

            <div class="form-group">
                <label for="inputMobileNo" class="col-md-3 control-label">Mobile Number</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_mobile'];?></label>
                    <input type="hidden" id="inputMobileNo" 
                           value="<?php echo $_record[0]['cust_mobile'];?>" name="inputMobileNo">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhoneNumber" class="col-md-3 control-label">Phone Number</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_phone'];?></label>
                    <input type="hidden" id="inputPhoneNumber" 
                           value="<?php echo $_record[0]['cust_phone'];?>" name="inputPhoneNumber">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-md-3 control-label">Email Address</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_email'];?></label>
                    <input type="hidden" id="inputEmail" name="inputEmail"
                           value="<?php echo $_record[0]['cust_email'];?>" name="inputEmail" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputBirthday" class="col-md-3 control-label">Birthday</label>
                <div class="col-md-9">                                          
                    <label class="control-label"><?php echo $_record[0]['inputBirthday']!=''?date('d M, Y',strtotime($_record[0]['inputBirthday'])):'';?></label>
                    <input type="hidden" id="inputBirthday" 
                           value="<?php echo $_record[0]['inputBirthday']!=''?$_record[0]['inputBirthday']:'';?>" name="inputBirthday">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_address_line1'];?><br>
                    <?php echo $_record[0]['cust_address_line2'];?></label>
                    <input type="hidden" id="inputAddress" 
                           value="<?php echo $_record[0]['cust_address_line1'];?>" name="inputAddress">
                    <input type="hidden"  id="inputAddress2" 
                           value="<?php echo $_record[0]['cust_address_line2'];?>" name="inputAddress2">
                    
                </div>
            </div>     
            <?php /*        
            <div class="form-group">
                <label for="inputCity" class="col-md-3 control-label">City</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_city'];?></label>
                    <input type="hidden"  id="inputCity" 
                           value="<?php echo $_record[0]['cust_city'];?>" name="inputCity">
                </div>
            </div> */?>
            <div class="form-group">
                <label for="inputZipcode" class="col-md-3 control-label">Postal</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_zip'];?></label>
                    <input type="hidden" id="inputZipcode" 
                           value="<?php echo $_record[0]['cust_zip'];?>" name="inputZipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCountry" class="col-md-3 control-label">Country</label>
                <div class="col-md-9">
                    <label class="control-label"><?php echo $_record[0]['cust_country'];?></label>
                    <input type="hidden" id="inputCountry" 
                           value="<?php echo $_record[0]['cust_country'];?>" name="inputCountry">
                </div>
            </div>           
                </div><!--right-->
            </div>            
            
            <?php /*
            <div class="form-group">
                <label for="inputCarColor" class="col-md-3 control-label">Additional Information</label>
                <div class="col-md-9">
                    <?php
                    $myAdditional='';
                    if($cust_plan!=''){
                        $myAdditional.='Plan: '.$cust_plan;
                        if($cust_sessions!=''){                        
                        $myAdditional.='<br /> Number of Sessions: '.$cust_sessions;
                        }
                        if($cust_months!=''){
                            $myAdditional.='<br /> Number of Months: '.$cust_months;
                        }
                    }                    
                    if($cust_additional!=''){
                        $myAdditional.= $cust_plan!=''?'<br /> ':'';
                        
                        $myAdditional.='Additional Info: '.$cust_additional;
                    }
                    ?>
                    <label class="control-label">
                        <?php echo $myAdditional;?>
                    </label>                                                            
                    <input type="hidden" class="form-control" id="inputAdditionalInfo" 
                           value="<?php echo $myAdditional;?>" name="inputAdditionalInfo">
                    <input type="hidden" name="inputAdditionalInfoOriginal"
                           value="<?php echo $cust_additional;?>">
                </div>
            </div>     */?>       
            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-default"
                            name="back"  value="back"
                            id="btn-final_confirm-back">
                        <i class="fa fa-backward"></i> Back</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block"
                            name="save" value="save">
                        <i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <input type="hidden" name="_engine" value="frontend">
        </form>
        
    </div>
    <?php ?>
</section>    