<div class="row">
    <div class="col-sm-12">
        <section class="panel receipt print">
            <header class="panel-heading text-center">
                Prime Auto Care                
                <small>Outlet: <?php echo $this->session->userdata('outlet');?></small>
                <small>By: <?php echo $this->session->userdata('user_name');?></small>
            </header>
            <div class="panel-body text-center">
                <?php
               // print_r($_record);
                ?>
                <h3>Membership Receipt</h3>
                <dl>
                    <dt><?php echo $_record[0]['cust_first_name'].' '.$_record[0]['cust_last_name'];?></dt>
                    <dd><span>Card No:</span> <?php echo $_record[0]['cust_card_id'];?></dd>
                    <dd><span>Car Number:</span> <?php echo $_record[0]['cust_car_no'];?></dd>
                    <dd><span>Date:</span> <?php echo date('d M, Y',$_record[0]['trn_date'])?></dd>

                    <dt>Transaction No</dt>
                    <dd><?php echo $_record[0]['trn_sn'];?></dd>
                    
                    <dt>Campaign Name:</dt>
                    <dd><?php echo $_record[0]['cmpn_name'];?></dd>

                    <dt>Current Balance</dt>
                    <dd><?php echo ($_record[0]['cust_balance'])+($_record[0]['tran_value']);?></dd>
                    
                    <dt>Redemption</dt>
                    <dd><?php echo $_record[0]['tran_activity'];?></dd>

                    <dt>New Balance</dt>
                    <dd><?php echo $_record[0]['cust_balance'];?></dd>                    

                    <dt>Expiry Date:</dt>
                    <dd><?php echo date('d M, Y',$_record[0]['expire_date']);?></dd>
                </dl>
            </div>
        </section>
        <button type="submit" class="btn btn-lg btn-primary btn-print btn-block noprint">Print</button>
        <a href="<?php echo base_url();?>" class="btn btn-lg btn-default btn-block noprint">Done</a>                    
    </div>
</div>
<script>require(['page/receipt_print']);</script>