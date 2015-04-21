<section class="panel customerinfo">
    <header class="panel-heading">
        <dl>
            <dt><?php echo $cust_name ?></dt>
            <dd><span>Card No:</span> <?php echo $cust_card_no; ?></dd>
            <dd><span>Car Number:</span> <?php echo $cust_car_no; ?></dd>
        </dl>
    </header>
</section>
<?php //print_r($_cust_balance);?>
<section class="panel scancard">
    <header class="panel-heading text-center">
        <?php echo $cmpn_name;?> - Balance $<?php echo number_format($_cust_balance[0]['cust_balance'],'2','.',',');?> left
    </header>
    <div class="panel-body">
        <form role="form" action="<?php echo base_url().'transaction/receipt_giftcard';?>" 
              method="POST" class="keypad">
            <div class="form-group">
                <input type="hidden" name="subs_sn" value="<?php echo $subs_sn;?>">            
                <label for="exampleInputEmail1" class="sr-only">Scan Card</label>
                <input type="number" name="value" class="form-control input-lg text-center key_display" 
                       required="" step="any" style="height: 55px;">
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-1">1</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-2">2</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-3">3</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-4">4</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-5">5</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-6">6</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-7">7</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-8">8</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-9">9</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">                    
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-0">0</a>
                </div>
                <div class="col-xs-4">                    
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Deduct from Balance</button>
            <a href="<?php echo base_url();?>" class="btn btn-lg btn-default btn-block">Cancel</a>

        </form>

    </div>
</section>