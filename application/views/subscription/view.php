
<li>Subscription</li>
<li class="active"><?php echo $_page_title;?></li>
</ul>
<section class="panel">
    <header class="panel-heading clearfix">
        View Subscription
        <?php /*
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'pending/edit/'.$_record[0]['tmp_subs_sn'];?>" 
           role="button"><i class="fa fa-pencil"></i> Edit</a>*/?>
    </header>
    <div class="panel-body">
        <?php //print_r($_record);?>

        <form method="POST" class="form-horizontal">
            
            <input type="hidden" name="_sn" value="<?php echo $_record[0]['tmp_subs_sn'];?>">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="inputSubsDate" class="col-lg-4 col-xs-4 control-label">Date :</label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo date('d M, Y h:i a',$_record[0]['update_date']);?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOutletName" class="col-lg-4 col-xs-4 control-label">Customer Name :</label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label">
                                <a href="<?php echo base_url().'customer/details/'.$_record[0]['cust_sn'];?>"
                                   title="View details of <?php echo trim($_record[0]['cust_first_name']);?>">
                                <?php echo trim($_record[0]['cust_first_name']);?>
                               </a> <i class="fa fa-link"></i>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCampaign" class="col-lg-4 col-xs-4 control-label">Plan </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['cmpn_name'];?></label>
                        </div>
                    </div>           
                    <div class="form-group">
                        <label for="inputOutletName" class="col-lg-4 col-xs-4 control-label">Type </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['subs_type'];?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCampaign" class="col-lg-4 col-xs-4 control-label">No. of months </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['cmpn_expire_duration'];?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputExpireDate" class="col-lg-4 col-xs-4 control-label">Start Date (Old Expiry Date) </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo date('d M Y',$_record[0]['subs_date']);?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputExpireDate" class="col-lg-4 col-xs-4 control-label">New Expiry Date </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo date('d M Y',$_record[0]['expire_date']);?></label>
                        </div>
                    </div>

                    <?php /*
                    <div class="form-group">
                        <label for="inputNewBalance" class="col-lg-4 col-xs-4 control-label">No. of Sessions/Amt</label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['tran_value'];?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputNewBalance" class="col-lg-4 col-xs-4 control-label">Current Balance</label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['old_balance'];?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputNewBalance" class="col-lg-4 col-xs-4 control-label">Today’s Redemption </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['redemption'];?></label>
                        </div>
                    </div>
                    */?>
                    <div class="form-group">
                        <label for="inputNewBalance" class="col-lg-4 col-xs-4 control-label">Balance </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['cust_balance'];?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBillNo" class="col-lg-4 col-xs-4 control-label">Bill No </label>
                        <div class="col-lg-8 col-xs-8">
                           <label class="control-label"><?php echo $_record[0]['subs_bill_no'];?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBillAmount" class="col-lg-4 col-xs-4 control-label">Bill Amount </label>
                        <div class="col-lg-8 col-xs-8">
                            <label class="control-label"><?php echo $_record[0]['subs_bill_amount'];?></label>
                        </div>
                    </div>
                </div><!--end left-->
                
                <div class="col-xs-6">
                    <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Car Number</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['car_number'];?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Model</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['car_model'];?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Color</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['car_color'];?></label>
                </div>
            </div>            
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Remark</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['remark'];?></label>
                </div>
            </div>      
            <hr>
            <?php //print_r($_record[0]);?>
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">User</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['user_name'];?></label>
                </div>
            </div>      
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Outlet</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><?php echo $_record[0]['ol_name'];?></label>
                </div>
            </div>     
            <hr>
            <div class="form-group">
                <label for="" class="col-lg-4 col-xs-4 control-label">Status</label>
                <div class="col-lg-8 col-xs-8">
                    <label class="control-label"><span class="label label-success">Approved</span></label>
                </div>
            </div>     
                </div><!--end right-->
                
            </div><!--end row-->             
        </form>

    </div>
</section>