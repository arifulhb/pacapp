<section class="panel customerinfo">
    <header class="panel-heading">
        <dl>
            <dt><?php echo $cust_name?></dt>
            <dd><span>Card No:</span> <?php echo $cust_card_no;?></dd>
            <dd><span>Car Number:</span> <?php echo $cust_car_no;?></dd>
        </dl>
    </header>
</section>

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading text-center">
                <?php echo $cmpn_name.' - Current Balance: '.$cust_balance.' left';?>
            </header>
        </section>
        <form action="<?php echo base_url().'transaction/receipt_visit';?>" method="post">
            <input type="hidden" name="cust_card_id" value="">
            <input type="hidden" name="cust_sn" value="<?php echo $cust_sn;?>">
            <input type="hidden" name="subs_sn" value="<?php echo $subs_sn;?>">            
            
            <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $cmpn_visit_active_button;?></button>
            <a href="<?php echo base_url();?>" class="btn btn-lg btn-default btn-block">Cancel</a>
        </form>
    </div>
</div>