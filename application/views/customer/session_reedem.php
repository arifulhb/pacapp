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
            <header class="panel-heading text-center"><?php echo $cmpn_name.' - Current Balance: '.$cust_balance.' left';?></header>
        </section>
        <?php
        //print_r($_sessions);
        
        foreach($_sessions as $row): ?>
        <form method="POST" class="" style="margin-top: 5px;"
              action="<?php echo base_url().'transaction/receipt_session'?>">
            <input type="hidden" name="subs_sn" value="<?php echo $subs_sn;?>">            
            <input type="hidden" name="_redeem" value="<?php echo $row['red_sessions'];?>">
            <input type="hidden" name="_red_name" value="<?php echo $row['red_name'];?>">
            <button type="submit" class="btn btn-lg btn-primary btn-block" ><?php echo $row['red_name'];?></button>
        </form>
            <?php
        endforeach;
        ?>   
        <br>
        <a href="<?php echo base_url();?>" class="btn btn-lg btn-default btn-block">Cancel</a>

    </div>
    </div>