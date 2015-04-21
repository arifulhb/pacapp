<?php

//print_r($_record[0]);
//$_user = $_record[0]['user'];
    $_cust      = $_record[0]['cust'];
    $_subs      = $_record[0]['subs'];
    $_subs_res  = $_record[0]['subs_res'];


//$_campaign=$_record[0]['campaign'];

/*
echo '<pre>';
print_r($_cust);
print_r($_subs);
print_r($_subs_res);
echo '</pre>';
//echo 'outlet: '.$_user[0]['outlet'];

exit();
*/
?>
<div class="row">
    <div class="col-sm-12">
        <section class="panel receipt print">
            <header class="panel-heading text-center">
                Prime Auto Care                
                <small>Outlet: <?php echo $_record[0]['user'][0]['outlet'];?></small>
                <small>By: <?php echo $_record[0]['user'][0]['user_name'];?></small>
            </header>
            <div class="panel-body text-center">                
                <h3>Subscription Receipt</h3>
                <dl>
                    <dt><?php echo $_cust['cust_first_name'];?></dt>
                    <dd><span>Card ID:</span> <?php echo $_cust['cust_card_id'];?></dd>
                    <dd><span>Card No:</span> <?php echo $_cust['cust_id'];?></dd>
                    <dd><span>Mobile No:</span> <?php echo $_cust['cust_phone'];?></dd>
                    <dd><span>Email Address:</span> <?php echo $_cust['cust_email'];?></dd>
                    <?php /*<dd><span>City:</span> <?php echo $_cust['cust_city'];?></dd> */?>
                    <dd><span>Postal:</span> <?php echo $_cust['cust_zip'];?></dd>
                    <dd><span>Country:</span> <?php echo $_cust['cust_country'];?></dd>
                    <br>
                    <dd><span>Car Number:</span> <?php echo $_subs['car_number'];?></dd>
                    <dd><span>Model:</span> <?php echo $_subs['car_model'];?></dd>
                    <dd><span>Color:</span> <?php echo $_subs['car_color'];?></dd>
                     
                    
                    <dt>Plan: <?php echo $_record[0]['campaign'][0]['cmpn_name'];?></dt>
                    <dd><span>Type: </span><?php echo $_subs['subs_type'];?></dd>
                    <dd><span>Transaction Date:</span> <?php echo date('d M, Y h:i a',strtotime($_subs['update_date']));?></dd>                    
                    <dd><span>Start Date: </span> <?php echo date('d M, Y',strtotime($_subs['subs_date']));?></dd>                                        
                    <dd><span>Old Balance:</span> <?php echo number_format($_subs_res['old_balance'],2,'.',',');?></dd>
                    <dd><span>Today's Redemption:</span> <?php echo $_subs_res['redemption'];?></dd>
                    <dd><span>Number of Session/Amount: </span><?php echo $_subs['tran_value'];?></dd>
                    <dd><span>New Balance:</span> <?php echo number_format($_subs['cust_balance'],2,'.',',');?></dd>
                    <dd><span>Expire Date:</span> <?php echo date('d M, Y',strtotime($_subs['expire_date']));?></dd>
                    <dd><span>Bill No:</span> <?php echo $_subs['subs_bill_no'];?></dd>
                    <dd><span>Bill Amount:</span> <?php echo number_format($_subs['subs_bill_amount'],2,'.',',');?></dd>
                    
                    <dt>Additional Information</dt>
                    <dd><?php echo $_subs['remark'];?></dd>
                </dl>
            </div>
        </section>
        <button type="submit" class="btn btn-lg btn-primary btn-print btn-block noprint">Print</button>
        <a href="<?php echo base_url();?>" class="btn btn-lg btn-default btn-block noprint">Done</a>                    
    </div>
</div>

<script>require(['page/receipt_print']);</script>
