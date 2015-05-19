<section class="panel">
    <header class="panel-heading clearfix">Confirm Customer Data</header>
    <div class="panel-body">
                <?php 
                
                $is_back=$this->session->flashdata('_isback');
                
                if($is_back==true){
                    
                    $res= $this->session->flashdata('_customer');                
                    //print_r($res);
                    $_action        = $res['_action'];
                    
                    $subs_cmpn_sn   = $res['subs_cmpn_sn'];
                    $subs_type      = $res['subs_type'];
                    $subs_duration  = '';//$res['subs_type'];
                    $subs_start_date      = $res['subs_new_start_date'];
                    $subs_expire_date      = $res['subs_new_expire_date'];
                    $subs_old_balance   = $res['subs_OldCardBalance'];
                    $subs_redemption    = $res['subs_NumberOfRedemption'];
                    $subs_session       = $res['subs_NumberOfSessions'];
                    $subs_new_balance   = $res['subs_NewBalance'];
                    $subs_bill_no       = $res['subs_BillNo'];
                    $subs_bill_amount   = $res['subs_BillAmount'];
                    
                    $cust_car_no        = $res['cust_car_no'];
                    $cust_car_model     = $res['cust_car_model'];
                    $cust_car_color     = $res['cust_car_color'];
                    $cust_additional    = $res['cust_additional'];
                    
                    $cust_card_id       = $res['cust_card_id'];
                    $cust_id            = $res['cust_id'];
                    $cust_first_name    = $res['cust_first_name'];
                    $cust_mobile        = $res['cust_mobile'];
                    $cust_phone         = $res['cust_phone'];
                    $cust_email         = $res['cust_email'];
                    $cust_dob           = $res['cust_dob'];
                    $cust_address_line1 = $res['cust_address_line1'];
                    $cust_address_line2 = $res['cust_address_line2'];
                    //$cust_city          = $res['cust_city'];
                    $cust_zip           = $res['cust_zip'];
                    $cust_country       = $res['cust_country'];
                    $cust_sn            = $res['cust_sn'];
                    
                }//end if
                else{
                    $subs_cmpn_sn   = '';
                    $subs_type      = '';
                    $subs_duration  = '';                    
                    $subs_start_date    ='';
                    $subs_expire_date   ='';
                    $subs_old_balance   ='';
                    $subs_redemption    ='';
                    $subs_session       ='';
                    $subs_new_balance   ='';
                    $subs_bill_no       = '';
                    $subs_bill_amount   = '';
                    $cust_additional    =$_record['cust_additional'];
                }//end else
                
                ?>
          <?php 
            //echo 'action: '.$_action;
            if($_action=='update'){ ?>
                <form class="form-horizontal" role="form" method="POST" 
                    action="<?php echo base_url();?>customer/confirm_final">
                
                    
                <?php
            }//end if
            else{?>
            <form class="form-horizontal" role="form" method="POST" 
              action="<?php echo base_url();?>customer/confirm_final">
                <?php
            }//end else
            ?>
                <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>">
                 
                <input type="hidden" id="inputcustsn" name="inputcustsn" 
                   value="<?php echo $cust_sn;?>">
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputCardID" class="col-md-3 control-label">Plan</label>

                            <div class="col-md-9">
                                <select id="inputPlan" name="inputplan" class="form-control">
                                    <option <?php echo $subs_cmpn_sn==''?'SELECTED':'';?> disabled="" value="">Please Select a Plan</option>
                                    <?php 
                                    foreach($_campaigns as $list): ?>                        
                                    <option value="<?php echo $list['cmpn_sn'];?>"
                                            <?php echo $subs_cmpn_sn==$list['cmpn_sn']?'selected':'';?>>
                                                <?php echo $list['cmpn_name'];?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>                    
                            </div>
                        </div>
                        <div class="form-group">
                <label for="inputType" class="col-md-3 control-label">Type</label>
                <div class="col-md-9">
                    <select id="inputType" name="inputType" class="form-control">
                        <option value="New Application"
                                <?php echo $subs_type=='New Application'?'selected':'';?>>New Application</option>
                        <option value="Renewal"
                                <?php echo $subs_type=='Renewal'?'selected':'';?>>Renewal</option>
                        <option value="Change New Card"
                                <?php echo $subs_type=='Change New Card'?'selected':'';?>>Change New Card</option>

						<?php

							/**
							 *

							Issue: http://pm.appiolab.com/issues/53
							<option value="Change Car"
									<?php echo $subs_type=='Change Car'?'selected':'';?>>Change Car</option>
							<option value="Lost Card"
									<?php echo $subs_type=='Lost Card'?'selected':'';?>>Lost Card</option>

						*/
						?>
                    </select>
                </div>
            </div>
                        <div class="form-group">
                            <label for="inputCardID" class="col-md-3 control-label">Duration (Months)</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="inputNumberOfMonths" 
                                       value="<?php //echo $_record['inputNumberOfMonths'];?>" 
                                       name="inputNumberOfMonths" step ="any">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="inputPlanDate" class="col-md-3 control-label">Start Date (Old Expiry Date)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="new_start_date" 
                                       value="<?php echo $subs_expire_date!=''?revertMyDate($subs_start_date):'';?>" 
                                       name="new_start_date">                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOldCardBalance" class="col-md-3 control-label">New Expiry Date</label>
                            <div class="col-md-9">
                                <label id='new_expire_date_text' class='control-label'><?php echo $subs_expire_date!=''?revertMyDate($subs_expire_date):'';?></label>
                                <input type='hidden' id='new_expire_date' name='new_expire_date'
                                       value="<?php echo $subs_expire_date!=''?revertMyDate($subs_expire_date):'';?>">
                            </div>
                        </div>                                
                        <div class="form-group">
                <label for="inputOldCardBalance" class="col-md-3 control-label">Old Card Balance</label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="inputOldCardBalance" 
                           value="<?php echo $subs_old_balance;?>" 
                           name="inputOldCardBalance" step="any">
                </div>
            </div>                     
                        <div class="form-group">
                        <label for="inputNumberOfRedemption" class="col-md-3 control-label">Today's Redemption</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="inputNumberOfRedemption" 
                                   value="<?php echo $subs_redemption;?>" 
                                   name="inputNumberOfRedemption" step="any">
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="inputNumberOfSessions" class="col-md-3 control-label">Number of Sessions / Amt</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="inputNumberOfSessions" 
                                   value="<?php echo $subs_session;?>" 
                                   name="inputNumberOfSessions" step="any">
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="inputNewBalance" class="col-md-3 control-label">New Balance</label>
                        <div class="col-md-9">
                            <input type='hidden' id='inputNewBalance' name='inputNewBalance'
                                   value="<?php echo $subs_new_balance;?>">
                            <label id='inputNewBalance_text' class='control-label'><?php echo $subs_new_balance;?></label>
                        </div>
                    </div>
                        <div class="form-group">
                <label for="inputBillNo" class="col-md-3 control-label">Bill No</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="inputBillNo"                            
                           name="inputBillNo" value="<?php echo $subs_bill_no;?>">
                </div>
            </div>              
                        <div class="form-group">
                <label for="inputBillAmount" class="col-md-3 control-label">Bill Amount</label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="inputBillAmount"                            
                           name="inputBillAmount" value="<?php echo $subs_bill_amount;?>" step="any">
                </div>
            </div>      
                    </div><!--end left-->
                    
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="inputCarNumber" class="col-md-3 control-label">Car Number *</label>
                            <div class="col-md-9">
                               
                                <input type="text" class="form-control" id="inputCarNumber" required=""
                                       value="<?php echo $cust_car_no;?>" name="inputCarNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCarModel" class="col-md-3 control-label">Model *</label>
                            <div class="col-md-9">                                
                                <input type="text" class="form-control" id="inputCarModel" required=""
                                       value="<?php echo $cust_car_model;?>" name="inputCarModel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCarColor" class="col-md-3 control-label">Color *</label>
                            <div class="col-md-9">                                
                                <input type="text" class="form-control" id="inputCarColor" required=""
                                       value="<?php echo $cust_car_color;?>" name="inputCarColor">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputCarColor" class="col-md-3 control-label">Additional Information</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="inputAdditionalInfo" 
                                          name="inputAdditionalInfo" rows="5"><?php echo $cust_additional;?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputCardID" class="col-md-3 control-label">Card ID *</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_card_id;?></label>
                                <input type="hidden" class="form-control" id="inputCardID" 
                                       value="<?php echo $cust_card_id;?>" name="inputCardID">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="inputIDNumber" class="col-md-3 control-label">ID Number</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_id;?></label>
                                <input type="hidden" class="form-control" id="inputIDNumber" 
                                       value="<?php echo $cust_id;?>" name="inputIDNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstName" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_first_name;?></label>
                                <input type="hidden" class="form-control" id="inputFirstName" 
                                       value="<?php echo $cust_first_name;?>" name="inputFirstName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMobileNo" class="col-md-3 control-label">Mobile Number</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_mobile;?></label>
                                <input type="hidden" class="form-control" id="inputMobileNo" 
                                       value="<?php echo $cust_mobile;?>" name="inputMobileNo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhoneNumber" class="col-md-3 control-label">Phone Number</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_phone;?></label>
                                <input type="hidden" class="form-control" id="inputPhoneNumber" 
                                       value="<?php echo $cust_phone;?>" name="inputPhoneNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_email;?></label>
                                <input type="hidden" class="form-control" id="inputEmail" name="inputEmail"
                                       value="<?php echo $cust_email;?>" name="inputEmail" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBirthday" class="col-md-3 control-label">Birthday</label>
                            <div class="col-md-9">                                          
                                <label class="control-label"><?php echo $cust_dob!=''?date('d M, Y',strtotime($cust_dob)):'';?></label>
                                <input type="hidden" class="form-control" id="inputBirthday" 
                                       value="<?php echo $cust_dob!=''?$cust_dob:'';?>" name="inputBirthday">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-md-3 control-label">Address</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_address_line1;?><br>
                                <?php echo $cust_address_line2;?></label>
                                <input type="hidden" class="form-control" id="inputAddress" 
                                       value="<?php echo $cust_address_line1;?>" name="inputAddress">
                                <input type="hidden" class="form-control" id="inputAddress2" 
                                       value="<?php echo $cust_address_line2;?>" name="inputAddress2">

                            </div>
                        </div>    
                        <?php /*
                        <div class="form-group">
                            <label for="inputCity" class="col-md-3 control-label">City</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_city;?></label>
                                <input type="hidden" class="form-control" id="inputCity" 
                                       value="<?php echo $cust_city;?>" name="inputCity">
                            </div>
                        </div>*/?>
                        <div class="form-group">
                            <label for="inputZipcode" class="col-md-3 control-label">Postal</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_zip;?></label>
                                <input type="hidden" class="form-control" id="inputZipcode" 
                                       value="<?php echo $cust_zip;?>" name="inputZipcode">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCountry" class="col-md-3 control-label">Country</label>
                            <div class="col-md-9">
                                <label class="control-label"><?php echo $cust_country;?></label>
                                <input type="hidden" class="form-control" id="inputCountry" 
                                       value="<?php echo $cust_country;?>" name="inputCountry">
                            </div>
                        </div>
                    </div><!--end right-->
                </div><!--end row-->
        
                        
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
                    <button type="button" class="btn btn-default"
                            id="btn-confirm-back">
                        <i class="fa fa-backward"></i> Back</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">
                        Confirm Data <i class="fa fa-forward"></i></button>
                </div>
            </div>
            <input type="hidden" name="_engine" value="frontend">
        </form>
        
    </div>
    <?php ?>
</section>    

<script>require(['page/page_confirm']);</script>