
<li><a href="<?php echo base_url().'pending';?>" title="Pending">Pending</a></li>    
<li class="active"><?php echo $_page_title;?></li>
</ul>
<section class="panel">
    <header class="panel-heading clearfix">
        Edit Pending Subscription
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'pending/view/'.$_record[0]['tmp_subs_sn'];?>" 
           role="button"><i class="fa fa-square"></i> View</a>
    </header>
    <div class="panel-body">
        <?php //print_r($_record);?>
        
        <form method="POST" class="form-horizontal"
              action="<?php echo base_url().'pending/save'?>">
            <input type="hidden" name="_sn" value="<?php echo $_record[0]['tmp_subs_sn'];?>">
            
            
            <div class="form-group">
                <label for="inputOutletName" class="col-lg-3 col-sm-3 control-label">Customer Name </label>
                <div class="col-lg-9">
                    <label><?php echo trim($_record[0]['cust_first_name']);?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputOutletName" class="col-lg-3 col-sm-3 control-label">ID Number </label>
                <div class="col-lg-9">
                    <label><?php echo trim($_record[0]['cust_id']);?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputOutletName" class="col-lg-3 col-sm-3 control-label">Card Number </label>
                <div class="col-lg-9">
                    <label><?php echo trim($_record[0]['cust_card_id']);?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCampaign" class="col-lg-3 col-sm-3 control-label">Plan </label>
                <div class="col-lg-9">
                    <select class="form-control" name="inputCampaign" id="inputCampaign">
                        <?php
                        foreach($_campaign as $item): ?>
                        <option value="<?php echo $item['cmpn_sn'];?>"
                                <?php echo $_record[0]['cmpn_sn']==$item['cmpn_sn']?'SELECTED':'';?>
                            ><?php echo $item['cmpn_name'];?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>                    
                </div>
            </div>
                        <div class="form-group">
                <label for="inputType" class="col-lg-3 col-sm-3 control-label">Type </label>
                <div class="col-lg-9">
                    <select class="form-control" name="inputType" id="inputType">                        
                        <option value="New Application"
                                <?php echo $_record[0]['subs_type']=='New Application'?'SELECTED':'';?>>New Application</option>
                        <option value="Renewal"
                                <?php echo $_record[0]['subs_type']=='Renewal'?'SELECTED':'';?>>Renewal</option>
                        <option value="Change New Card"
                                <?php echo $_record[0]['subs_type']=='Change New Card'?'SELECTED':'';?>>Change New Card</option>
                        <option value="Change Car" 
                                <?php echo $_record[0]['subs_type']=='Change Car'?'SELECTED':'';?> >Change Car</option>
                        <option value="Lost Card" 
                                <?php echo $_record[0]['subs_type']=='Lost Card'?'SELECTED':'';?>>Lost Card</option>     
                    </select>                    
                </div>
            </div>
            <div class="form-group">
                <label for="number_of_months" class="col-lg-3 col-sm-3 control-label">No. of months</label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" id="number_of_months" 
                           value="<?php echo $_record[0]['num_of_months'];?>"
                           name="number_of_months" >
                    <?php /*
                    <label class="control-label" id="number_of_months"><?php echo $_record[0]['cmpn_expire_duration'];?></label>
                     */?>
                </div>
            </div>            
            
            <div class="form-group">
                <label for="inputSubsDate" class="col-lg-3 col-sm-3 control-label">Start Date (Old Expiry Date): </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputSubsDate" value="<?php echo date('d-m-Y',$_record[0]['subs_date']);?>"
                           name="inputSubsDate" placeholder="" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-3 col-sm-3 control-label">New Expiry Date </label>
                <div class="col-lg-9">
                    <label class="control-label"
                           id="new_expire_date_text"><?php echo date('d M, Y',$_record[0]['expire_date']);?></label>
                    <input type="hidden" class="form-control" id="inputExpireDate" 
                           value="<?php echo date('d-m-Y',$_record[0]['expire_date']);?>"
                           name="inputExpireDate">
                </div>
            </div>
            <div class="form-group">
                <label for="inputOldBalance" class="col-lg-3 col-sm-3 control-label">Old Card Balance</label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" id="inputOldBalance" value="<?php echo $_record[0]['old_balance'];?>"
                           name="inputOldBalance" placeholder="" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputRedemption" class="col-lg-3 col-sm-3 control-label">Today’s Redemption </label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" id="inputRedemption" 
                           value="<?php echo $_record[0]['redemption'];?>"
                           name="inputRedemption" placeholder="" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputTranValue" class="col-lg-3 col-sm-3 control-label">No. of Sessions/Amt</label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" id="inputTranValue" value="<?php echo $_record[0]['tran_value'];?>"
                           name="inputTranValue" placeholder="" required="">
                </div>
            </div>            
            
            <div class="form-group">
                <label for="inputNewBalance" class="col-lg-3 col-sm-3 control-label">New Balance </label>
                <div class="col-lg-9">
                    <label class="control-label"
                           id="inputNewBalance_text"><?php echo $_record[0]['cust_balance'];?></label>
                    <input type="hidden" class="form-control" id="inputNewBalance" 
                           value="<?php echo $_record[0]['cust_balance'];?>"
                           name="inputNewBalance">
                </div>
            </div>
            <?php /*
            <div class="form-group">
                <label for="inputUser" class="col-lg-3 col-sm-3 control-label">User </label>
                <div class="col-lg-9">
                     <select class="form-control" name="inputUser">
                        <?php
                        foreach($_users as $item): ?>
                        <option value="<?php echo $item['user_sn'];?>"
                                <?php echo $_record[0]['user_sn']==$item['user_sn']?'SELECTED':'';?>>
                                    <?php echo $item['user_name'].' ('.$item['ol_name'].')';?>
                        </option>
                            <?php
                        endforeach;
                        ?>
                    </select>                     
                </div>
            </div> */?>
            <div class="form-group">
                <label for="inputBillNo" class="col-lg-3 col-sm-3 control-label">Bill No </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputBillNo" 
                           value="<?php echo $_record[0]['subs_bill_no'];?>"
                           name="inputBillNo" placeholder="" required="">
                </div>
            </div>            
            <div class="form-group">
                <label for="inputBillAmount" class="col-lg-3 col-sm-3 control-label">Bill Amount </label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" id="inputBillAmount" value="<?php echo $_record[0]['subs_bill_amount'];?>"
                           name="inputBillAmount" placeholder="" required="">
                </div>
            </div> 
            <div class="form-group">
                <label for="inputCarNumber" class="col-lg-3 col-sm-3 control-label">Car Number</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputCarNumber" 
                           value="<?php echo $_record[0]['car_number'];?>"  maxlength="20"
                           name="inputCarNumber" placeholder="" required="">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarModel" class="col-lg-3 col-sm-3 control-label">Model</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputCarModel" 
                           value="<?php echo $_record[0]['car_model'];?>" maxlength="20"
                           name="inputCarModel" placeholder="" required="">                    
                </div>
            </div>
            <div class="form-group">
                <label for="inputCarColor" class="col-lg-3 col-sm-3 control-label">Color</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputCarColor" 
                           value="<?php echo $_record[0]['car_color'];?>"  maxlength="20"
                           name="inputCarColor" placeholder="" required="">                    
                </div>
            </div>            
            <div class="form-group">
                <label for="inputRemark" class="col-lg-3 col-sm-3 control-label">Remark</label>
                <div class="col-lg-9">
                    <textarea class="form-control" id="inputRemark" name="inputRemark"  maxlength="255"
                              ><?php echo $_record[0]['remark'];?></textarea>                    
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-3 col-sm-3 control-label"></label>
                <div class="col-lg-9">
                    <button class="btn btn-info" type="submit" title="Save"
                            ><i class="fa fa-save"></i> Save</button>
                </div>
            </div>            
       
        </form>
        
    </div>
</section> 
<script> require(['page/pending_form']); </script> 